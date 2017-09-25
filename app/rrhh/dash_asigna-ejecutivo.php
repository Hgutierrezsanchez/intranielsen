<head>
	<meta charset="utf-8">
</head>

<?php
 
    $link=conectar();

    $tarea=mysqli_query($link,"Select distinct nombre from tblperfiles");  

?>
<section class="content-header">
    <h4>
    <i class="fa fa-th"></i> ASIGNAR EJECUTIVOS
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
                  <li class="active"><a href="#tab_2-2" data-toggle="tab">Seleccione perfil para filtrar</a></li>
                
                  <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    
                        <form name="filtra_usuario_perfil" action="" method="POST" onsubmit="consulta_carga(); return false">
                            <label>	
                                <?php echo "<select name='perfil' id='perfil' onchange='consulta_carga(); return false'>"; ?>
                                <?php echo "<option selected='selected'>--</option>"; ?>
                                <?php while($rs=mysqli_fetch_array($tarea)) { 
                                            echo  "<option value='".utf8_encode($rs['nombre'])."'> ".utf8_encode($rs['nombre'])."</option>";
                                        } 
                                echo   "</select>";
                                ?>
                                
                            </label>
                            <input type='button' name='Submit' value='Consultar' id='submit' onclick="consulta_carga(); return false"/>
                        </form>
                        <div id="resultado"></div>
                    
                  </div><!-- /.tab-pane -->
                  </div>
                 </div>
              </div>
            </div>
    </section>
<?php
    mysqli_close($link);
?>