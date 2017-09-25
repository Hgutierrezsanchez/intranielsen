<?php
//    if (isset($_POST['carga']))
//    {
//    include_once("../../../includes/conexion.php");
//    }
    $link=conectar();

    $sql="select comuna,count(*) q from tbl_pendiente_blindaje_temp where ubicacion='Nivel 2' group by comuna";
    $query=mysqli_query($link,$sql);
    if (mysqli_num_rows($query)>0)
    {
        echo "<b>Ordenes Pendientes por distribuir desde archivo cargado</b>";
        echo '<table>';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th>&nbsp;&nbsp;COMUNA&nbsp;&nbsp;</th>';
                        echo '<th>&nbsp;&nbsp;PENDIENTES&nbsp;&nbsp;</th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $total=0;
                while($row = mysqli_fetch_object($query)){
                    echo '<tr>';
                        echo "<td>". $row ->comuna ."</td>";
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

        echo "<a href='#' onclick=\"distribuye_ordenes_blind_cargadas('Nivel 2');\"><button class='btn btn-block btn-success btn-xs'>Distribuir Ordenes</button></a>";
    }
    mysqli_free_result($query);
    mysqli_close($link);
?>