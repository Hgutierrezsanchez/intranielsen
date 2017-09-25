<?php
    $nuevafecha = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;
    $fecha_24 = date ( 'Ymd' , $nuevafecha );

    $link=conectar();

    $sql="select codi_horario,count(*) q from tbl_pendiente_blindaje where ubicacion='Nivel 1' and fecha_compromiso='$fecha_24' and ejecutivo='' and final<>'FINALIZADA' group by codi_horario";
    $query=mysqli_query($link,$sql);
    if (mysqli_num_rows($query)>0)
    {

            echo "<b>Pendientes por distribuir sin ejecutivo asignado dia anterior</b>";
            echo '<table>';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>&nbsp;&nbsp;BLOQUE&nbsp;&nbsp;</th>';
                            echo '<th>&nbsp;&nbsp;PENDIENTES&nbsp;&nbsp;</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $total=0;
                    while($row = mysqli_fetch_object($query)){
                        echo '<tr>';
                            echo "<td>".$row ->codi_horario."</td>";
                            echo "<td align='right'>".$row ->q."</td>";
                        echo '</tr>';
                        $total+= $row ->q;
                    }
                    if ($total > 0){
                        echo '<tr>';
                            echo "<td><b>TOTAL</b></td>";
                            echo "<td align='right'><b>". $total ."</b></td>";
                        echo '</tr>';
                    }
                echo '</tbody>';
            echo '</table>';
            echo '<div class="row">';
                
                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                    echo "<a href='#' onclick=\"distribuye_ordenes_blind_usuario('Nivel 1','AYER')\"><button class='btn btn-block btn-success btn-xs'>Distribuir Ordenes</button></a>";
                echo "</div>";
                echo '<div class="col-md-6 col-sm-6 col-xs-12">';
                    echo "<a href='#' onclick=\"mover_sin_asignar_nivel('DISTRIBUCION','Nivel 1','Nivel 2','AYER')\"><button class='btn btn-block btn-success btn-xs'>Mover a Nivel 2</button></a>";
                echo "</div>";
            echo "</div>";
    }
    mysqli_free_result($query);
    
    $sql="select codi_horario,count(*) q from tbl_pendiente_blindaje where ubicacion='Nivel 1' and fecha_compromiso=date(now()) and ejecutivo='' and final<>'FINALIZADA' group by codi_horario";
    $query=mysqli_query($link,$sql);
    if (mysqli_num_rows($query)>0)
    {

            echo "<b>Pendientes por distribuir sin ejecutivo asignado hoy</b>";
            echo '<table>';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>&nbsp;&nbsp;BLOQUE&nbsp;&nbsp;</th>';
                            echo '<th>&nbsp;&nbsp;PENDIENTES&nbsp;&nbsp;</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $total=0;
                    while($row = mysqli_fetch_object($query)){
                        echo '<tr>';
                            echo "<td>".$row ->codi_horario."</td>";
                            echo "<td align='right'>".$row ->q."</td>";
                        echo '</tr>';
                        $total+= $row ->q;
                    }
                    if ($total > 0){
                        echo '<tr>';
                            echo "<td><b>TOTAL</b></td>";
                            echo "<td align='right'><b>". $total ."</b></td>";
                        echo '</tr>';
                    }
                echo '</tbody>';
            echo '</table>';
            echo "<a href='#' onclick=\"distribuye_ordenes_blind_usuario('Nivel 1','HOY')\"><button class='btn btn-block btn-success btn-xs'>Distribuir Ordenes</button></a>";
            

    }
    mysqli_free_result($query);
    mysqli_close($link);
?>