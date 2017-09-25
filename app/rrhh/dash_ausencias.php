<head>
	<meta charset="utf-8">
</head>

<?php

$link=conectar();
$user=mysqli_query($link,"Select rut,nombre from tblusuario where admin=0 and estado=1 order by nombre");  

?>
    <section class="content-header">
        <h4>
            <i class="fa fa-th"></i> REGISTRO DE AUSENCIAS
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
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Ingrese Datos para Registrar</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Reporte</a></li>
                  <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <div id="otros"></div>
                    <form role="form" name="inasistencia" action="" method="POST" onsubmit="guardar(); return false">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>Nombre</td>
                                <td>
                                    <?php echo "<select name='datos' id='datos' required>"; ?>
                                    <?php echo "<option selected='selected'></option>"; ?>
                                    <?php while($rs=mysqli_fetch_array($user))
                                        { 
                                            echo  "<option value='".$rs['rut']."'> ".utf8_encode($rs['nombre'])."</option>";
                                        } 
                                    echo   "</select>";
                                    ?>        
                                </td>
                            </tr>
                            <tr>
                                <td>Tipo inasistencia</td>
                                <td>
                                    <SELECT id="inasistencias" NAME="inasistencias" SIZE="auto" required> 
                                    <option selected='selected'></option>
                                    <OPTION>Con Licencia</OPTION>
                                    <OPTION>Falta con Permiso</OPTION>
                                    <OPTION>Falta sin Permiso</OPTION> 
                                    <OPTION>Vacaciones</OPTION>
                                    </SELECT>
                                </td>
                            </tr>
                            <tr>
                                <td>Descripcion</td>
                                <td><textarea id="descripcion" name="descripcion" maxlength="100" rows="8" cols="30" wrap="soft" required></textarea></td>
                            </tr>
                            <tr>
                                <td>Desde</td>
                                <td><input name="iddesde" type="date" id="iddesde" size="auto" value="<?php echo date('Y-m-d');?>" size="10"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Hasta</td>
                                <td>
                                    <input name="idhasta" type="date" id="idhasta" size=auto value="<?php echo date('Y-m-d');?>" size="10"/>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="Submit" value="guardar"></td>
                            </tr>
                        </table>
                    </form>
                    
                    </div>
                    <div class="tab-pane" id="tab_2-2">
                        <p>Fecha de Creacion:</p>
                        <form role="form" name="form_buscar_ausencia" action="POST">
                        Desde:&nbsp;&nbsp;<input name="fecha_desde" type="date" id="fecha_desde" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;

                        Hasta:&nbsp;&nbsp;<input name="fecha_hasta" type="date" id="fecha_hasta" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="dt-button buttons-print" href="#" onclick="buscar_ausencias();">Consultar</a>
                        </form> 
                        <div id="motrar_tabla"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    mysqli_close($link);
?>      