<head>
	<meta charset="utf-8">
</head>

<?php
    $link=conectar();
    $perfiles=mysqli_query($link,"Select distinct nombre from tblperfiles order by nombre");  
    $user=mysqli_query($link,"Select idusuario,nombre from tblusuario where admin=0 and estado=1 order by nombre");
?>

    <section class="content-header">
        <h4>
        <i class="fa fa-user"></i> PERFILES DE USUARIOS
        </h4>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-rigth">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">PERFILES PRIMARIOS</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">PERFILES USUARIOS</a></li>

                        <li class="pull-left header"></li>
                    </ul>
                    <div class="tab-content">
                        
                          <div class="tab-pane active" id="tab_1-1">
                           
                           
                            <b>Seleccione Perfil</b>
                            <form id="form_select_perfil" method="post" action="" name="form_select_perfil">  
                                <label>
                                <?php echo "<select name='select_perfil' onchange=lista_perfil_primario_check(); >";
                                      echo "<option selected='selected'>--</option>";
                                      while($rs=mysqli_fetch_array($perfiles)) { 
                                            echo  "<option value='".$rs['nombre']."'> ".utf8_encode($rs['nombre'])."</option>";
                                        } 
                                      echo "</select>";
                                ?>
                                </label>

                                <label>
                                    <input type='button' name='Submit' value='Consultar' id='submit' onclick="lista_perfil_primario_check(); return false"/>
                                    <input type='button' name='nuevoperfil' value='Nuevo perfil' id='nuevoperfil' onclick="nuevo_perfil_primario(); return false">
                                </label> 
                            </form>
                            <div id="bloque_perfil_primaro"></div>
                        </div>
                        
                        
                        <div class="tab-pane" id="tab_2-2">
                            <b>Seleccione Usuario</b>
                            <form id="form_usuario_perfil" method="post" action="" name="form_usuario_perfil">
                                <label>

                                   <?php echo "<select name=select_usuario_perfil onchange=listar_perfil_usuario_check(); >"; ?>
                                   <?php echo "<option selected='selected'>--</option>"; ?>
                                            <?php while($rs=mysqli_fetch_array($user)) { 
                                                echo  "<option value='".$rs['idusuario']."'> ".utf8_encode($rs['nombre'])."</option>";
                                            } 
                                        echo   "</select>";
                                    ?>
                                </label> 
                                <label> 				
                                   <input type='button' name='Submit' value='Buscar' id='submit' onclick="listar_perfil_usuario_check(); return false"/>
                               </label> 
                            </form>
                            <div id="bloque_perfil_usuario"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </section>
<?php
mysqli_close($link);
?>