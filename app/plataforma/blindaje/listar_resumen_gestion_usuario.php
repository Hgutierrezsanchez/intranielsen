
<?php
if (isset($_POST['iduser'])){
    $iduser=$_POST['iduser'];
}else{
    if ( ! session_id() ) @ session_start();
    $iduser=$_SESSION['iduser'];
}

$sql_where="";
if (isset($_POST['filtro'])){
    
    if ($_POST['filtro'] == 'ATRASADAS'){
        $sql_where=" And FECHA_COMPROMISO<date(now()) ";
    }elseif ($_POST['filtro'] == 'HOY'){
        $sql_where=" And FECHA_COMPROMISO=date(now()) ";
    }elseif ($_POST['filtro'] == 'FUTURAS'){
        $sql_where=" And FECHA_COMPROMISO>date(now()) ";
    }
}

if ( ! session_id() ) @ session_start();
if (empty($_SESSION['iduser']))
{
    header("location:/intranielsen/index.php");
}
else
{

include_once("../../../includes/conexion.php");
$link=conectar();

?>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>FINAL</th>
                        <th>GESTION HD</th>
                        <th>ESTADO REAL</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="Select FINAL,GESTION_HD,ESTADO_REAL,count(*) Q from tbl_pendiente_blindaje where ejecutivo='$iduser' $sql_where group by Final,Gestion_hd,estado_real";
                        $query =  mysqli_query($link,$sql);
                        while($r_pend = mysqli_fetch_object($query)){
                            echo"<tr>";
                            echo "<td>$r_pend->FINAL</td>";
                            echo "<td>$r_pend->GESTION_HD</td>";
                            echo "<td>$r_pend->ESTADO_REAL</td>";
                            echo "<td>$r_pend->Q</td>";
                            echo"</tr>";
                        }
                    ?>
                </tbody>
            </table>
<?php
    mysqli_close($link);
}
?>