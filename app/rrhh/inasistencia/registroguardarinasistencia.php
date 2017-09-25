<head>
	<meta charset="utf-8">
</head>

<?php
include("../../../includes/conexion.php");
$linkr=conectar();


//variables POST
/*$tarea=($_POST['nombre']);*/


$datos=utf8_decode(strtolower($_POST['valrut']));
$licencia=utf8_decode(strtolower($_POST['inasistencias']));
$descripcion=utf8_decode(strtolower($_POST['descripcion']));
//Para guardar fecha
$desde=$_POST['desdes'];
if (substr($_POST['desdes'],4,1)=="-" || substr($_POST['desdes'],4,1)=="/" ){
    $desde=substr($_POST['desdes'], 0,4).substr($_POST['desdes'], -5,2).substr($_POST['desdes'], -2);
}
$hasta=$_POST['hasta'];
if (substr($_POST['hasta'],4,1)=="-" || substr($_POST['hasta'],4,1)=="/" ){
    $hasta=substr($_POST['hasta'], 0,4).substr($_POST['hasta'], -5,2).substr($_POST['hasta'], -2);
}

//registra los datos del empleados
$sql="insert into tblinasistencia(rut,tipo_licencia,descripcion,licencia_desde,licencia_hasta) values('$datos','$licencia','$descripcion','$desde','$hasta')";
mysqli_query($linkr,$sql);
	

echo "<br />";
echo "<div class='callout callout-success'>";
    echo "<p>Registro Guardado con exito...</p>";
echo "</div>";

mysqli_close($linkr);
?>