<?php 
    include_once("../../../includes/conexion.php");
    $link=conectar();
    $perfil=$_POST['perfil'];

    extract($_POST);
    $estado=array_keys($_POST);
    mysqli_query($link,"Delete From tblperfiles Where nombre='$perfil'");
    for($j=1; $j<sizeof($estado); $j++)
    {
        $opcion=explode(",",$estado[$j]);
        mysqli_query($link,"Insert Into tblperfiles(nombre,idopcion,idsubmenu) values('$perfil','$opcion[0]','$opcion[1]')") ;
    }
    $sqlcon="Select idusuario from tblusuario Where perfil='$perfil'";
    $query=mysqli_query($link,$sqlcon);
    while($row = mysqli_fetch_array($query))
    {	
        $user=$row['idusuario'];

        $sql="delete from tblperfilesuser where idusuario='$user'";
        mysqli_query($link,$sql);

        $sql="Insert Into tblperfilesuser(idusuario,idopcion,idsubmenu) select '$user',idopcion,idsubmenu from tblperfiles where nombre='$perfil'";
        mysqli_query($link,$sql);
    }

    echo "<br />";
    echo "<div class='callout callout-success'>";
        echo "Perfil Primario actualizado satisfactoriamente...";
    echo "</div>";
    mysqli_close($link);
?> 