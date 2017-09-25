<head>
	<meta charset="utf-8">
</head>
    
<?php



if(isset($_POST['fecha']))
{
    $fecha=$_POST['fecha'];
    include_once("../../../includes/conexion.php");
}else{
    $fecha=date('d-m-Y');
    include_once("../../includes/conexion.php");
}

if (substr($fecha,2,1)=="-" || substr($fecha,2,1)=="/" ){
    $fecha=substr($fecha, 6,4).substr($fecha, 3,2).substr($fecha,0,2);
}



$link=conectar();


?>
<b> Registro de Asistencia</b>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql="select tipo_licencia,count(*) cantidad from tblinasistencia where licencia_desde<=$fecha And licencia_hasta>=$fecha group by tipo_licencia";
        $query=mysqli_query($link,$sql);
        $ausentes=0;
        while($row = mysqli_fetch_object($query)){
            echo "	<tr>";
            echo " 		<td>".strtoupper($row->tipo_licencia)."</td>";
            echo " 		<td align='right'>".$row->cantidad."</td>";
            echo "  </tr>";
            //if (strtoupper($row->tipo_licencia)!='CON LICENCIA' && strtoupper($row->tipo_licencia)!='VACACIONES')
            //{
                $ausentes=$ausentes+$row->cantidad;
            //}
        }
        
        $sql="select count(*) cantidad from tblturnos where fecha=$fecha and horaingreso='00:00:00'";
        $query=mysqli_query($link,$sql);
        while($row = mysqli_fetch_object($query)){
            echo "	<tr>";
            echo " 		<td>LIBRE</td>";
            echo " 		<td align='right'>".$row->cantidad."</td>";
            echo "  </tr>";
        }
        
        $sql="select count(*) cantidad from tblturnos where fecha=$fecha and horaingreso<>'00:00:00'";
        $query=mysqli_query($link,$sql);
        while($row = mysqli_fetch_object($query)){
            echo "	<tr>";
            echo " 		<td>PLATAFORMA</td>";
            $asistencia=$row->cantidad-$ausentes;
            echo " 		<td align='right'>".$asistencia."</td>";
            echo "  </tr>";
        }
    ?>
    </tbody>
</table>



<?php 
mysqli_close($link);
?>