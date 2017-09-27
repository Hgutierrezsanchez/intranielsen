<head>
    <meta charset="utf-8">
</head>
    <section class="content-header">
        <h4>
            <i class="fa fa-user"></i> REGISTRO DE NOTICIAS
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
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">REGISTRAR NOTICIAS</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">MODIFICAR</a></li>

                        <li class="pull-left header"></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <b>Ingrese Datos de Noticia</b>
                            <div id="bloque_registro"></div>
                            <div class="box box-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8" id="main">
                                            <form name="carganoti" action="" method="POST">
                                                <div class="form-group">
                                                    <label for="titulo">Titulo:</label>
                                                    <input type="text" class="form-control" id="titulo" placeholder="Titulo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dcorta">Descripcion corta:</label>
                                                    <textarea class="form-control" rows="2" id="dcorta" placeholder="Aqui debe ingresar un resumen de la noticia." required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="dlarga">Descripcion Larga:</label>
                                                    <textarea class="form-control" rows="5" id="dlarga" placeholder="Aqui debe ingresar el cuerpo de la noticia." required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="importancia">Seleccione importancia:</label>
                                                    <select class="form-control" id="importancia">
                                                        <option value="importante1">slider1</option>
                                                        <option value="importante2">slider2</option>
                                                        <option value="importante3">slider3</option>
                                                        <option>No es importante</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" id="ori" value="<?php $from = $_GET['op']; echo $from; ?>">
                                                <center>
                                                    <button class="btn btn-secondary" type="submit" id="carga"><span>Cargar</span></button>
                                                </center>
                                            </form>
                                            <div id="resultado"></div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <hr>
                            </div>

                            <div id="bloque_registro"></div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_2-2">
                            <b>Listado de noticias</b>
                            <div class="box box-info">
                                <div class="container">
            <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th>Descripción Corta</th>
                <th>Descripción Larga</th>
                <th>Estatus</th>
                <th></th>
                <th>OPCIONES</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $link=conectar();
                            $dc=mysqli_query($link,"Select * from tbl_noticias_blog where origen='$from' Order By id DESC");         
                            while($titulo=mysqli_fetch_array($dc)){   
                echo "	<tr>";
               ?>
                           <td id="idd"><?php echo $titulo['id'] ?></td>
               <?php
                echo " 		<td id='titulo1'>".utf8_encode(strtolower($titulo['titulo']))."</td>";
                echo " 		<td>".utf8_encode(strtolower($titulo['Fecha']))."</td>";
                echo " 		<td id='dcorta1'>".utf8_encode(strtolower($titulo['dcorta']))."</td>";
                echo " 		<td id='dlarga1'>".utf8_encode(strtolower($titulo['dlarga']))."</td>";
                echo " 		<td id='importancia1'>".utf8_encode(strtolower($titulo['estatus']))."</td>";
                
                echo "         <td><a href=\"#\" onclick=\"updatenoticia('".$titulo['id']."')\"><button class='btn btn-block btn-success btn-xs'>Modificar Noticias</button></a></td>";
                if($titulo['estatus']!='off'){
                                echo "         <td id='act'><a href=\"#\" onclick=\"actualizaestadonoticia('".$titulo['id']."','".$titulo['estatus']."')\"><button id='botona' class='btn btn-block btn-warning btn-xs'>Desactivar Noticia</button></a></td>";
                    }else{
                                echo "         <td id='act'><a href=\"#\" onclick=\"actualizaestadonoticia('".$titulo['id']."','".$titulo['estatus']."')\"><button id='botond' class='btn btn-block btn-info btn-xs'>Activar Noticia</button></a></td>";
                }
                 echo "         <td><a href=\"#\" onclick=\"borrar('".$titulo['id']."')\"><button class='btn btn-block btn-danger btn-xs'>Eliminar Noticia</button></a></td>";
                echo "  </tr>";
            }
            mysqli_close($link);
            ?>
        </tbody>
    </table>
    </div>
</div>

                                    <div class="table-responsive" id="bloque_listausuarios"></div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
