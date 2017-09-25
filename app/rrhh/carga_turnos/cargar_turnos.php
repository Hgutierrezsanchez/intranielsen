<head>
	<meta charset="utf-8">
</head>
<?php 
	extract($_POST);
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
			include("../../../includes/conexion.php");
			$linkt=conectar();
			
			echo "Conectando a la base....";
			
			$i=1;
			$param=0;
            $rut="";
			while ($param==0){
				//echo $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue(); 
				if ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue()!=NULL)
				{
                    if ($rut != $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue())
                    {
                        $rut = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue();
                        $query="insert into tblnotificaciones(idusuario,message,estado,fecha) select idusuario,'Nuevo turno cargado',0,DATE(now()) from tblusuario where rut='".$rut."'";
                        mysqli_query($linkt,$query);
                        
                    }
					$rut = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getvalue();
					$tarea = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getvalue();
					$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
					$ano=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getFormattedValue();
					
					$krr = explode('-',$ano);
					$fecha = implode("",$krr);
					
					$h_i= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getvalue();
					$h_t = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getvalue();
					$nsemana = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getvalue();
					$hdiarias = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getvalue();
					$tiempocolacion = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getvalue();
					
					$query="Delete from tblturnos Where Rut='$rut' And fecha=$fecha";
					//echo $query;
					mysqli_query($linkt,$query);
					
					$query="Insert Into tblturnos(rut,tarea,fecha,horaingreso,horasalida,nsemana,hdiarias,tiempocolacion) values('$rut','$tarea',$fecha,'$h_i','$h_t','$nsemana','$hdiarias','$tiempocolacion')";
					mysqli_query($linkt,$query);
					
				}else{
				$param=1;
				}
				$i++;
			}
            mysqli_close($linkt);
            unlink($archivo);
            
			if ($i>1)
            {
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
			
		}else{
            echo "<br />";
            echo "<div class='callout callout-danger'>";
                echo "A ocurrido un error al tratar de cargar el archivo... intente nuevamente.";
            echo "</div>";
        }
	}
?>