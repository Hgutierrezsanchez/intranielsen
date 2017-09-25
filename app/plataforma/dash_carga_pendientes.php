<head>
	<meta charset="utf-8">
</head>

<section class="content-header">
    <h4>
        <i class="fa fa-th"></i> CARGA DE PENDIENTES BLINDAJE
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
                        <div class="box-body col-sm-6">
                            <b>RECUERDE EFECTUAR DISTRIBUCION DE EJECUTUVOS PARA LOS BLOQUES ANTES DE CARGAR ARCHIVO</b>
                            <input id="fecha" type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                            
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
                        <div class="box-body col-sm-3">
                            <span><b>Formato de Archivo</b>
                                <p>Col A -> RUT</p>
                                <p>Col B -> DESC_ACTIV</p>
                                <p>Col C -> LOCALIDAD</p>
                                <p>Col D -> NMRO_ORDEN</p>
                                <p>Col E -> NMRO_ACTIV</p>
                                <p>Col F -> FECHA_CREACION</p>
                                <p>Col G -> FECHA_COMPROMISO</p>
                                <p>Col H -> FECHA_COMPROMISO2</p>
                                <p>Col I -> CODI_HORARIO</p>
                                <p>Col J -> FECHA_INGRESO</p>
                                <p>Col K -> CONTEXTO</p>
                                <p>Col L -> TIPO_ACTIV</p>
                                <p>Col M -> ESTD_ACTIV</p>
                                <p>Col N -> CODI_AREAFUN</p>
                                <p>Col O -> DESC_AREAFUN</p>
                                <p>Col P -> RUT_TECNICO</p>
                                <p>Col Q -> CODI_TECNICO</p>
                                <p>Col R -> NODO</p>
                                <p>Col S -> SUBNODO</p>
                                <p>Col T -> DIRECCION</p>
                            </span>
                        </div>
                        <div class="box-body col-sm-3">
                        <span>
                            <p>Col U -> FONO_CONTACTO</p>
                            <p>Col V -> OBSERVACION</p>
                            <p>Col W -> IDEN_VIVIENDA</p>
                            <p>Col X -> IDEN_SERVICIO</p>
                            <p>Col Y -> NMRO_SERVICIO</p>
                            <p>Col Z -> FONO</p>
                            <p>Col AA -> TV</p>
                            <p>Col AB -> INTERNET</p>
                            <p>Col AC -> FECHA_INGRESO_OT</p>
                            <p>Col AD -> FECHA_OT</p>
                            <p>Col AE -> HORA_OT</p>
                            <p>Col AF -> T</p>
                            <p>Col AG -> AREA_FUNCIONAL</p>
                            <p>Col AH -> AGENDAMIENTO_BLINDAJE</p>
                            <p>Col AI -> COMUNA</p>    
                            <p>Col AJ -> ZONA</p>    
                            <p>Col AK -> TIPO_CLIENTE</p>    
                            <p>Col AL -> ACTIVIDAD</p>    
                        </span>
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
    </div>
</section>