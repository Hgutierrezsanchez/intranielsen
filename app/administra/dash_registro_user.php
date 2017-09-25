<head>
	<meta charset="utf-8">
</head>

<?php
    $linkt=conectar();

    $tarea=mysqli_query($linkt,"Select distinct nombre from tblperfiles");  
?>


    <section class="content-header">
        <h4>
        <i class="fa fa-user"></i> REGISTRO DE USUARIOS
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
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">REGISTROS</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">ACTUALIZAR</a></li>
                
                  <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                        <b>Ingrese Datos de Usuario</b>
                        <div id="bloque_registro"></div>
                        <div class="box box-info">
                            <form name="nuevo_usuario"  action="" method="POST" onsubmit="enviardatosusuario('Nuevo'); return false">
                                <div class="box-body col-sm-4">

                                    <div class="form-group">
                                        <input class="form-control" name="nombres" type="text" id="nombre" placeholder="Nombre Completo" required/>
                                        <input class="form-control" name="rut" type="text" id="rut" placeholder="Rut" required/>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" name="usuario" type="text" id="usuario" placeholder="Nombre de usuario" required/>
                                        <input class="form-control" name="pass" type="password" id="pass" placeholder="Password" required/>
                                        <input class="form-control" name="correo" type="email" id="correo" placeholder="E-Mail" required/>
                                    </div>

                                    <div class="form-group">
                                        <?php echo " <select name='perfil' id='perfil' class='form-control' >"; 
                                              echo "<option selected='selected'>Perfil predeterminado</option>";
                                              while($rs=mysqli_fetch_array($tarea)) { 
                                                 echo  "<option value='".utf8_encode($rs['nombre'])."'> ".utf8_encode($rs['nombre'])."</option>";
                                              } 
                                              echo  "<option value='Otro'>Otro</option>";
                                              echo   "</select>";
                                        ?>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input name="admin" type="checkbox" id="admin" /> Usuario Administrador
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="Submit" value="Grabar" />
                                        <input type="reset" name="Limpiar" value="Limpiar" />
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="bloque_registro"></div>
                    </div><!-- /.tab-pane -->
                    
                    <div class="tab-pane" id="tab_2-2">
                        <b>Seleccione Perfil para filtrar</b>
                        <div class="box box-info">
                            <?php
                                $tarea=mysqli_query($linkt,"Select distinct nombre from tblperfiles");  
                            ?>
                            
                            <div class="row">
                                <div class="box-body col-sm-4">
                                    <form name="filtra_usuario_perfil" action="" method="POST" onsubmit="consultausuarioperfil(); return false">
                                            <?php echo "<select name='perfil' id='perfil' onchange='consultausuarioperfil(); return false' class='form-control'>";
                                                  echo "<option selected='selected'>--</option>";
                                                  while($rs=mysqli_fetch_array($tarea)) { 
                                                        echo  "<option value='".utf8_encode($rs['nombre'])."'> ".utf8_encode($rs['nombre'])."</option>";
                                                    } 
                                                 echo  "<option value='Otro'>Otro</option>";
                                                 echo  "</select>";
                                            ?> 
                                            <input type="submit" name="Submit" value="Buscar" onclick="consultausuarioperfil(); return false" />
                                          
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive" id="bloque_listausuarios"></div>
                        </div>
                        
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
            
        </div><!-- /.box -->
    </section><!-- /.content -->   
   
   
   
    
