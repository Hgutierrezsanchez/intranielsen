<head>
	<meta charset="utf-8">
</head>
    
<?php

include("../../../includes/conexion.php");

$link=conectar();

$fdesde=$_POST['fdesde'];
if (substr($_POST['fdesde'],4,1)=="-" || substr($_POST['fdesde'],4,1)=="/" ){
    $fdesde=substr($_POST['fdesde'], 0,4).substr($_POST['fdesde'], -5,2).substr($_POST['fdesde'], -2);
}
$fhasta=$_POST['fhasta'];
if (substr($_POST['fhasta'],4,1)=="-" || substr($_POST['fhasta'],4,1)=="/" ){
    $fhasta=substr($_POST['fhasta'], 0,4).substr($_POST['fhasta'], -5,2).substr($_POST['fhasta'], -2);
}


$consulta1 = "SELECT u.nombre, h.rut, h.tipo_licencia, h.licencia_desde, h.licencia_hasta, h.descripcion, cast(create_at as DATE) creada FROM (tblinasistencia h INNER JOIN tblusuario u ON u.rut = h.rut) where CAST( h.create_at AS DATE ) BETWEEN '$fdesde' AND '$fhasta' order by create_at desc";
$sql=mysqli_query($link,$consulta1);

?>
<br>
<left>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
           <thead>
            <tr>
                
                <th> Nombre</th>
                <th> Rut</th>
                
                <th> Desde</th>
                <th> Hasta</th>
                
                <th> Motivo</th>
                
                <th> Fecha ingreso</th>
                
            </tr>
            </thead>
            <tbody>
                <form name="updatehe_form" action="" method="POST">
                    <?php
                    $query_perfil="Select distinct idhe from tblhorasextras";

                    while($row = mysqli_fetch_array($sql))
                    {
                        echo "	<tr>";
                       
                        echo " 		<td>".$row['nombre']."</td>";
                        echo " 		<td>".$row['rut']."</td>";
                        
                        echo " 		<td>".$row['licencia_desde']."</td>";
                        echo " 		<td>".$row['licencia_hasta']."</td>";
                       
                        echo " 		<td>".utf8_encode($row['descripcion'])."</td>";
                       
                        echo " 		<td>".$row['creada']."</td>";
                       
                        echo "	</tr>";
                    }
                    mysqli_close($link);
                    ?>
                </form>
            </tbody>
        </table>
    </div>
</left>
