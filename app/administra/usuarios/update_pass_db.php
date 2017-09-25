<head>
	<meta charset="utf-8">
</head>

<?php

include_once("../../../includes/conexion.php");
$linku=conectar();

//variables POST
$usuario=strtolower($_POST['usuario']);
$passn=md5(strtolower($_POST['passn']));
$passr=md5(strtolower($_POST['passr']));
$estado=$_POST['estado'];

if ($estado==1){
	$sql="Update tblusuario set password='$passn' where idusuario='$usuario'";
	mysqli_query($linku,$sql);
	
	echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Usuario actualizado satisfactoriamente...";
    echo "</div>";
}else{
	echo "<br />";
    echo "<div class='callout callout-danger'>";
        echo "No se puede cambiar la contraseña... Intente nuevamete...";
    echo "</div>";
}

mysqli_close($linku);
?>