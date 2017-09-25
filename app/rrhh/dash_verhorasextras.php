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
                    <li class="active"><a href="#tab_2-2" data-toggle="tab">Seleccione Estado</a></li>
                    <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <form name="form_estado" action="" method="POST">
                            <table>
                            <tr>
                                <td>Estado:</td>
                                <td>&nbsp;&nbsp;&nbsp;Fecha de Creacion:</td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <SELECT id="estado" NAME="estado" SIZE=auto border="1"> 
                                    <OPTION value="aprobado"> APROBADAS</OPTION> 
                                    <OPTION value="pendiente"> PENDIENTES</OPTION>
                                    <OPTION value="rechazado"> RECHAZADAS</OPTION> 
                                    </SELECT>
                                </td>
                                <td>
                                    &nbsp;&nbsp;
                                    Desde: <input name="fecha_desde" type="date" id="fecha_desde" value="<?php echo date('Y-m-d'); ?>" />
                                    &nbsp;
                                    Hasta: <input name="fecha_hasta" type="date" id="fecha_hasta" value="<?php echo date('Y-m-d'); ?>" />
                                    &nbsp;
                                </td>
                                <td>
                                    <input type="submit" name="Submit" value=" Cargar " onclick="consultarestado(); return false" />
                                </td>
                            </tr>
                            </table>
                        </form>

                        <div id="divverreg"></div>

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
    </div>
</section>
