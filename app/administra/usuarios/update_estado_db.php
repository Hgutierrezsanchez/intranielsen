<head>
	<meta charset="utf-8">
</head>

<?php

include_once("../../../includes/conexion.php");
$linku=conectar();

//variables POST
$usuario=strtolower($_POST['usuario']);
$estado=strtolower($_POST['estado']);

    if ($estado=='si'){
        $sql="Update tblusuario set estado='0' where idusuario='$usuario'";
        mysqli_query($linku,$sql);
    }else{
        $sql="Update tblusuario set estado='1' where idusuario='$usuario'";
        mysqli_query($linku,$sql);
    }
	echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Usuario actualizado satisfactoriamente...";
    echo "</div>";
mysqli_close($linku);
?>