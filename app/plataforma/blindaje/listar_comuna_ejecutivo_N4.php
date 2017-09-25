<?php
$NIVEL='Nivel 4';
if(isset($_POST['comuna'])) { 
    include("../../../includes/conexion.php");
    $link=conectar();
    extract($_POST);
    
    echo '<table class="table table-bordered table-striped">';
        echo '<thead>';
            echo '<tr>'; 
                echo '<th>Ejecutivos</th>';
                echo '<th>Turno</th>';
                echo '<th>Asignadas</th>';
            echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
            $sql="SELECT nombre,idusuario,horaingreso,horasalida FROM tblusuario u inner join tblturnos t on t.rut=u.rut Where admin<>1 And t.fecha=date(now()) and upper(tarea)='BLINDAJE PROAC' And u.estado=1 order by horaingreso,nombre"; 
            $query=mysqli_query($link,$sql); 

            while($row = mysqli_fetch_object($query)){
                echo "<tr>";
                    echo "<td>";
                        echo "&nbsp;&nbsp;";
                        $sql="Select estado from tbl_blindaje_bloque_ejecutivo Where idusuario='".$row->idusuario."' and bloque='".$comuna."'";
                        $query_2=mysqli_query($link,$sql);
                        if (mysqli_num_rows($query_2))
                        {
                            $r_estado = mysqli_fetch_object($query_2);
                            if ($r_estado->estado == 1)
                                echo "<input type='checkbox' id='check-n4".$row->idusuario."' onclick=\"des_habilita_usuario_bloque('".$row->idusuario."','".$comuna."','".$NIVEL."')\" checked> &nbsp;";
                            else
                                echo "<input type='checkbox' id='check-n4".$row->idusuario."' onclick=\"des_habilita_usuario_bloque('".$row->idusuario."','".$comuna."','".$NIVEL."')\"> &nbsp;";  
                        }
                        else{
                            echo "<input type='checkbox' id='check-n4".$row->idusuario."' onclick=\"des_habilita_usuario_bloque('".$row->idusuario."','".$comuna."','".$NIVEL."')\"> &nbsp;";  
                        }
                        mysqli_free_result($query_2);
                        echo utf8_encode($row->nombre)."<br />";                
                    echo "</td>";
                    echo "<td>";
                        echo $row->horaingreso ." | ". $row->horasalida;    
                    echo "</td>";
                    echo "<td><div id='div-n4".$row->idusuario."' >";
                        $sql="select count(*) q from tbl_pendiente_blindaje where ejecutivo='$row->idusuario' and ubicacion='$NIVEL' and comuna='$comuna' and FINAL<>'FINALIZADA'";

                        $query_2=mysqli_query($link,$sql);
                        $q = mysqli_fetch_object($query_2);
                        echo $q->q;
                        mysqli_free_result($query_2);
                    echo "</div></td>";
                    echo "</tr>";
                }
                mysqli_free_result($query);
        echo '</tbody>';
    echo '</table>';    
    mysqli_close($link);
}
?>