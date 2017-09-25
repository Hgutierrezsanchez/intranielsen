<?php
	
	include("../../../includes/conexion.php");
	$link=conectar();
	
    $idhe=utf8_decode(strtolower($_POST['idhe']));
    $estado=utf8_decode(strtolower($_POST['estado']));

    $sql="UPDATE tblhorasextras set estado ='$estado' where idhe ='$idhe'";

    mysqli_query($link,$sql);
    mysqli_close($link);
    
    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Hora Extra actualizada satisfactoriamente...";
    echo "</div>";
?>