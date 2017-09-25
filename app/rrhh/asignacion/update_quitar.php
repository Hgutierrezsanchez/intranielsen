<head>
	<meta charset="utf-8">
</head>

<?php
include_once("../../../includes/conexion.php");
$link=conectar();
$usuario=$_POST['usuario'];

extract($_POST);
$estado=array_keys($_POST);
//mysqli_query($link,"Delete From tblsuperejecutivo Where idusuario='$usuario'");
for($j=0; $j<sizeof($estado); $j++)
{
	$opcion=explode(",",$estado[$j]);
	mysqli_query($link,"Delete from tblsuperejecutivo where idusuariosuper='$usuario' And idusuarioejecutivo='$opcion[0]'") ;
}
mysqli_close($link);

    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Asignación actualizada satisfactoriamente...";
    echo "</div>";
?>