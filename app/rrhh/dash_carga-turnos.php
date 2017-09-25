<head>
	<meta charset="utf-8">
</head>

<section class="content-header">
    <h4>
        <i class="fa fa-th"></i> CARGA TURNOS
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
                    <li class="active"><a href="#tab_2-2" data-toggle="tab">Importar (.xlsx):</a></li>
                    <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <div class="box-body col-sm-8">
                        
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Seleccione Archivo</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        </span>

                        
                        <br>
                        <!-- The global progress bar -->
                        <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <!-- The container for the uploaded files -->
                        <div style="display: none;" id="cargador" align="center">
                            <br>
                            <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

                            <img src="/intranielsen/img/cargando.gif" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

                            <br>
                            <hr style="color:#003" width="50%">
                            <br>
                        </div>
                        <div id="carga_archivo"></div>
                        </div>
                        <div class="box-body col-sm-4">
                        <span><b>Formato de Archivo</b>
                        <p>Col A -> Rut</p>
                        <p>Col B -> Tarea a Ejecutar</p>
                        <p>Col C -> Fecha Asistencia</p>
                        <p>Col D -> Hora de Ingreso</p>
                        <p>Col E -> Hora de Salida</p>
                        <p>Col F -> Número de Semana</p>
                        <p>Col G -> Horas Diarias Asignadas</p>
                        <p>Col H -> Tiempo de Colación Asignado</p>
                        </span>
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
    </div>
</section>