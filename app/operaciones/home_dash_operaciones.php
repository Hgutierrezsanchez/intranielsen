<!DOCTYPE html> 
<html> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>INTRA-Nielsen | OPERACIONES</title>

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
        
        <link rel="stylesheet" href="../../dist/css/jquery.fileupload.css"> 

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
                $id=4;
                include('../../home_menu.php');
            ?>
            </section>
        </aside>

        <!-- Contenido Central de Pagina -->
        
        <div class="content-wrapper">
            <div id="content-sidebar" name="zerg">
                <?php 
                    $pend_categoria_graf[]="";$pend_valores_graf[]="";
                    if ( ! session_id() ) @ session_start();
                    $iduser=$_SESSION['iduser'];
                    $op=$_GET['op'];
                    switch ($op) {
                        case '1':        include_once('dash_operaciones_default.php'); break;
                        case '2':        include_once('dash_carga_pendientes.php'); break;
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
    
    <script src="../../js/jquery.fileupload.js"></script>
    
    <script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    
    <script src="../../js/sidebar.js"></script>
    
    <script src="ajax.js"></script>
    
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
                        $("<a href=\"#\" onclick=\"cargar_pendientes_excel('"+file.name+"')\" class='btn btn-primary start'></a>").text('presione para cargar archivo: '+file.name).appendTo('#carga_archivo');
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
        

        $("select[name=zona_select]").change(function(){    
            Refrescar_pendientes();
        });
        
        $("input[name=fecha]").change(function(){
            Refrescar_pendientes();
        });
        
        function Refrescar_pendientes(){
            $('#tabla_pendientes').html('<div class="loading"><img src="/intranielsen/img/cargando.gif" width="70px" height="70px"/></div>');
            
            $.ajax({
                method: "POST",
                url: "tablas/tabla_pendientes.php",
                data: { zona: $('select[name=zona_select]').val(),fecha: $('input[name=fecha]').val() }
            })
            .done(function(response) {
                $("#tabla_pendientes").html(response);
                carga_grafico_mensual_pendientes();
                carga_grafico_dia_reagendamiento();
            });
        }
        
        $(document).ready(function() { 
            carga_grafico_mensual_pendientes();
            carga_grafico_dia_reagendamiento();
        });
        
        
        function carga_grafico_mensual_pendientes(){
            $.ajax({
                method: "POST",
                url: "graficos/grafico_pendientes.php",
                data: { zona: $('select[name=zona_select]').val(),fecha: $('input[name=fecha]').val() }
            }).done(function(DatosRecuperados){
                
                var serie= []; var valor= [];
                $.each(DatosRecuperados, function(i,o){
                    serie.push(String(o.x));
                    valor.push(parseFloat(o.y));
                });
                
                var grafico= $('#contenedor_graf_pendiente').highcharts({
                chart:{
                        type: 'column',
                        animation: Highcharts.svg,
                        width: 1210,
                        height: 300
                    },
                title:{text: 'Pendientes Ultimos 30 dias'},
                xAxis:{categories:serie},
                yAxis:{title: {text: 'Valor'},
                        plotLines: [{width: 1,color: '#808080'},]
                    },
                legend: {enabled: false },
                exporting: { enabled: true },
                series: [{ name: 'Valores', data:valor, dataLabels: {
                        enabled: true,
                        //rotation: -90,
                        align: 'top',
                        format: '{point.y:.0f}', // one decimal
                        //y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }}]
                
                });
                
            });
        }
        
        function carga_grafico_dia_reagendamiento(){
            $.ajax({
                method: "POST",
                url: "graficos/grafico_pendientes_reagendamiento.php",
                data: { zona: $('select[name=zona_select]').val(),fecha: $('input[name=fecha]').val() }
            }).done(function(DatosRecuperados){
                var serie= []; var valor= [];
                $.each(DatosRecuperados, function(i,o){
                    serie.push(String(o.x));
                    valor.push(parseFloat(o.y));
                });
                var inicio = valor[0];
                var fin = valor[valor.length-1];
                
                var grafico_reag= $('#contenedor_graf_pendiente_reag').highcharts({
                chart:{
                        type: 'column',
                        animation: Highcharts.svg,
                        width: 690,
                        height: 300
                    },
                title:{text: 'Q de Ordenes con Reagendamiento'},
                xAxis:{categories:serie},
                yAxis:{title: {text: 'Valor'},
                        plotLines: [{width: 1,color: '#808080'},]
                    },
                legend: {enabled: false },
                exporting: { enabled: true },
                series: [{ name: 'Valores', data:valor, dataLabels: {
                        enabled: true,
                        //rotation: -90,
                        align: 'top',
                        format: '{point.y:.0f}', // one decimal
                        y: 1, // 10 pixels down from the top
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }}]
                });
            }).error(function(xhr, ajaxOptions, thrownError) {
                $('#contenedor_graf_pendiente_reag').html(xhr.responseText)
            });
        }
    </script>
    
  </body>
</html>