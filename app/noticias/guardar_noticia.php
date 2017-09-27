<?php
include('../../includes/conexion.php');     
$linkt=conectar();

  $datefecha=mysqli_query($linkt,"select curdate()");
  $datosfecha=mysqli_fetch_array($datefecha);
  $datos=$datosfecha['curdate()'];
                            
  $datoy=substr($datos,0,4);
  $datom=substr($datos,5,2);
              

extract($_POST);

$sql="INSERT INTO tbl_noticias_blog (titulo, dcorta, dlarga, estatus, ano, mes, origen) VALUES ('$titulo','$dcorta','$dlarga','$importancia', '$datoy','$datom','$from')";

mysqli_query($linkt,$sql);


mysqli_close($linkt);
?>
<br />  





