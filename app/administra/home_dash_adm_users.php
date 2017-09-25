<!DOCTYPE html> 
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>INTRA-Nielsen | ADMINISTRACION</title>
    
    <link rel="icon" type="image/png" href="../../favicon.ico" />
    
    <link rel="stylesheet" href="../../dist/css/styles.css">
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
      
   
       
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    
    <div class="wrapper">
        <!-- DIV FLOTANTE FRENTE DE PAGINA -->
        <section>
            <div id="capa_modal" class="div_modal" onclick="javascript:cerrar_div_modal()"></div>
            <div id="capa_para_edicion" class="div_contenido"></div>
        </section>
        
        <!-- Encabezado pagina -->
        <?php
            include('../../home_header.php');
        ?>
      
        <!-- Menu Principal -->      
        <aside class="main-sidebar">
            <section class="sidebar">
            <?php
                $id=99;
                include('../../home_menu.php');
            ?>
            </section>
        </aside>

        <!-- Contenido Central de Pagina -->
        <div class="content-wrapper">
            <div id="content-sidebar">
                <?php 
                    $iduser=$_SESSION['iduser'];
                    $op=$_GET['op'];
                    switch ($op) {
                        case '1':        include_once('dash_registro_user.php'); break;
                        case '2':        include_once('dash_perfiles_primarios.php');break;
                     
                    }
                ?>
            </div>
        </div><!-- /.content-wrapper -->
      
      
      
        <!-- Pie de Pagina -->
        <?php 
            include('../../home_footer.php');
        ?>  
  
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="/intranielsen/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    
    <!-- Bootstrap 3.3.5 -->
    <script src="/intranielsen/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/intranielsen/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/intranielsen/dist/js/app.min.js"></script>
    
    
    <script src="/intranielsen/js/sidebar.js"></script>
    
    
    <script src="/intranielsen/js/sidebar.js"></script>
    
    <script src="../administra/usuarios/ajax_users.js"></script>
    <script src="../administra/perfiles/ajax_perfiles.js"></script>
    
    <script>
        $(document).keyup(function(event) {
        if (event.which == 27) {
            $("#capa_modal").hide();
            $("#capa_para_edicion").hide();
            $("#capa_para_edicion").html("");
            }
        });
        
        $(document).ready(function() {	
            $(document).on('click','.paginate', function(){

                $('#bloque_listausuarios').html('<div class="loading"><img src="/intranielsen/img/cargando.gif" width="70px" height="70px"/></div>');

                var page = $(this).attr('data');		
                var dataString = 'page='+page+'&perfil='+document.filtra_usuario_perfil.perfil.value;

                $.ajax({
                    type: "GET",
                    url: "usuarios/lista_usuarios_actualizar.php",
                    data: dataString,
                    success: function(data) {
                        $('#bloque_listausuarios').html(data);
                    }
                });
            });              
        });    
    </script>
    
  </body>
</html>
