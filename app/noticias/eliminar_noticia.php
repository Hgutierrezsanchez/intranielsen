<?php
include('../../includes/conexion.php');    
$linkt=conectar();

$idh=$_POST['id'];

$sql="delete from tbl_noticias_blog where id='$idh'";


mysqli_query($linkt,$sql);


mysqli_close($linkt);
?>
<br />  
<div class='callout callout-success'>
       
</div>