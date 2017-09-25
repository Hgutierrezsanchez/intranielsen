<head>
	<meta charset="utf-8">
</head>
<?php 
    
    if ( ! session_id() ) @ session_start();
    $iduser=$_SESSION['iduser'];

	extract($_POST);
    if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
        $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
    }
	if ($_POST['archivo'] != "")
	{
        $archivo=$_SERVER["DOCUMENT_ROOT"]."/intranielsen/disco/cargas/".$archivo;
            
		if (file_exists ($archivo))
		{ 
			/** Clases necesarias */
			require_once('../../Classes_excel/PHPExcel.php');
			require_once('../../Classes_excel/PHPExcel/Reader/Excel2007.php');

			// Cargando la hoja de cálculo
			$objReader = new PHPExcel_Reader_Excel2007();
			$objPHPExcel = $objReader->load($archivo);
			$objFecha = new PHPExcel_Shared_Date();       

			// Asignar hoja de excel activa
			$objPHPExcel->setActiveSheetIndex(0);

			//conectamos con la base de datos 
			include_once("../../../includes/conexion.php");
			$linkt=conectar();
			
			echo "Conectando a la base....";
			
			$i=2;
			$param=0;
            $count=0;$max_insert=50;$sql_value="";
            
            $query="Delete from tbl_pendiente_blindaje_temp";
            mysqli_query($linkt,$query);
            
            ini_set('memory_limit', '-1');
            $sql_insert="Insert into tbl_pendiente_blindaje_temp values";
			while ($param==0){
				if ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue()!=NULL)
				{
                   if ($count!=0){$sql_value=$sql_value.",";}
                    
                    $RUT = substr($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue(),0,12);
                    $DESC_ACTIV = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getvalue();
                    $LOCALIDAD = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getvalue();
                    $NMRO_ORDEN = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getvalue();
                    
                    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
					$ano=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getFormattedValue();
					$krr = explode('-',$ano);
					$FECHA_COMPROMISO = implode("",$krr);
                    
                    $CODI_HORARIO = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getvalue();
                    $CONTEXTO = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getvalue();
                    $ESTD_ACTIV = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getvalue();
                    $DESC_AREAFUN = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getvalue();
                    
                    $objPHPExcel->getActiveSheet()->getStyle('AD'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
					$ano=$objPHPExcel->getActiveSheet()->getCell('AD'.$i)->getFormattedValue();
					$krr = explode('-',$ano);
					$FECHA_OT = implode("",$krr);
                    
                    $COMUNA = $objPHPExcel->getActiveSheet()->getCell('AI'.$i)->getvalue();
                    
                    $ACTIVIDAD = $objPHPExcel->getActiveSheet()->getCell('AL'.$i)->getvalue();
                    
                    $NODO = $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getvalue();
                    $SUBNODO = $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getvalue();
                    
                    $TIPO = $objPHPExcel->getActiveSheet()->getCell('AV'.$i)->getvalue();
                    
					$count++;
                    
                    $sql="Select Fecha_Compromiso,Codi_Horario from tbl_pendiente_blindaje where NMRO_ORDEN='$NMRO_ORDEN'";
                    $q_orden=mysqli_query($linkt,$sql);
                    
                    if (mysqli_num_rows($q_orden) > 0 ){
                        $r_orden=mysqli_fetch_object($q_orden);
                        $fecha = explode('-',$r_orden->Fecha_Compromiso);
					    $fecha = implode("",$fecha);
                        
                        if ($fecha != $FECHA_COMPROMISO || $r_orden->Codi_Horario != $CODI_HORARIO ){
                            $REAGENDA='Fecha Anterior: '.$r_orden->Fecha_Compromiso.' - Bloque: '.$r_orden->Codi_Horario.'  A  Fecha Nueva: '.$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getFormattedValue().' - Bloque: '.$CODI_HORARIO; 
                        }else{
                            $REAGENDA='N';
                        }
                    }else{
                        $REAGENDA='N';
                    }
                    mysqli_free_result($q_orden);
                    
					$sql_value=$sql_value."('$RUT','$DESC_ACTIV','$LOCALIDAD','$NMRO_ORDEN',$FECHA_COMPROMISO,'$CODI_HORARIO','$CONTEXTO','$ESTD_ACTIV','$DESC_AREAFUN',$FECHA_OT,'$COMUNA','$ACTIVIDAD','Nivel 1','$NODO','$SUBNODO','N','$TIPO','$REAGENDA')";
                    
                    if ($max_insert==$count)
                    {
                        mysqli_query($linkt,$sql_insert.$sql_value);
                        
                        $count=0;$sql_value="";
                    }
                    
					
				}else{
				    $param=1;
				}
				$i++;
			}
            
            if ($sql_value!="")
            {
                mysqli_query($linkt,$sql_insert.$sql_value);
            }
            
            
            
			if ($i>1)
            {   
                //actualizo nuevas fechas de compromiso, bloque horario y estado flujo => ademas de la ubicacion y ejecutivo para ordenes reagendadas
                $sql="update tbl_pendiente_blindaje pb inner join tbl_pendiente_blindaje_temp pbt on pb.NMRO_ORDEN=pbt.NMRO_ORDEN Set pb.FECHA_COMPROMISO=pbt.FECHA_COMPROMISO,pb.ESTD_ACTIV=pbt.ESTD_ACTIV,pb.CODI_HORARIO=pbt.CODI_HORARIO ";
                mysqli_query($linkt,$sql);
                
                $sql="Insert into tbl_blindaje_hist_gestion_hd(ID_ORDEN,NMRO_ORDEN,FECHA,GESTION_HD,ACCION,OBSERVACION,IDUSUARIO,HORA) Select 0,NMRO_ORDEN,DATE(now()) Fecha,'S/GESTION','REAGENDAMIENTO',REAGENDA,'$iduser',time(now()) from tbl_pendiente_blindaje_temp Where REAGENDA<>'N'";
                mysqli_query($linkt,$sql);
                
                
                $sql="update tbl_pendiente_blindaje Set Ubicacion='Nivel 10',Ejecutivo='' where FINAL<>'FINALIZADA' and fecha_compromiso>date(now()) and (ubicacion='Nivel 1' or Ubicacion='Nivel 2')";
                mysqli_query($linkt,$sql);
                
                $sql="update tbl_pendiente_blindaje Set Ubicacion='Nivel 10',Ejecutivo='' where FINAL<>'FINALIZADA' and fecha_compromiso>=date(now()) and (Ubicacion='Nivel 2')";
                mysqli_query($linkt,$sql);
                
                $sql="update tbl_pendiente_blindaje Set Ubicacion='Nivel 1',Ejecutivo='' where FINAL<>'FINALIZADA' and fecha_compromiso=date(now()) and ubicacion='Nivel 10'";
                mysqli_query($linkt,$sql);
                
                
                //Actualizo Nivel a ordenes cargadas para equipo elite
                $nuevafecha = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;
                $fecha_48 = date ( 'Ymd' , $nuevafecha );
                $sql="Update tbl_pendiente_blindaje_temp Set ubicacion='Nivel 2' where TIPO='NORMAL' AND Fecha_Compromiso<$fecha_48";
                mysqli_query($linkt,$sql);
                
                //envio todas las ordenes que tengan mayor cantidad de en nodo y sub nodo a redes
                $sql="Select comuna,nodo,subnodo,count(*) q from tbl_pendiente_blindaje_temp where Actividad='Servicio Tecnico'  group by comuna,nodo,subnodo Order by q Desc";
                $q_nivel3=mysqli_query($linkt,$sql);
                $count=0;
                while ($r_nivel3 = mysqli_fetch_object($q_nivel3)){
                    if ($r_nivel3 -> q >= 3){
                        $sql_2 ="Update tbl_pendiente_blindaje_temp Set marca='R' Where Actividad='Servicio Tecnico' And comuna='$r_nivel3->comuna' and nodo='$r_nivel3->nodo' and subnodo='$r_nivel3->subnodo' ";
                        mysqli_query($linkt,$sql_2);
                    }
                    else{
                        $count++;
                    }
                    if ($count >5) break;
                }
                
                
                //Actualizo Nivel a ordenes cargadas para futuro    
                $sql="Update tbl_pendiente_blindaje_temp Set ubicacion='Nivel 10' where Fecha_Compromiso>date(now())";
                mysqli_query($linkt,$sql);
                
                //CAMBIO DE EQUIPOS PROACTIVOS
                $sql="Update tbl_pendiente_blindaje_temp Set ubicacion='Nivel 4',marca='N' where TIPO='PROACTIVA'";
                mysqli_query($linkt,$sql);
                
                //finalizo estado flujo para ordenes que no estan en nuevo archivo y sean menor a la fecha de hoy
                $sql="Update tbl_pendiente_blindaje Set ESTD_ACTIV='F1'  where FECHA_COMPROMISO<=date(now()) And NMRO_ORDEN not in (Select NMRO_ORDEN from tbl_pendiente_blindaje_temp)";  
                mysqli_query($linkt,$sql);
                $sql="Update tbl_pendiente_blindaje Set ESTD_ACTIV='F1'  where Ubicacion='Nivel 4' And NMRO_ORDEN not in (Select NMRO_ORDEN from tbl_pendiente_blindaje_temp)";  
                mysqli_query($linkt,$sql);
                
                //borro todas las ordenes del archivo que ya tenemos cargadas
                $sql="Delete from tbl_pendiente_blindaje_temp where NMRO_ORDEN in (Select NMRO_ORDEN from tbl_pendiente_blindaje) ";  
                mysqli_query($linkt,$sql);
    
                $i=$i-2;
                
                
                
                echo "<br />";
                echo "<div class='callout callout-success'>";
                    echo "<p>Carga Finalizada...</p>";
                    echo "<p>Resumen</p>";
                    $sql="Select ubicacion,count(ubicacion) q from tbl_pendiente_blindaje_temp pbt group by ubicacion order by ubicacion";
                    $query=mysqli_query($linkt,$sql);
                    $total=0;
                    while ($row = mysqli_fetch_object($query))
                    {
                        echo "<p>".$row-> ubicacion.' -> '.$row->q."</p>";    
                        $total+= $row->q;
                    }
                    mysqli_free_result($query);
                    echo "<p>Total de ordes a procesar ".$total."</p>";
                echo "</div>";
            }else{
                echo "<br />";
                echo "<div class='callout callout-danger'>";
                    echo "A ocurrido un error al tratar de cargar el archivo... registros importados ".$i." intente nuevamente.";
                echo "</div>";    
            }
            
            mysqli_close($linkt);
            unlink($archivo);
			
		}else{
            echo "<br />";
            echo "<div class='callout callout-danger'>";
                echo "A ocurrido un error al tratar de cargar el archivo... intente nuevamente.";
            echo "</div>";
        }
	}
?>