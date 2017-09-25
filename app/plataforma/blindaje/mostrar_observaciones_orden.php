<head>
	<meta charset="utf-8">
</head>
<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>
<?php

if ( ! session_id() ) @ session_start();
$iduser=$_SESSION['iduser'];
	
include_once("../../../includes/conexion.php");
$link=conectar();

extract($_POST);
?>


<div class="box-body col-sm-12">
    <center><h2>REGISTRO DE OBSERVACIONES</h2></center>    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>ACCION</th>
                <th>GESTION_HD</th>
                <th>EJECUTIVO</th>
                <th>OBSERVCION</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql="Select Fecha,Hora,Accion,gestion_hd,observacion,u.nombre from tbl_blindaje_hist_gestion_hd hd inner join tblusuario u on hd.idusuario=u.idusuario  where NMRO_ORDEN='".$id."' order by id desc";
            $query =  mysqli_query($link,$sql);
            while($r_pend = mysqli_fetch_object($query)){
                echo"<tr>";
                    echo "<td>$r_pend->Fecha</td>";
                    echo "<td>$r_pend->Hora</td>";
                    echo "<td>$r_pend->Accion</td>";
                    echo "<td>$r_pend->gestion_hd</td>";
                    echo "<td>$r_pend->nombre</td>";
                    echo "<td>$r_pend->observacion</td>";
                echo"</tr>";
            }
            mysqli_free_result($query);
        ?>
        </tbody>
    </table>
</div>

<?php
mysqli_close($link);
?>
