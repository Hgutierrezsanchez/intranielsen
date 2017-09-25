<head>
	<meta charset="utf-8">
</head>
<?php 
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
            
            $query="Delete from tbl_pendiente_dia";
            mysqli_query($linkt,$query);
            
            ini_set('memory_limit', '-1');
            $sql_insert="Insert into tbl_pendiente_dia values";
			while ($param==0){
				if ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue()!=NULL)
				{
                   if ($count!=0){$sql_value=$sql_value.",";}
                    
                    $IDEN_TRANSAC = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue();
                    $IDEN_SERVICIO = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getvalue();
                    
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
					$ano=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getFormattedValue();
					$krr = explode('-',$ano);
					$FECHA_INGRESO = implode("",$krr);
                    
                    
                    $TIPO = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getvalue();
                    $MOTIVO = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getvalue();
                    $CODIGO_VENDEDOR = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getvalue();
                    $IDEN_USERING = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getvalue();
                    $RUT_TECNICO = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getvalue();
                    $CLAS_SERVICIO = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getvalue();
                    $RUT_PERSONA = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getvalue();
                    $NMRO_SERVICIO = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getvalue();
                    $CODI_TECNOLOGIA = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getvalue();
                    $IDEN_VIVIENDA = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getvalue();
                    $LOCALIDAD = trim($objPHPExcel->getActiveSheet()->getCell('N'.$i)->getvalue());
                    $NODO = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getvalue();
                    $SUBNODO = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getvalue();
                    $CODI_AREAFUN = $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getvalue();
                    $TIPO_ACTIV = $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getvalue();
                    
                    $objPHPExcel->getActiveSheet()->getStyle('S'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
					$ano=$objPHPExcel->getActiveSheet()->getCell('S'.$i)->getFormattedValue();
					$krr = explode('-',$ano);
					$FECHA_COMPROMISO = implode("",$krr);
                    
                    
                    $HORARIO_COMPROMISO = $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getvalue();
                    $CODI_CLAVEFIN = $objPHPExcel->getActiveSheet()->getCell('U'.$i)->getvalue();
                    $OBSERVACION = $objPHPExcel->getActiveSheet()->getCell('V'.$i)->getvalue();
                    $TIPO_ORDEN = $objPHPExcel->getActiveSheet()->getCell('W'.$i)->getvalue();
                    $GRUPOTEC = $objPHPExcel->getActiveSheet()->getCell('X'.$i)->getvalue();
                    $DESC_ACTIV = $objPHPExcel->getActiveSheet()->getCell('Y'.$i)->getvalue();
                    $GRUPO = $objPHPExcel->getActiveSheet()->getCell('Z'.$i)->getvalue();
                    $CODI_PERTENECE = $objPHPExcel->getActiveSheet()->getCell('AA'.$i)->getvalue();
                    $CLASIFACTIV = trim($objPHPExcel->getActiveSheet()->getCell('AB'.$i)->getvalue());
                    $TIEMPO = $objPHPExcel->getActiveSheet()->getCell('AC'.$i)->getvalue();
                    $TRAMO_PDTE = $objPHPExcel->getActiveSheet()->getCell('AD'.$i)->getvalue();
                    $AG = $objPHPExcel->getActiveSheet()->getCell('AE'.$i)->getvalue();
                    $TR = $objPHPExcel->getActiveSheet()->getCell('AF'.$i)->getvalue();
                    $TERRITORIO = $objPHPExcel->getActiveSheet()->getCell('AG'.$i)->getvalue();
                    $DIGITAL = $objPHPExcel->getActiveSheet()->getCell('AH'.$i)->getvalue();
                    $RUT_PERSONA2 = $objPHPExcel->getActiveSheet()->getCell('AI'.$i)->getvalue();
                    $LOCALIDAD2 = $objPHPExcel->getActiveSheet()->getCell('AJ'.$i)->getvalue();
                    $Q_RECO = $objPHPExcel->getActiveSheet()->getCell('AK'.$i)->getvalue();
                    $REAGENDAMIENTO = $objPHPExcel->getActiveSheet()->getCell('AL'.$i)->getvalue();
                    $REAGENDAMIENTO_FINAL = $objPHPExcel->getActiveSheet()->getCell('AM'.$i)->getvalue();
                    $CLASIFICACION_ACTIVIDAD = $objPHPExcel->getActiveSheet()->getCell('AN'.$i)->getvalue();

                    
                    
                    
                    
					$count++;
                    
					$sql_value=$sql_value."('$IDEN_TRANSAC','$IDEN_SERVICIO','$FECHA_INGRESO','$TIPO','$RUT_TECNICO','$RUT_PERSONA','$IDEN_VIVIENDA','$LOCALIDAD','$NODO','$SUBNODO','$CODI_AREAFUN','$FECHA_COMPROMISO','$HORARIO_COMPROMISO','$DESC_ACTIV','$GRUPO','$CLASIFACTIV','$TIEMPO' ,'$TRAMO_PDTE','$AG','$TR','$TERRITORIO','$REAGENDAMIENTO','$REAGENDAMIENTO_FINAL','Pendiente','',0)";
                    
                    if ($max_insert==$count)
                    {
                        mysqli_query($linkt,$sql_insert.$sql_value);
                        $count=0;$sql_value="";
                    }
                    
					//mysqli_query($linkt,$query);
                    
					
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
                //Si cargo archivo ahora se regula tabla
                
                //clasificacion de servicio
                $sql="UPDATE tbl_pendiente_agrupa_clas_serv acs INNER JOIN tbl_pendiente_dia pd ON acs.Desc_Activ = pd.DESC_ACTIV SET pd.CLASIFACTIV_Detalle = acs.Agrupacion";
                mysqli_query($linkt,$sql);
                $sql="UPDATE tbl_pendiente_dia SET CLASIFACTIV_Detalle=CLASIFACTIV WHERE CLASIFACTIV_Detalle=''";
                mysqli_query($linkt,$sql);
                
                //Elimina Nodos que no corresponden
                $sql="UPDATE tbl_pendiente_dia pd INNER JOIN tbl_pendiente_nodos pn ON (pd.LOCALIDAD = pn.Comuna AND pd.NODO = pn.Nodo) SET pd.Eliminar = 1";
                mysqli_query($linkt,$sql);    
                $sql="UPDATE tbl_pendiente_dia pd INNER JOIN tbl_pendiente_nodos pn ON (pd.SUBNODO = pn.Cuadrante AND pd.NODO = pn.Nodo AND pd.LOCALIDAD = pn.Comuna) SET pd.Eliminar =1";
                mysqli_query($linkt,$sql);
                $sql="DELETE FROM tbl_pendiente_dia WHERE (Eliminar=0 AND LOCALIDAD='SPED') OR (Eliminar=0 AND LOCALIDAD='VINA') OR (Eliminar=0 AND LOCALIDAD='QPUE')";
                mysqli_query($linkt,$sql);
                
                
                
                //elimino y guardo en historico
                $sql="Delete from tbl_pendientes_historico where fecha='$fecha'";
                mysqli_query($linkt,$sql);
                
                
                $sql="insert into tbl_pendientes_historico(fecha,territorio,clasificacion,ag,q) Select '$fecha',pt.NEW_TERRITORIO,pd.CLASIFACTIV_detalle,ag,count(pd.iden_transac) q from (tbl_pendiente_dia pd inner join tbl_pendiente_territorio pt on pd.LOCALIDAD=pt.CODIGO_LOC ) inner join tbl_pendiente_clas_serv pc on pd.CLASIFACTIV_detalle=pc.Clas_Serv where lower(pt.MERCADO)='nielsen' group by pt.NEW_TERRITORIO,pd.CLASIFACTIV_detalle,ag";
                mysqli_query($linkt,$sql);
                
                //historico de reagendamiento
                $sql="Delete from tbl_pendientes_historico_reagendamiento where fecha='$fecha'";
                mysqli_query($linkt,$sql);
                $sql="insert into tbl_pendientes_historico_reagendamiento(fecha,territorio,q_agendamiento,q_ordenes) select '$fecha',new_territorio,reagendamiento_final q_agendamiento ,count(iden_servicio) q_ordenes from tbl_pendiente_dia pd inner join tbl_pendiente_territorio pt on pd.localidad=pt.codigo_loc  where pd.reagendamiento_final >0 And  lower(pd.ag)='hoy' and lower(pt.MERCADO)='nielsen' group by new_territorio,pd.reagendamiento_final";
                mysqli_query($linkt,$sql);
                
                $i=$i-2;
                echo "<br />";
                echo "<div class='callout callout-success'>";
                    echo "<p>Carga Finalizada...</p>";
                    echo "<p>Total de registros importados ".$i."</p>";
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