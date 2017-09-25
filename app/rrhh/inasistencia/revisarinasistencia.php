<head>
	<meta charset="utf-8">
</head>

<?php
include("../../includes/conexion.php");
$linkr=conectar();



$dato=utf8_decode(strtolower($_POST['datos']));




//Muestra el nombre de la persona segun su rut
$sql="select nombre from tblusuario where rut='$dato'";



$resl_cons=mysqli_query($linkr,$sql);
$rs=mysqli_fetch_array($resl_cons);


echo $rs['dato'];


	
mysqli_close($linkr);




?>