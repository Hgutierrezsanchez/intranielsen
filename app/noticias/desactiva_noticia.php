<?php
include('../../includes/conexion.php');    
$linkt=conectar();

$idh=$_POST['id'];
$estatus=strtolower($_POST['estatus']);

if($estatus != 'off'){
    $sql="update tbl_noticias_blog set estatus='off' where id='$idh'";
    mysqli_query($linkt,$sql);
}else{
    $sql="update tbl_noticias_blog set estatus='activa' where id='$idh'";
    mysqli_query($linkt,$sql);
}
mysqli_close($linkt);
?>
<br />  
