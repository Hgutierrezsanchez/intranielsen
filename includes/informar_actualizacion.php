<?php

include("conexion.php");
$link=conectar();

$sql=mysqli_query($link,"SELECT idusuario FROM tblusuario where estado=1");

while($row = mysqli_fetch_array($sql)){
    $query="insert into tblnotificaciones(idusuario,message,estado,fecha) value('".$row['idusuario']."','Vaciar historial de navegación',0,DATE(now()))";
    mysqli_query($link,$query);
}

    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Usuarios informados satisfactoriamente...";
    echo "</div>";
?>