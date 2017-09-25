<head>
	<meta charset="utf-8">
</head>
<?php
$linkc=conectar();


$iduser=$_SESSION['iduser'];


$fecha=date("Ymd");

$sql=mysqli_query($linkc,"SET lc_time_names = 'es_UY'");
$sql=mysqli_query($linkc,"SELECT t.tarea,DATE_FORMAT(t.fecha, '%W, %d de %M del %Y') as fechaf,t.horaingreso,t.horasalida,hdiarias,tiempocolacion,nsemana FROM tblturnos t inner join tblusuario u on t.rut=u.rut where u.idusuario='$iduser' And Fecha>=$fecha limit 14");
?>

    <section class="content-header">
        <h4>
            <i class="fa fa-th"></i> TURNO ASIGNADO
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
                  <li class="active"><a href="#tab_1-1" data-toggle="tab"><?php echo "Usuario: ".$iduser; echo " -  Fecha: ".date("d-m-Y");   ?></a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">BUSCAR HORARIOS</a></li>
                  <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                       <div class="callout callout-info"><h4>Los turnos pueden estar afectos a cambios, favor revisar continuamente</h4></div>
                       <div class="table-responsive">
                        <table class="table table-bordered table-striped" >
                           <thead>
                            <tr>
                                <th>N°Semana</th>
                                <th>Tarea</th>
                                <th>Fecha</th>
                                <th>Hora Ingreso</th>
                                <th>Hora Salida</th>
                                <th>Min.Colación</th>
                                <th>Horas Diarias</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                while($row = mysqli_fetch_array($sql)){
                                    $fechaf=utf8_encode($row['fechaf']);
                                    echo "	<tr>";
                                    echo " 		<td>".$row['nsemana']."</td>";
                                    echo " 		<td>".$row['tarea']."</td>";
                                    echo " 		<td>".$fechaf."</td>";
                                    if ($row['horaingreso']=="00:00:00"){
                                        echo " 		<td>LIBRE</td>";
                                        echo " 		<td>LIBRE</td>";
                                    }else{
                                        echo " 		<td>".$row['horaingreso']."</td>";
                                        echo " 		<td>".$row['horasalida']."</td>";
                                    }

                                    echo " 		<td>".$row['tiempocolacion']."</td>";
                                    echo " 		<td>".$row['hdiarias']."</td>";
                                    echo "	</tr>";
                                }
                                mysqli_close($linkc);

                                echo "</table>";

                                echo "</center>";
                            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2-2">

                        <form role="form" name="form_cargar_tabla" action="POST">
                        Desde:&nbsp;&nbsp;<input name="fecha_desde" type="date" id="fecha_desde" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;

                        Hasta:&nbsp;&nbsp;<input name="fecha_hasta" type="date" id="fecha_hasta" value="<?php echo date('Y-m-d'); ?>" />
                                
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="dt-button buttons-print" href="#" onclick="carga_fecha_turno_propio('<?php echo $iduser;?>');">Consultar</a>
                        </form> 
                        <div id="motrar_tabla"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>