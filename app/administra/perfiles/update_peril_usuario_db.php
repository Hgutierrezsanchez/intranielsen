<?php 
    include_once("../../../includes/conexion.php");
    $link=conectar();
    $usuario=$_POST['usuario'];

    extract($_POST);
    $estado=array_keys($_POST);
    mysqli_query($link,"Delete From tblperfilesuser Where idusuario='$usuario'");

    for($j=1; $j<sizeof($estado); $j++)
    {
        $opcion=explode(",",$estado[$j]);
        mysqli_query($link,"Insert Into tblperfilesuser(idusuario,idopcion,idsubmenu) values('$usuario','$opcion[0]','$opcion[1]')") ;
    }

    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Perfil Usuario actualizado satisfactoriamente...";
    echo "</div>";
    
    mysqli_close($link);
?>