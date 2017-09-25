<?php

include("../../../includes/conexion.php");
$linkc=conectar();

$fecha=$_GET['fecha'];
if (substr($_GET['fecha'],4,1)=="-" || substr($_GET['fecha'],4,1)=="/" ){
    $fecha=substr($_GET['fecha'], 0,4).substr($_GET['fecha'], -5,2).substr($_GET['fecha'], -2);
}

$sql=mysqli_query($linkc,"select t.rut,nombre,tarea,horaingreso,horasalida,hdiarias,tiempocolacion,nsemana,idusuario from tblturnos t inner join tblusuario u on t.rut=u.rut where u.estado=1 and fecha=$fecha order by tarea,nombre,horaingreso");
$registros = mysqli_num_rows($sql);

if ($registros > 0) {
    //require_once 'Classes/PHPExcel.php';
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
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'N°Semana');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Rut');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Nombre');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Tarea');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Hora_Ingreso');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Hora_Salida');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Horas_Dia');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Colacion');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Asistenca');                

    $i = 2;    
    while ($registro = mysqli_fetch_object ($sql)) {

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $registro -> nsemana);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $registro -> rut);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, utf8_encode($registro -> nombre));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $registro -> tarea);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $registro -> horaingreso);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $registro -> horasalida);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $registro -> hdiarias);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $registro -> tiempocolacion);
        
        $sql_ina=mysqli_query($linkc,"Select id,tipo_licencia From tblinasistencia Where rut='".$registro -> rut."' And licencia_desde<=$fecha And licencia_hasta>=$fecha");
               
        if (mysqli_num_rows($sql_ina)>0) 
        {
            $row_ina=mysqli_fetch_array($sql_ina);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, strtoupper($row_ina['tipo_licencia']));
            
        }else{
            if ($registro -> horaingreso=="00:00:00"){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, 'LIBRE');
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, '');
            }
        }
        $i++;
    }
    mysqli_close($linkc);
    
    //autisize para las columna
    foreach(range('A','I') as $columnID)
    {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    $objPHPExcel->getActiveSheet()->setTitle('Turno');
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="turnos_plataforma.xlsx"');
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