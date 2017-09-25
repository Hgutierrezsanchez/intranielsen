<head>
	<meta charset="utf-8">
</head>
<?php
	
	include("../../../includes/conexion.php");
	$link=conectar();
			
    //variables POST

    $rut=utf8_decode(strtolower($_POST['rut']));
    $fecha=utf8_decode(strtolower($_POST['fecha']));
    $desde=utf8_decode(strtolower($_POST['desde']));
    $hasta=utf8_decode(strtolower($_POST['hasta']));
    $motivo=utf8_decode(strtolower($_POST['motivo']));
    $solicitante=utf8_decode(strtolower($_POST['solicitante']));
    $estado='pendiente';


    //registra los datos de la solicitud de horas extras
    $sql="INSERT INTO tblhorasextras(rut, fecha, desde, hasta, motivo, solicitante, estado)VALUES('$rut', '$fecha','$desde', '$hasta', '$motivo', '$solicitante', '$estado')";


    mysqli_query($link,$sql);
    mysqli_close($link);

    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "<p>Horas Extras Guardas con exito....</p>";
    echo "</div>";	
?>