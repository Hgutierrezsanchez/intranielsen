<?php

extract($_POST);

include_once("../../../includes/conexion.php");
$link=conectar();

    $sql="update tbl_pendiente_blindaje set ESTADO_REAL='$real' where id=".$id;
    $query =  mysqli_query($link,$sql);
    
    mysqli_free_result($query);
mysqli_close($link);
?>