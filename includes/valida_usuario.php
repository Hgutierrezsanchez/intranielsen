<?php 


if (isset($_REQUEST['usuario']))
{
    $usuario=strtolower(trim($_REQUEST['usuario']));
    $pass=strtolower(trim($_REQUEST['password']));
    $session=$_REQUEST['session'];

    
    if ($usuario == "" || $pass == "" ) {
            echo "2";
    }else{
        include('conexion.php');
        $link=conectar();
        
        $pass=md5($pass);
        
        $user=mysqli_query($link,"Select idusuario,nombre,admin,password from tblusuario where idusuario='$usuario' And password='$pass' and estado=1") or die(mysql_error());
        if (mysqli_num_rows($user)>0) 
        {
            session_start();
            $row=mysqli_fetch_array($user,MYSQLI_ASSOC);


            $_SESSION['iduser']=$row['idusuario'];
            $_SESSION['nombreusuario']=$row['nombre'];
            $_SESSION['admin']=$row['admin'];

            if ($session == true) {
                mt_srand(time());
                $rand = mt_rand(1000000,9999999);
                ini_set('session.cookie_lifetime',time()+(60*60*24*365));
                setcookie("iduser", $row["idusuario"], time()+(60*60*24*365));
                setcookie("nombreusuario", $row['nombre'], time()+(60*60*24*365));
                setcookie("admin", $row['admin'], time()+(60*60*24*365));
            }

            $ruta="location:../home.php";
            session_write_close();
            
            echo "1";
            
        }else{
            echo "3";
        }
        mysqli_close($link);
    }
}else{
    echo "2";
}
?>