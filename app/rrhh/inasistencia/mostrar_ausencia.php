<head>
	<meta charset="utf-8">
</head>

<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>


<?php
include("../../../includes/conexion.php");
$linkc=conectar();

$sql_ina=mysqli_query($linkc,"Select nombre,tipo_licencia,descripcion,licencia_desde,licencia_hasta From tblinasistencia a inner join tblusuario u on a.rut=u.rut Where id=".$_POST['id']);
if (mysqli_num_rows($sql_ina)>0) 
{
    $row_ina=mysqli_fetch_array($sql_ina);
    
?>   

    <table class="table table-bordered table-striped">
        <tr>
            <td>Nombre</td>
            <td><?php echo $row_ina['nombre']; ?></td>
        </tr>
        <tr>
            <td>Tipo inasistencia</td>
            <td><?php echo $row_ina['tipo_licencia']; ?></td>
        </tr>
        <tr>
            <td>Descripcion</td>
            <td><?php echo utf8_encode($row_ina['descripcion']); ?></td>
        </tr>
        <tr>
            <td>Desde</td>
            <td><?php echo $row_ina['licencia_desde']; ?></td>
        </tr>
        <tr>
            <td>Hasta</td>
            <td><?php echo $row_ina['licencia_hasta']; ?></td>
        </tr>
    </table>
<?php 
}
mysqli_close($linkc);
?>