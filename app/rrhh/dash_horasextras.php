<head>
	<meta charset="utf-8">
</head>

<section class="content-header">
    <h4>
        <i class="fa fa-th"></i> HORAS EXTRAS
    </h4>
</section>

<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <div class="box-body">

            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-rigth">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Ingrese datos</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab">Ver Horas Extras Gestionadas</a></li>
                    <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        
                        <table class="table table-bordered table-striped">
                            <form role="form" name="form_buscar_ejecutivo" action="" method="POST" onsubmit="cargar_nombre('<?php echo date('Y-m-d'); ?>'); return false" >
                                <tr>
                                    <td>Rut</td>
                                    <td><input type="text" name="rut" required>
                                        <input type="submit" name="Submit" value=" Cargar " size="5" >
                                    </td>
                                <tr>
                            </form>
                            <form role="form" name="form_horas" action="" method="POST" onsubmit="guardarhorasextras(); return false">
                                <tr>
                                    <td>Nombre</td>
                                    <td><div id="nombre" name="nombre"></div></td>
                                </tr>
                                <tr>
                                    <td>Fecha</td>
                                    <td>
                                        <input name="fecha" type="date" id="fecha" size="auto" value="<?php echo date('Y-m-d'); ?>" onchange="cargar_nombre(document.forms[1].fecha.value); return false">
                                        <div id="turno"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Desde</td>
                                    <td>
                                        <input name="h_desde" type="time" id="h_desde" value="<?php echo date('G:h'); ?>" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Hasta</td>
                                    <td>
                                        <input name="h_hasta" type="time" id="h_hasta" value="<?php echo date('G:h'); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Motivo</td>
                                    <td><input name="motivo" type="text" size="60" maxlength="50" required></td>
                                </tr>
                                <tr>
                                    <td>Solicitante</td>
                                    <td>
                                       <input name="nombresolicitante" type="text" readonly="readonly" value="<?php echo $_SESSION['nombreusuario']; ?>">
                                        <input name="solicitante" type="hidden" readonly="readonly" value="<?php echo $_SESSION['iduser']; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><input type="submit" name="Submit" value=" Guardar "></td>
                                </tr>
                            </form>
                        </table>
                        <div id="divhorasextras"></div>
                        
                    </div>
                    <div class="tab-pane" id="tab_2-2">
                        <p>Fecha de Creacion:</p>
                        <form role="form" name="form_buscar_he" action="POST">
                        Desde:&nbsp;&nbsp;<input name="fecha_desde" type="date" id="fecha_desde" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;

                        Hasta:&nbsp;&nbsp;<input name="fecha_hasta" type="date" id="fecha_hasta" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="dt-button buttons-print" href="#" onclick="buscar_horas_extras();">Consultar</a>
                        </form> 
                        <div id="motrar_tabla"></div>

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
    </div>
</section>