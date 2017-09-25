<?php

include("../../includes/conexion.php");
$linkt=conectar();

$fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
$idusuario=$_POST['idusuario'];
$bloque=$_POST['bloque'];
$norden=$_POST['norden'];
$rut=$_POST['rut'];
$observacion=$_POST['observacion'];
$comuna=$_POST['comuna'];

$sql="INSERT INTO tbl_agen_ordenes (idusuario,fecha,bloque,norden,rut_cliente,observacion,comuna) VALUES ('$idusuario',$fecha,'$bloque','$norden','$rut','$observacion','$comuna')";

mysqli_query($linkt,$sql);


mysqli_close($linkt);
?>
<br />  
<div class='callout callout-success'>
        <?php  echo "Agendamiento Guardado satisfactoriamente... Recargar Bloque."; ?>
</div>




