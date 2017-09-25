<head>
	<meta charset="utf-8">
</head>

<?php
    
    $linkc=conectar();

    $iduser=$_SESSION['iduser'];
    $fecha=date("Ymd");

    $sql=mysqli_query($linkc,"select nombre,t.fecha,tarea,horaingreso,horasalida,u.rut,idusuarioejecutivo,hdiarias,tiempocolacion,nsemana from (tblsuperejecutivo se inner join tblusuario u on se.idusuarioejecutivo=u.idusuario and se.idusuariosuper='$iduser') left join tblturnos t on u.rut=t.rut And t.fecha=$fecha where u.estado=1 order by nombre,tarea");

?>

<section class="content-header">
    <h4>
    <i class="fa fa-th"></i> VER TURNOS EQUIPOS ASIGNADO.
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
                  <li class="active"><a href="#tab_2-2" data-toggle="tab"><?php $fecha ?>Ejecutivos</a></li>
                
                  <li class="pull-left header"></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <div class="callout callout-info">
                       <h4>Turnos de Ejecutivos Asignados, 
                        <?php 
                            echo "Hoy: ".date("d-m-Y"); 
                        ?>
                        </h4>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                       <thead>
                        <tr>
                            <th>N°Semana</th>
                            <th>Ejecutivo</th>
                            <th>Tarea</th>
                            <th>Hora Ingreso</th>
                            <th>Hora Salida</th>
                            <th>Min.Colación</th>
                            <th>Horas Diarias</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row = mysqli_fetch_array($sql)){
                                echo "	<tr>";
                                echo " 		<td>".$row['nsemana']."</td>";
                                echo "<td><a alt='ver turnos de Ejecutivo' style=\"text-decoration:underline;cursor:pointer;\" onclick=\"cargaturnoejecutivo_blank('".$row['idusuarioejecutivo']."','".date('Y-m-d')."')\">".utf8_encode($row['nombre'])."</a></td>";
                                echo "<td>";
                                    if ($row['tarea']==NULL){
                                        echo "SIN TURNO ASIGNADO";
                                    }else{
                                        echo $row['tarea'];
                                    }
                                "</td>";

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
                        ?>
                        </tbody>
                    </table>
                    </div>
                  </div><!-- /.tab-pane -->
             </div>
            </div>
        </div>
    </div>
</section>                 
  
    