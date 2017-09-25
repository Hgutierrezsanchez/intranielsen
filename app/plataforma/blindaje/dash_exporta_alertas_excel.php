<head>
	<meta charset="utf-8">
</head>
<?php
    
    $link=conectar();
?>
<section class="content-header">
    <h4>
        <i class="fa fa-headphones"></i> PLATAFORMA
    </h4>
</section>

<section class="content">
   <?php 
        $sql="select bloque from tbl_blindaje_bloques where desde<=time(now()) and hasta>=time(now()) and vista='Hoy'";
        $query=mysqli_query($link,$sql);
        $r_bloque=mysqli_fetch_object($query);
        mysqli_free_result($query);
        $sql="select bloque,desde,hasta from tbl_blindaje_bloques where desde<=time(now()) and hasta<=time(now()) and vista='Hoy' order by desde desc limit 1";
        $query=mysqli_query($link,$sql);
        $r_bloque_ant=mysqli_fetch_object($query);
        mysqli_free_result($query);
    ?>
    <div class="box-body">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Alertas Nivel 1 BLINDAJE HOY</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Incumplimiento</span>
                            <span class="info-box-text">Hasta Fecha seleccionada:</span>
                            <?php echo "<input id='ayer_n1' type='date' value='".date('Y-m-d',strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ))."' >";?>
                            <p />
                            <a href="#" onclick="exporta_excel_blindaje('Nivel 1','INCUMPLIMIENTO_AYER',document.getElementById('ayer_n1').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Riesgo</span>
                            <span class="info-box-text">Bloque actual:</span>
                            <?php echo "<input id='bloque_act_n1' type='text' value='$r_bloque->bloque' readonly>";?>
                            <p />
                            <a href="#" onclick="exporta_excel_blindaje('Nivel 1','RIESGO',document.getElementById('bloque_act_n1').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Incumplimiento</span>
                            <span class="info-box-text">Hasta Bloque actual:</span>
                            <?php echo "<input id='bloque_ant_n1' type='text' value='$r_bloque_ant->bloque' readonly>";?>
                            <p />
                            <a href="#" onclick="exporta_excel_blindaje('Nivel 1','INCUMPLIMIENTO',document.getElementById('bloque_ant_n1').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Reagendamientos Autodetectadas</span>
                            <span class="info-box-text">Detectados el:</span>
                            <?php echo "<input id='bloque_reg' type='date' value='".date('Y-m-d')."' >";?>
                            <p />
                            <a href="#" onclick="exporta_excel_blindaje('TODAS','REAGENDAMIENTO',document.getElementById('bloque_reg').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div>
        </div><!-- /Nivel 1 --> 
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Alertas Nivel 2 ATRASADAS</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Incumplimiento</span>
                            <span class="info-box-text">Hasta Fecha seleccionada:</span>
                            <?php echo "<input id='ayer_n2' type='date' value='".date('Y-m-d',strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ))."' >";?>
                            <p />
                            <a href="#" onclick="exporta_excel_blindaje('Nivel 2','INCUMPLIMIENTO_AYER',document.getElementById('ayer_n2').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->

                </div>
            </div>
        </div><!-- /nivel 2 -->  
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Alertas Nivel 4 PROACTIVIDAD</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Incumplimiento</span>
                                <span class="info-box-text">Hasta Fecha seleccionada:</span>
                                <?php echo "<input id='ayer_n4' type='date' value='".date('Y-m-d',strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ))."'>";?>
                                <p />
                                <a href="#" onclick="exporta_excel_blindaje('Nivel 4','INCUMPLIMIENTO_AYER',document.getElementById('ayer_n4').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Riesgo</span>
                                <span class="info-box-text">Bloque actual:</span>
                                <?php echo "<input id='bloque_act_n4' type='text' value='$r_bloque->bloque' readonly>";?>
                                <p />
                                <a href="#" onclick="exporta_excel_blindaje('Nivel 4','RIESGO',document.getElementById('bloque_act_n4').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Incumplimiento</span>
                                <span class="info-box-text">Hasta Bloque actual:</span>
                                <?php echo "<input id='bloque_ant_n4' type='text' value='$r_bloque_ant->bloque' readonly>";?>
                                <p />
                                <a href="#" onclick="exporta_excel_blindaje('Nivel 4','INCUMPLIMIENTO',document.getElementById('bloque_ant_n4').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-android-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Exportar Finalizadas</span>
                                <span class="info-box-text">En Fecha compromiso Seleccionada:</span>
                                <?php echo "<input id='Fecha_fin_n4' type='date' value='".date('Y-m-d',strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ))."'>";?>
                                <p />
                                <a href="#" onclick="exporta_excel_blindaje('Nivel 4','FINALIZADAS',document.getElementById('Fecha_fin_n4').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div>
        </div><!-- /nivel 4 -->  
        
    </div>   
</section>
<?php
    mysqli_close($link);
?>