<?php
include('../../includes/conexion.php');    
$linkt=conectar();

$idh=utf8_decode(strtolower($_POST['id']));
$titulo1=utf8_decode(strtolower($_POST['titulo']));
$dcorta1=utf8_decode(strtolower($_POST['dcorta']));
$dlarga1=utf8_decode(strtolower($_POST['dlarga']));
$estatus=utf8_decode(strtolower($_POST['importancia']));


$sql="update tbl_noticias_blog set titulo='$titulo1', dcorta='$dcorta1', dlarga='$dlarga1', estatus='$estatus' where id='$idh'";
//$sql="update tbl_noticias_blog set dcorta='$dcorta1' where id='$idh'";

mysqli_query($linkt,$sql);


mysqli_close($linkt);
?>
<br />  
<div class='callout callout-success'>
       
</div>


