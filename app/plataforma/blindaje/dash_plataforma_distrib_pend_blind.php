<head>
	<meta charset="utf-8">
</head>

<?php

$link=conectar();

?>

<div style="display: none;" id="cargador" align="center">
    <br>
    <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

    <img src="/intranielsen/img/cargando.gif" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

    <br>
    <hr style="color:#003" width="50%">
    <br>
</div>


<section class="content-header">
    <h4>
        <i class="fa fa-headphones"></i> PROCESO BLINDAJE
    </h4>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-rigth">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Distribución NIVEL 1</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab">Distribución NIVEL 2</a></li>
                    <li><a href="#tab_3-3" data-toggle="tab">Distribución NIVEL 4</a></li>
                    <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1"> 
                        <div class="box-body col-sm-6">
                            <b>Seleccione Bloque:&nbsp;&nbsp;</b>
                            <select id="select_bloque" onchange="listar_usuario_bloque();">
                                <option selected>--</option>
                                <?php
                                    $sql="select bloque from tbl_blindaje_bloques where nivel='Nivel 1' order by id";
                                    $query=mysqli_query($link,$sql);
                                    while($row = mysqli_fetch_object($query)){
                                        echo "<option> $row->bloque </option>";
                                    }
                                    mysqli_free_result($query);
                                    mysqli_close($link);
                                ?>
                            </select>
                            <div id="listar_bloque_ejecutivo" class="table-responsive">
                            </div>
                        </div>
                        
                        <div class="box-body col-sm-6">
                            <div id="bloque_div_cargadas">
                                <?php
                                    include('blindaje/listar_dist_ordenes_cargadas.php');
                                ?>
                            </div>
                            <br/>
                            <div id="bloque_div_sin_asignar">
                                <?php    
                                    include('blindaje/listar_dist_ordenes_sinasignar.php');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2-2">
                        <div class="box-body col-sm-6">
                            <b>Seleccione comuna:&nbsp;&nbsp;</b>
                            <select id="select_comuna" onchange="listar_usuario_comuna();">
                                <option selected>--</option>
                                <?php
                                    $sql="select comuna from tbl_blindaje_comunas order by comuna";
                                    $link=conectar();
                                    $query=mysqli_query($link,$sql);
                                    while($row = mysqli_fetch_object($query)){
                                        echo "<option> $row->comuna </option>";
                                    }
                                    mysqli_free_result($query);
                                    mysqli_close($link);
                                ?>
                            </select>
                            <div id="listar_comuna_ejecutivo" class="table-responsive">
                            </div>
                        </div>
                        
                        <div class="box-body col-sm-6">
                            <div id="bloque_div_cargadas_n2">
                                <?php
                                    include('blindaje/listar_dist_ordenes_cargadas_n2.php');
                                ?>
                            </div>
                            <br/>
                            <div id="bloque_div_sin_asignar_n2">
                                <?php    
                                    include('blindaje/listar_dist_ordenes_sinasignar_n2.php');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_3-3">
                        <div class="box-body col-sm-6">
                            <b>Seleccione comuna:&nbsp;&nbsp;</b>
                            <select id="select_comuna_n4" onchange="listar_usuario_comuna_N4();">
                                <option selected>--</option>
                                <?php
                                    $sql="select comuna from tbl_blindaje_comunas order by comuna";
                                    $link=conectar();
                                    $query=mysqli_query($link,$sql);
                                    while($row = mysqli_fetch_object($query)){
                                        echo "<option> $row->comuna </option>";
                                    }
                                    mysqli_free_result($query);
                                    mysqli_close($link);
                                ?>
                            </select>
                            <div id="listar_comuna_ejecutivo_n4" class="table-responsive">
                            </div>
                        </div>
                        
                        <div class="box-body col-sm-6">
                            <div id="bloque_div_cargadas_n4">
                                <?php
                                    include('blindaje/listar_dist_ordenes_cargadas_n4.php');
                                ?>
                            </div>
                            <br/>
                            <div id="bloque_div_sin_asignar_n4">
                                <?php    
                                    include('blindaje/listar_dist_ordenes_sinasignar_n4.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>