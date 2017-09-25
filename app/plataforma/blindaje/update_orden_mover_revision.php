<?php
if ( ! session_id() ) @ session_start();
$iduser=$_SESSION['iduser'];

extract($_POST);

include_once("../../../includes/conexion.php");
$link=conectar();

    $sql="update tbl_pendiente_blindaje set MARCA='N',FINAL='PENDIENTE' where id=".$id;
    $query =  mysqli_query($link,$sql);

mysqli_close($link);
?>