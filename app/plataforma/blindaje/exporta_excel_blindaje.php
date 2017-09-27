<?php

include("../../../includes/conexion.php");
$linkc=conectar();

extract($_GET);

$sql="Select pb.ID,pb.NMRO_ORDEN,RUT,COMUNA,FECHA_OT,FECHA_COMPROMISO,CODI_HORARIO,ESTADO_REAL,pb.GESTION_HD,FINAL,ACTIVIDAD";

if ($reporte == "RIESGO"){
    $sql.=",bb.desde,bb.hasta,time(now()) ahora from  tbl_pendiente_blindaje pb inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where FECHA_COMPROMISO=date(now()) and UBICACION='$nivel' and final<>'FINALIZADA' and bb.bloque='$bloque'";
}
elseif ($reporte == "INCUMPLIMIENTO"){
    $sql.=",bb.desde,bb.hasta,time(now()) ahora from  tbl_pendiente_blindaje pb inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where FECHA_COMPROMISO=date(now()) and UBICACION='$nivel' and final<>'FINALIZADA' and desde<=time(now()) and hasta<=time(now())";
}
elseif ($reporte == "INCUMPLIMIENTO_AYER"){
    $fecha=$bloque;
    if (substr($fecha,4,1)=="-" || substr($fecha,4,1)=="/" ){
        $fecha=substr($fecha, 0,4).substr($fecha, -5,2).substr($fecha, -2);
    }
    $sql.=",bb.desde,bb.hasta,time(now()) ahora from  tbl_pendiente_blindaje pb inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where FECHA_COMPROMISO<='$fecha' and UBICACION='$nivel' and final<>'FINALIZADA'";
}
elseif ($reporte == "FINALIZADAS"){
    $fecha=$bloque;
    if (substr($fecha,4,1)=="-" || substr($fecha,4,1)=="/" ){
        $fecha=substr($fecha, 0,4).substr($fecha, -5,2).substr($fecha, -2);
    }
    $sql.=",bb.desde,bb.hasta,time(now()) ahora from  (tbl_blindaje_hist_gestion_hd hd inner join tbl_pendiente_blindaje pb on pb.id=hd.ID_ORDEN) inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where pb.Fecha_Compromiso='$fecha' and  accion='FINALIZAR' and UBICACION='$nivel'";



}
elseif ($reporte == "REAGENDAMIENTO"){

    $fecha=$bloque;
    if (substr($fecha,4,1)=="-" || substr($fecha,4,1)=="/" ){
        $fecha=substr($fecha, 0,4).substr($fecha, -5,2).substr($fecha, -2);
    }
    $sql.=",UBICACION,bb.desde,bb.hasta,time(now()) ahora,hd.observacion from  (tbl_blindaje_hist_gestion_hd hd inner join tbl_pendiente_blindaje pb on pb.NMRO_ORDEN=hd.NMRO_ORDEN) inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where hd.Fecha='$fecha' and accion='REAGENDAMIENTO'";
}
elseif ($reporte == "REAGENDAREGISTRADOS"){

    $fecha=$bloque;
    if (substr($fecha,4,1)=="-" || substr($fecha,4,1)=="/" ){
        $fecha=substr($fecha, 0,4).substr($fecha, -5,2).substr($fecha, -2); //Fecha Anterior: 2017-09-24 - Bloque: .....  A  Fecha Nueva: 2017-09-25 - Bloque: 10-13
    }
    $sql.=",UBICACION,bb.desde,bb.hasta,time(now()) ahora,hd.motivo,hd.id_usuario,hd.observacion,concat('Fecha Anterior: ',hd.fecha_old,' - Bloque: ',hd.bloque_old,'  A  Fecha Nueva: ',hd.fecha_new,' - Bloque: ',hd.bloque_new) detalle from  (tbl_blindaje_reagendamientos hd inner join tbl_pendiente_blindaje pb on pb.NMRO_ORDEN=hd.NMRO_ORDEN) inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where date(hd.Fecha)='$fecha' ";

}
elseif ($reporte == "BANDEJA_USUARIO"){

    if ($view == 'N') {
        $sql_vista="and Marca<>'S'";
        $sql_filtro_estado="and FINAL<>'FINALIZADA' and fecha_compromiso<=date(now())";
    }
    elseif ($view == 'S') {
        $sql_vista="and Marca='S'";
        $sql_filtro_estado="and FINAL<>'FINALIZADA'";
    }
    elseif ($view == 'F') {
        $sql_vista="and Marca='F'";
        $sql_filtro_estado="and FINAL='FINALIZADA' and date(modifica_at)=date(now()) ";
    }
    elseif ($view == 'FU') {
        $sql_vista="and Marca='N'";
        $sql_filtro_estado="and FINAL<>'FINALIZADA' and fecha_compromiso>date(now()) ";
    }

    $sql_where="";
    $filtraje= mysqli_real_escape_string($linkc,$search);
    if ($filtraje != "")
    {
        $sql_where="and ( COMUNA like '%$filtraje%' or
        RUT like '%$filtraje%' or
        NMRO_ORDEN like '%$filtraje%' or
        FECHA_COMPROMISO like '%$filtraje%' or
        CODI_HORARIO like '%$filtraje%' or
        ESTD_ACTIV like '%$filtraje%' or
        ESTADO_REAL like '%$filtraje%' or
        GESTION_HD like '%$filtraje%'
        )";
    }

    $sql.=" ,'1' as desde From tbl_pendiente_blindaje pb where ejecutivo='$usuario' $sql_filtro_estado $sql_vista $sql_where ";
}
elseif ($reporte == "BANDEJA_BUSCAR"){

    $sql_where="";
    $filtraje= mysqli_real_escape_string($linkc,$search);
    if ($filtraje != "")
    {
        $sql_where="( COMUNA like '%$filtraje%' or
        RUT like '%$filtraje%' or
        NMRO_ORDEN like '%$filtraje%' or
        FECHA_COMPROMISO like '%$filtraje%' or
        CODI_HORARIO like '%$filtraje%' or
        ESTD_ACTIV like '%$filtraje%' or
        ESTADO_REAL like '%$filtraje%' or
        GESTION_HD like '%$filtraje%'
        )";
    }

    $sql.=" ,'1' as desde From tbl_pendiente_blindaje pb where $sql_where ";
}

