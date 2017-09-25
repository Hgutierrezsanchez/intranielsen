<?php 
include_once("../../../includes/conexion.php");
$linkp=conectar();

$perfil=strtolower($_POST['nuevoperfil']);

$sql="Select nombre from tblperfiles where lcase(nombre)='$perfil'";
$user=mysqli_query($linkp,$sql);

if (mysqli_num_rows($user)>0) 
{
	echo "<br />";
    echo "<div class='callout callout-danger'>";
        echo "El Perfil Ingresado ya existe, favor intentar con otro nombre...";
    echo "</div>";
}else{
	$sql="Insert into tblperfiles(nombre) values('$perfil')";
	mysqli_query($linkp,$sql);
	echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Perfil Primario registrado satisfactoriamente...";
    echo "</div>";

}
mysqli_close($linkp);
?>