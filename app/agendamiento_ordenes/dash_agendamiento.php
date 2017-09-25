<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

    <section class="content-header">
        <h4>
            <i class="fa fa-headphones"></i> AGENDAMIENTOS @BLIND
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
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">AGENDAMIENTOS</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">REPORTES</a></li>
                  <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    
                    <b>Seleccione Fecha para Agendar</b>
                    <form role="form" name="form_busca_bloque" action="" method="POST" onsubmit="buscar_bloque(); return false">
                    <table border="0">
                        <tr>
                            <td>Fecha:&nbsp;&nbsp;
                               
                               <input name="fecha_agen" type="date" id="fecha_agen" value="<?php echo date('Y-m-d'); ?>" />
                               
                                &nbsp;&nbsp;Comuna:&nbsp;&nbsp;
                                <select id="comuna" name="comuna" required>
                                <option value='TODAS'>TODAS</option>
                                <option value='Huechuraba'>Huechuraba</option>
                                <option value='Las Condes'>Las Condes</option>
                                <option value='La Reina'>La Reina</option>
                                <option value='Lo Barnechea'>Lo Barnechea</option>
                                <option value='Providencia'>Providencia</option>
                                <option value='Ñuñoa'>Ñuñoa</option>
                                <option value='Vitacura'>Vitacura</option>
                                </select>

                                &nbsp;&nbsp;&nbsp;&nbsp;
                                
                                <input type="submit" name="Submit" value="Buscar Bloque" />&nbsp;&nbsp;&nbsp; 
                                
                                <a style="text-decoration:underline;cursor:pointer;" onclick="listar_ordenes_blank(document.forms[0].fecha_agen.value,'TODOS',document.forms[0].comuna.value)" class='btn btn-primary start'>Ver Agendados</a><br />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <div id="bloque_agendamiento"></div>
                    
                    
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                   
                    <form role="form" name="form_cargar_tabla">
                       <div style="">
                        Desde:&nbsp;&nbsp;<input name="fecha_desde" type="date" id="fecha_desde" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        Hasta:&nbsp;&nbsp;<input name="fecha_hasta" type="date" id="fecha_hasta" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;
                        
                        <a href="#" onclick="cargar_archivo(document.forms[1].fecha_desde.value,document.forms[1].fecha_hasta.value,'<?php echo $_SESSION['iduser']; ?>');refrescar('<?php echo $_SESSION['iduser']; ?>');" class="dt-button buttons-print">Consultar</a>
                        
                        </div>
                    </form>
                    <br />
                    <div class="table-responsive">
                    <table id="tabla_ordenes_agendadas" class="table table-bordered table-striped">
                        <thead>
                        <tr style="background:#99CCCC;">
                            <th>Comuna</th>
                            <th>Casilla</th>
                            <th>Usuario</th>
                            <th>N° Orden</th>
                            <th>Rut Cliente</th>
                            <th>Observación</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            vacia_tabla_agendamientos($_SESSION['iduser']);
                            
                            //while($row = mysqli_fetch_array($sql)){
                            //echo "	<tr>";
                            //echo " 		<td>".$row['comuna']."</td>";
                            //echo " 		<td>".$row['bloque']."</td>";
                            //echo " 		<td>".ucfirst(strtolower($row['nombre']))."</td>";
                            //echo " 		<td>".$row['norden']."</td>";
                            //echo " 		<td>".$row['rut_cliente']."</td>";
                            //echo " 		<td>".$row['observacion']."</td>";
                            //echo "	</tr>";
                            //}
                            //mysqli_close($linkc);
                        ?>
                        </tbody>
                    </table>
                    </div>
                    
                    
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
              
            </div>
        
        </div><!-- /.box -->
    </section><!-- /.content -->
    
<?php
function vacia_tabla_agendamientos($usuario){
    
    $json = array(
        "aaData"=>array(
            array(
                "Sin Datos",
                "",
                "",
                "",
                "",
                "",""
            )
        )
    );
    
    $jsonencoded = json_encode($json,JSON_UNESCAPED_UNICODE);

    $fh = fopen("../../app/agendamiento_ordenes/base_tabla_agendamientos_".$usuario.".php", 'w');
    fwrite($fh, $jsonencoded);
    fclose($fh);
}
?>