$sql.=" Order by FECHA_COMPROMISO Asc,COMUNA,desde";



$query=mysqli_query($linkc,$sql);
$registros = mysqli_num_rows($query);


if ($registros > 0) {

    require_once('../../Classes_excel/PHPExcel.php');
    $objPHPExcel = new PHPExcel();

    //Informacion del excel
    $objPHPExcel->getProperties() ->setCreator("Jorge Jara H.")
                                    ->setLastModifiedBy("JJH")
                                    ->setTitle("Turno Plataforma")
                                    ->setSubject("Ejemplo 1")
                                    ->setDescription("Documento generado con PHPExcel")
                                    ->setKeywords("phpexcel")
                                    ->setCategory("ciudades");


    //encabezado
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'N_ORDEN');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'RUT');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'COMUNA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'FECHA_COMPROMISO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'CODI_HORARIO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'ESTADO_REAL');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'GESTION_HD');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'ESTADO FINAL');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'ACTIVIDAD');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'ULTIMA OBS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'EJECUTIVO_HD');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'FECHA_OT');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'TR');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'DIAS');
    $i = 2;
    while ($registro = mysqli_fetch_object ($query)) {

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $registro -> NMRO_ORDEN);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $registro -> RUT);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $registro -> COMUNA);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $registro -> FECHA_COMPROMISO);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $registro -> CODI_HORARIO);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $registro -> ESTADO_REAL);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $registro -> GESTION_HD);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $registro -> FINAL);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $registro -> ACTIVIDAD);

        $sql_obs="Select observacion,u.nombre from tbl_blindaje_hist_gestion_hd hd inner join tblusuario u on hd.idusuario=u.idusuario  where ID_ORDEN=".$registro -> ID." order by id desc limit 1";
        $query_obs=mysqli_query($linkc,$sql_obs);
        if( mysqli_num_rows($query_obs)>0){
            $r_obs = mysqli_fetch_object ($query_obs);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $r_obs -> observacion);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $r_obs -> nombre);
        }
        mysqli_free_result($query_obs);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i, $registro -> FECHA_OT);

        if ($reporte == "REAGENDAMIENTO"){
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'REAGENDAMIENTO AUTODETECTADO');
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'UBICACION');
          if (isset($registro -> observacion)){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $registro -> observacion);
          }
          if (isset($registro -> UBICACION)){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i, $registro -> UBICACION);
          }
        }
        elseif ($reporte == "REAGENDAREGISTRADOS"){
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'REAGENDAMIENTO HD USUARIO');
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'MOTIVO');
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'OBSERVACION');
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'DETALLE');
          if (isset($registro -> id_usuario)){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $registro -> id_usuario);
          }
          if (isset($registro -> motivo)){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i, $registro -> motivo);
          }
          if (isset($registro -> observacion)){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i, $registro -> observacion);
          }
          if (isset($registro -> detalle)){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i, $registro -> detalle);
          }
        }





        $datetime1 = date('Y-m-d');
        $datetime2 = $registro -> FECHA_OT;

        $dias	= (strtotime($datetime1)-strtotime($datetime2))/86400;
	      $dias 	= abs($dias); $dias = floor($dias);

        $DIF =$dias;



        if ($DIF > 30) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'> 1 MES');
        elseif ($DIF > 21)  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'> 3 SEMANAS');
        elseif ($DIF > 7)   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'> 1 SEMANA');
        elseif ($DIF > 3)   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'> 72 HORAS');
        elseif ($DIF = 3)   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'72 HORAS');
        elseif ($DIF == 2)  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'48 HORAS');
        elseif ($DIF == 1)  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'24 HORAS');
        elseif ($DIF == 0 ) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'HOY');
        elseif ($DIF <= 0 ) $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i,'FUTURO');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i, $DIF);



        $i++;
    }
    mysqli_free_result($query);
    mysqli_close($linkc);

    //autisize para las columna
    foreach(range('A','R') as $columnID)
    {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet()->setTitle($reporte);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte_blindaje.xlsx"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');

    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0


    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    $objWriter->save('php://output');

}

//exit;
?>
