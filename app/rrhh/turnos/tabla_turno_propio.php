<head>
	<meta charset="utf-8">
</head>

<?php

include("../../../includes/conexion.php");
$linkc=conectar();

$iduser=$_POST['iduser'];

$fecha=$_POST['fecha'];
if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
    $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
}
$fechah=$_POST['fechah'];
if (substr($_POST['fechah'],4,1)=="-" || substr($_POST['fechah'],4,1)=="/" ){
    $fechah=substr($_POST['fechah'], 0,4).substr($_POST['fechah'], -5,2).substr($_POST['fechah'], -2);
}
//$fecha= substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
//$fechah= substr($_POST['fechah'], 0,4).substr($_POST['fechah'], -5,2).substr($_POST['fechah'], -2);

$sql=mysqli_query($linkc,"SET lc_time_names = 'es_UY'");
$sql=mysqli_query($linkc,"SELECT t.tarea,DATE_FORMAT(t.fecha, '%W, %d de %M del %Y') as fechaf,t.horaingreso,t.horasalida,hdiarias,tiempocolacion,nsemana FROM tblturnos t inner join tblusuario u on t.rut=u.rut where u.idusuario='$iduser' And Fecha BETWEEN $fecha AND $fechah");
?>
<br />
<div class="table-responsive">
    <table class="table table-bordered table-striped">
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
        ?>
        </tbody>
    </table>
</div>