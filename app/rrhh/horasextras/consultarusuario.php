<head>
	<meta charset="utf-8">
</head>
    <?php

    include("../../../includes/conexion.php");

    $link=conectar();

    $new=utf8_decode(strtolower($_POST['ruts']));

    $sql="select nombre from tblusuario where rut='$new'";

    $resl_cons=mysqli_query($link,$sql);

    $rs=mysqli_fetch_array($resl_cons);

    echo $rs['nombre'];
    echo "<input id='nombre' type='hidden' value='$new'>";

    $sql="select horaingreso,horasalida from tblturnos where rut='$new' and fecha='".$_POST['fecha']."'";
    $resl_cons=mysqli_query($link,$sql);
    $rs=mysqli_fetch_array($resl_cons);
    echo "<br />";
    echo "Hora Entrada: ".$rs['horaingreso']."&nbsp;&nbsp;&nbsp;";
    echo "Hora Salida: ".$rs['horasalida'];
    mysqli_close($link);

?>
