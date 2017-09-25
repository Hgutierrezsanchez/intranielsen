<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema NWA | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!--stylo-->
    <link rel="stylesheet" href="dist/css/styles.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link rel="icon" type="image/png" href="favicon.ico" />
  </head>
  <body id="body">
<?php
if(isset($_COOKIE['iduser']))
{
    session_start();
    $_SESSION['iduser']=$_COOKIE['idusuario'];
    $_SESSION['nombreusuario']=$_COOKIE['nombre'];
    $_SESSION['admin']=$_COOKIE['admin'];
    session_write_close();

    header("location:/intranielsen/home.php");     
}
?>
    <div class="login-box">
      <div class="login-logo">
        <img src="img/n1.png" style="width:270px;" />
        
      </div><!-- /.login-logo -->
        <div class="login-box-body">
            <div id="message"></div>
            <p class="login-box-msg">Ingrese al sistema</p>
            <form action="includes/valida_usuario.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Usuario" name="usuario" onkeypress="return runscriptlogin(event); ">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" onkeypress="return runscriptlogin(event); ">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <input type="checkbox"  name="session"><b>&nbsp;&nbsp;Recordar Usuario</b>
                </div>
            </form>
            <button type="submit" class="btn btn-primary btn-block btn-flat bloging" onclick="enviar_login(); return false;">Iniciar</button> 
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    
    <script>
        function runscriptlogin(event){
            $(document).keyup(function(event) {
            if (event.which == 13) {
                enviar_login();
                }
            });
        }
        
        function enviar_login(){
            $.ajax({
                method: "POST",
                url: "/intranielsen/includes/valida_usuario.php",
                data: { usuario: $('input[name=usuario]').val(), password: $('input[name=password]').val(), session: $('input[name=session]').val() }
            }).done(function(DatosRecuperados){
                if (DatosRecuperados==1){
                        var ruta="/intranielsen/home.php";
                        window.location= ruta;
                }else if (DatosRecuperados==2) {
                    var result;
                    result='<div id="alert" class="alert alert-danger alert-dismissable">';
                    result +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>';
                    result +='<h4>Alerta!</h4>';
                    result +='Debe completar los datos para ingresar...';
                    result +='</div>';
                    document.getElementById('message').innerHTML=result;
                } else {
                    var result;
                    result='<div id="alert" class="alert alert-danger alert-dismissable">';
                    result +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>';
                    result +='<h4>Alerta!</h4>';
                    result +='Las credenciales ingresadas no son validas...';
                    result +='</div>';
                    document.getElementById('message').innerHTML=result;
                }
            }).error(function(xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText)
            });
        }
    </script>
    
  </body>
</html>
