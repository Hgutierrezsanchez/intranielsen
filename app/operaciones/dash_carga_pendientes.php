<head>
	<meta charset="utf-8">
</head>

<section class="content-header">
    <h4>
        <i class="fa fa-th"></i> CARGA DE PENDIENTES
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
                                <p>Col A -> IDEN_TRANSAC</p>
                                <p>Col B -> IDEN_SERVICIO</p>
                                <p>Col C -> FECHA_INGRESO</p>
                                <p>Col D -> TIPO</p>
                                <p>Col E -> MOTIVO</p>
                                <p>Col F -> CODIGO_VENDEDOR</p>
                                <p>Col G -> IDEN_USERING</p>
                                <p>Col H -> RUT_TECNICO</p>
                                <p>Col I -> CLAS_SERVICIO</p>
                                <p>Col J -> RUT_PERSONA</p>
                                <p>Col K -> NMRO_SERVICIO</p>
                                <p>Col L -> CODI_TECNOLOGIA</p>
                                <p>Col M -> IDEN_VIVIENDA</p>
                                <p>Col N -> LOCALIDAD</p>
                                <p>Col O -> NODO</p>
                                <p>Col P -> SUBNODO</p>
                                <p>Col Q -> CODI_AREAFUN</p>
                                <p>Col R -> TIPO_ACTIV</p>
                                <p>Col S -> FECHA_COMPROMISO</p>
                                <p>Col T -> HORARIO_COMPROMISO</p>
                            </span>
                        </div>
                        <div class="box-body col-sm-3">
                        <span>
                            <p>Col U -> CODI_CLAVEFIN</p>
                            <p>Col V -> OBSERVACION</p>
                            <p>Col W -> TIPO_ORDEN</p>
                            <p>Col X -> GRUPOTEC</p>
                            <p>Col Y -> DESC_ACTIV</p>
                            <p>Col Z -> GRUPO</p>
                            <p>Col AA -> CODI_PERTENECE</p>
                            <p>Col AB -> CLASIFACTIV</p>
                            <p>Col AC -> TIEMPO</p>
                            <p>Col AD -> TRAMO_PDTE</p>
                            <p>Col AE -> AG</p>
                            <p>Col AF -> TR</p>
                            <p>Col AG -> TERRITORIO</p>
                            <p>Col AH -> DIGITAL</p>
                            <p>Col AI -> RUT_PERSONA2</p>    
                            <p>Col AJ -> LOCALIDAD2</p>    
                            <p>Col AK -> Q_RECO</p>    
                            <p>Col AL -> REAGENDAMIENTO</p>    
                            <p>Col AM -> REAGENDAMIENTO_FINAL</p>    
                            <p>Col AN -> CLASIFICACION_ACTIVIDAD</p>    
                        </span>
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
    </div>
</section>