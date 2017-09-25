<head>
	<meta charset="utf-8">
</head>

<?php
if ( ! session_id() ) @ session_start();
$iduser=$_SESSION['iduser'];
echo "<input type='hidden' id='idusuario' value='$iduser'>";
?>

<section class="content-header">
    <h4>
        <i class="fa fa-headphones"></i> REVISION DE ORDENES PENDIENTES BLINDAJE
    </h4>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box">


        <div class="box-body">
            <ul class="nav nav-tabs pull-rigth">
                <li class="active"><a href="#tab_1-1" data-toggle="tab" onclick="buscar_ordenes_listar(document.getElementById('idusuario').value,document.getElementById('search').value);">Revisión de Ordenes</a></li>
                <li><a href="#tab_2-2" data-toggle="tab" onclick="listar_usuario_seguimiento(document.getElementById('idusuario').value,document.getElementById('search_s').value);">Seguimiento</a></li>
                <li><a href="#tab_4-4" data-toggle="tab" onclick="listar_usuario_futuras(document.getElementById('idusuario').value,document.getElementById('search_fu').value);">Futuras</a></li>
                <li><a href="#tab_9-9" data-toggle="tab" onclick="listar_usuario_finalizada(document.getElementById('idusuario').value,document.getElementById('search_f').value);">Finalizadas Hoy</a></li>
                <li><a href="#tab_5-5" data-toggle="tab">Buscar Orden</a></li>
								<li><a href="#tab_6-6" data-toggle="tab">Reagendamientos</a></li>
                <li class="pull-left header"></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <br/>
                    <section>
                        <input type="text" name="search" id="search" placeholder="Buscar..." onkeyup="buscar_ordenes_listar(document.getElementById('idusuario').value,document.getElementById('search').value);">

                        <a href="#" onclick="exporta_excel_blindaje_revision('BANDEJA_USUARIO','<?php echo $iduser;?>','N',document.getElementById('search').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                    </section>
                    <div id="ordenes_pendientes" class="table-responsive">
                        <?php include('blindaje/listar_ordenes_pendientes.php') ?>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-2">
                    <br/>
                    <section>
                        <input type="text" name="search_s" id="search_s" placeholder="Buscar..." onkeyup="listar_usuario_seguimiento(document.getElementById('idusuario').value,document.getElementById('search_s').value);">

                        <a href="#" onclick="exporta_excel_blindaje_revision('BANDEJA_USUARIO','<?php echo $iduser;?>','S',document.getElementById('search_s').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                    </section>
                    <div id="listar_ordenes_ejecutivo_seguimiento" class="table-responsive">
                    </div>
                </div>
                <div class="tab-pane" id="tab_4-4">
                    <br/>
                    <section>
                        <input type="text" name="search_fu" id="search_fu" placeholder="Buscar..." onkeyup="listar_usuario_futuras(document.getElementById('idusuario').value,document.getElementById('search_fu').value);">

                        <a href="#" onclick="exporta_excel_blindaje_revision('BANDEJA_USUARIO','<?php echo $iduser;?>','FU',document.getElementById('search_fu').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                    </section>
                    <div id="listar_ordenes_ejecutivo_futuras" class="table-responsive">
                    </div>
                </div>
                <div class="tab-pane" id="tab_9-9">
                    <br/>
                    <section>
                        <input type="text" name="search_f" id="search_f" placeholder="Buscar..." onkeyup="listar_usuario_finalizada(document.getElementById('idusuario').value,document.getElementById('search_f').value);">

                        <a href="#" onclick="exporta_excel_blindaje_revision('BANDEJA_USUARIO','<?php echo $iduser;?>','F',document.getElementById('search_f').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                    </section>
                    <div id="listar_ordenes_ejecutivo_finalizadas" class="table-responsive">
                    </div>
                </div>
                <div class="tab-pane" id="tab_5-5">
                    <br/>
                    <section>
                        <input type="text" name="search_o" id="search_o" placeholder="Buscar..." onkeyup="listar_usuario_buscar(document.getElementById('idusuario').value,document.getElementById('search_o').value);">

                        <a href="#" onclick="exporta_excel_blindaje_revision('BANDEJA_BUSCAR','<?php echo $iduser;?>','T',document.getElementById('search_o').value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                    </section>
                    <div id="listar_ordenes_buscar" class="table-responsive">
                    </div>
                </div>
								<div class="tab-pane" id="tab_6-6">
                    <br/>
                    <section>
                        <input type="text" name="search_r" id="search_r" placeholder="Buscar Orden"> <a href="#" onclick="mostrar_orden_reagendar(document.getElementById('search_r').value)" ><button class='btn btn-success btn-xs'> Buscar </button></a>
                    </section>
                    <div id="mostrar_orden_reagendar" class="table-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
