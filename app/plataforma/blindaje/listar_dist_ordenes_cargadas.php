<?php
    
    
    
    $nuevafecha = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;
    $fecha_24 = date ( 'Ymd' , $nuevafecha );
    
    
    
    $link=conectar();
    //Dia Anterior
    $sql="select codi_horario,count(*) q from tbl_pendiente_blindaje_temp where fecha_compromiso='$fecha_24' and ubicacion='Nivel 1' group by codi_horario";
    $query=mysqli_query($link,$sql);
    if (mysqli_num_rows($query)>0)
    {
        echo "<b>Pendientes por distribuir desde archivo cargado dia anterior</b>";
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
                        echo "<td>". $row ->codi_horario ."</td>";
                        echo "<td align='right'>". $row ->q ."</td>";
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

        echo "<a href='#' onclick=\"distribuye_ordenes_blind_cargadas('Nivel 1','AYER');\"><button class='btn btn-block btn-success btn-xs'>Distribuir Ordenes</button></a>";
    }
    mysqli_free_result($query);


    $sql="select codi_horario,count(*) q from tbl_pendiente_blindaje_temp where fecha_compromiso=date(now()) and ubicacion='Nivel 1' group by codi_horario";
    $query=mysqli_query($link,$sql);
    if (mysqli_num_rows($query)>0)
    {
        echo "<b>Pendientes por distribuir desde archivo cargado hoy</b>";
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
                        echo "<td>". $row ->codi_horario ."</td>";
                        echo "<td align='right'>". $row ->q ."</td>";
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

        echo "<a href='#' onclick=\"distribuye_ordenes_blind_cargadas('Nivel 1','HOY');\"><button class='btn btn-block btn-success btn-xs'>Distribuir Ordenes</button></a>";
    }
    mysqli_free_result($query);

    mysqli_close($link);
?>