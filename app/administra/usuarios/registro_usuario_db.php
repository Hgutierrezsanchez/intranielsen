<head>
	<meta charset="utf-8">
</head>

<?php
include_once("../../../includes/conexion.php");
$linkr=conectar();

//variables POST
$op=$_POST['opcion'];
$nom=strtoupper(utf8_decode(trim($_POST['nombres'])));
$dep=strtolower(trim($_POST['usuario']));
$suel=md5(strtolower(trim($_POST['pass'])));
$corr=strtolower(trim($_POST['correo']));
$adm=$_POST['admin'];
$rut=trim($_POST['rut']);
$perfil=$_POST['perfil'];

if ($op=='Nuevo')
{
$sql="Select idusuario from tblusuario where lcase(idusuario)='$dep'";
$user=mysqli_query($linkr,$sql);

if (mysqli_num_rows($user)>0) 
{
	echo "<br />";
    echo "<div class='callout callout-danger'>";
        echo "El Usuario Ingresado ya existe, favor intentar con otro usuario...";
    echo "</div>";

}else{
	$sql="INSERT INTO tblusuario (idusuario,nombre,password,correo,admin,rut,perfil) VALUES ('$dep','$nom','$suel','$corr','$adm','$rut','$perfil')";
	mysqli_query($linkr,$sql);

	$sql="Insert Into tblperfilesuser(idusuario,idopcion,idsubmenu) select '$dep',idopcion,idsubmenu from tblperfiles where nombre='$perfil'";
	mysqli_query($linkr,$sql);


    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Usuario registrado satisfactoriamente...";
    echo "</div>";

    
}
}else{
	
	mysqli_query($linkr,"Delete from tblperfilesuser where lcase(idusuario)='$dep'");

	$sql="update tblusuario Set nombre='$nom',correo='$corr',admin='$adm',rut='$rut',perfil='$perfil' Where Idusuario='$dep'";
	mysqli_query($linkr,$sql);

	$sql="Insert Into tblperfilesuser(idusuario,idopcion,idsubmenu) select '$dep',idopcion,idsubmenu from tblperfiles where nombre='$perfil'";
	mysqli_query($linkr,$sql);
    
    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Usuario actualizado satisfactoriamente...";
    echo "</div>";
	
}
mysqli_close($linkr);
?>