<head>
	<meta charset="utf-8">
</head>

<?php


$usuario=$_POST['usuario'];
$perfil=$_POST['perfil'];

include_once("../../../includes/conexion.php");
$link=conectar();

$sql="SELECT nombre,idusuario FROM tblusuario Where perfil='$perfil' and idusuario<>'$usuario' and admin<>1 And estado=1 And idusuario not in (select idusuarioejecutivo from tblsuperejecutivo) order by nombre"; 

$ejecutivos=mysqli_query($link,$sql);

while($rs=mysqli_fetch_array($ejecutivos)) 
{ 

    echo "<p><input name='".$rs['idusuario']."' type='checkbox' value='".$rs['idusuario']."' id='check'> ".utf8_encode($rs['nombre'])."</input>";
} 
mysqli_close($link);
?>