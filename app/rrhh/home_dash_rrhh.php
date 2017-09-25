<!DOCTYPE html> 
<html> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>INTRA-Nielsen | TURNOS</title>
    
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
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    
    <link rel="stylesheet" href="../../dist/css/jquery.fileupload.css">
    
    <link rel="stylesheet" href="../../plugins/datepicker/bootstrap-datepicker.css">

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
           
            <div align="center" id="capa_modal" class="div_modal" onclick="javascript:cerrar_div_modal()"></div>
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
                $id=2;
                include('../../home_menu.php');
            ?>
            </section>
        </aside>

        <!-- Contenido Central de Pagina -->
        <div class="content-wrapper">
            <div id="content-sidebar" name="zerg">
                <?php 
                    $iduser=$_SESSION['iduser'];
                    $op=$_GET['op'];
                    switch ($op) {
                        case '0':        include_once('dash_rrhh_default.php'); break;    
                        case '1':        include_once('dash_turno_buscar_plataforma.php'); break;
                        case '2':        include_once('dash_carga-turnos.php');break;
                        case '3':        include_once('dash_turno-propio.php');break;
                        case '4':        include_once('dash_turno_equipo_asignado.php');break;
                        case '5':        include_once('dash_asigna-ejecutivo.php');break;
                        case '6':        include_once('dash_horasextras.php');break;
                        case '7':        include_once('dash_verhorasextras.php');break;
                        case '8':        include_once('dash_ausencias.php');break;
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
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    
    <script src="../../js/jquery.fileupload.js"></script>
    <script src="../../js/sidebar.js"></script>
    
    <script src="../../app/rrhh/ajax.js"></script>
    <script src="../../app/rrhh/horasextras/ajax.js"></script>
    <script src="../../app/rrhh/inasistencia/ajaxinasistencia.js"></script>
    
    <script>
        $(document).keyup(function(event) {
        if (event.which == 27) {
            $("#capa_modal").hide();
            $("#capa_para_edicion").hide();
            $("#capa_para_edicion").html("");
            }
        });
        
        
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = window.location.hostname === '' ?
                    '' : '../../disco/';

            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $("<a href=\"#\" onclick=\"cargar_turno_excel('"+file.name+"')\" class='btn btn-primary start'></a>").text('presione para cargar archivo: '+file.name).appendTo('#carga_archivo');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
        
        $(document).ready(function() {	
            $(document).on('click','.paginate', function(){

                $('#turnos_plataforma').html('<div class="loading"><img src="/intranielsen/img/cargando.gif" width="70px" height="70px"/></div>');

                var page = $(this).attr('data');		
                var dataString = 'page='+page+'&fecha='+document.form_busca_turno.fecha_turno.value;

                $.ajax({
                    type: "GET",
                    url: "turnos/listar_turnos_plataforma.php",
                    data: dataString,
                    success: function(data) {
                        $('#turnos_plataforma').html(data);
                    }
                });
            });              
        });
        
        $(document).ready(function() {
            $.fn.datepicker.dates['es'] = {
                 today: 'Hoy',
                 months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                 monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                 days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                 daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                 daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                 weekHeader: 'Sm',
                 format: 'dd-mm-yyyy',
                 weekStart: 1,
                 isRTL: false,
                 showMonthAfterYear: false,
                 yearSuffix: ''
             };
            
            $('#calendario_dash').datepicker({ language: 'es'});
            $('#calendario_dash').on('changeDate', function() {
                $('#fecha_cons').val(
                    $('#calendario_dash').datepicker('getFormattedDate')
                );
                
                $.ajax({
                    method: "POST",
                    url: "principal/resumenes_dia.php",
                    data: { fecha: $('#fecha_cons').val() }
                })
                .done(function(response) {
                    $("#carga_dash_dia").html(response)
                })
                .fail(function() {
                    alert( "error" );
                })         
            });
        });
    </script>
    
  </body>
</html>
