<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>

<h2>Ordenes Agendadas</h2>
<hr />
    
<?php

extract($_REQUEST);
    
include("../../includes/conexion.php");
$linkc=conectar();

$fecha=$_POST['fecha'];
if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
    $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
}


$bloque=$_POST['bloque'];

$comuna=$_POST['comuna'];


echo "<p> Fecha: ".substr($fecha, 6,2)."-".substr($fecha, 4,2)."-".substr($fecha, 0,4);
echo "<p> Casilla: ".$bloque;
echo "<p> Comuna: ".$comuna;

    if ($bloque=="TODOS")
    {
        $bloque_q="";
    }else{
        $bloque_q="and bloque='$bloque'";
    }
    
    if ($comuna=="TODAS")
    {
        $comuna_q="";
    }else{
        $comuna_q="and comuna='$comuna'";
    }

    $query="SELECT comuna,bloque,u.nombre,`norden`,`rut_cliente`,`observacion` FROM `tbl_agen_ordenes` a inner join tblusuario u on u.idusuario=a.idusuario Where Fecha=$fecha $comuna_q $bloque_q Order By bloque,ID";
    
    $sql=mysqli_query($linkc,"SET lc_time_names = 'es_UY'");
    $sql=mysqli_query($linkc,$query);
?>
        <br />
        <center>
           <div id="div_tables" class="table-responsive">
            <table id="tabla_ordenes_agendadas" class="display" cellspacing="0" width="100%" style="border:1px solid #FF0000; color:#000099;">
                <thead>
                <tr style="background:#99CCCC;">
                    <th>Comuna</th>
                    <th>Casilla</th>
                    <th>Usuario</th>
                    <th>N° Orden</th>
                    <th>Rut Cliente</th>
                    <th>Observación</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    while($row = mysqli_fetch_array($sql)){
                    echo "	<tr>";
                    echo " 		<td>".$row['comuna']."</td>";
                    echo " 		<td>".$row['bloque']."</td>";
                    echo " 		<td>".ucfirst(strtolower($row['nombre']))."</td>";
                    echo " 		<td>".$row['norden']."</td>";
                    echo " 		<td>".$row['rut_cliente']."</td>";
                    echo " 		<td>".$row['observacion']."</td>";
                    echo "	</tr>";
                    }
                    mysqli_close($linkc);
                ?>
                </tbody>
             </table>
            </div>
        </center>
       