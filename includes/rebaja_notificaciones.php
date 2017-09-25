<?php

$op=$_POST['opcion'];
$id=$_POST['id'];
$iduser=$_POST['iduser'];

if ($op==2){ $tabla="tblnotificaciones";}

include("conexion.php");
$link=conectar();

$sql="update ".$tabla." set estado=1 where id='$id'";
mysqli_query($link,$sql);

//$sql="Select count(*) as cuenta from ".$tabla." where idusuario='$iduser' and estado=0";
//$r_message=mysqli_query($link,$sql);
//$rs_mess_count=mysqli_fetch_array($r_message);

//if ($rs_mess_count['cuenta']>0){ echo $rs_mess_count['cuenta'];}else{echo"0";}

mysqli_close($link);
?>