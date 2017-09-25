<?php
function conectar() //conecta la base de datos
{
    $basededatos    = "nielsendb";
    $host           = "localhost";
    $usuario        = "root";
    $password       = "";
    $charset        = "utf8";
    
    if (!($link = mysqli_connect($host, $usuario, $password,$basededatos)))
    {
        echo "Error Al Conectar!";
        exit();
    }
    //mysqli_set_charset($charset, $link);
    return $link;
}
?>