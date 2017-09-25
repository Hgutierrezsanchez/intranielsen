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

$consulta1 = "SELECT u.nombre, h.idhe, h.rut, h.fecha, h.desde, h.hasta, h.motivo, us.nombre as solicitante, h.estado, cast(create_at as DATE) creada FROM (tblhorasextras h INNER JOIN tblusuario u ON u.rut = h.rut) inner join tblusuario us on h.solicitante=us.idusuario where CAST( h.create_at AS DATE ) BETWEEN '$fdesde' AND '$fhasta' order by create_at desc";
$sql=mysqli_query($link,$consulta1);

?>
<br>
<left>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
           <thead>
            <tr>
                <th> Cod</th>
                <th> Nombre</th>
                <th> Rut</th>
                <th> Fecha H/E</th>
                <th> Desde</th>
                <th> Hasta</th>
                <th> N°Horas</th>
                <th> Motivo</th>
                <th> Solicitante</th>
                <th> Fecha Solic.</th>
                <th> Estado </th>
            </tr>
            </thead>
            <tbody>
                <form name="updatehe_form" action="" method="POST">
                    <?php
                    $query_perfil="Select distinct idhe from tblhorasextras";

                    while($row = mysqli_fetch_array($sql))
                    {
                        echo "	<tr>";
                        echo " 		<td>".$row['idhe']." </td>";
                        echo " 		<td>".$row['nombre']."</td>";
                        echo " 		<td>".$row['rut']."</td>";
                        echo " 		<td>".$row['fecha']."</td>";
                        echo " 		<td>".$row['desde']."</td>";
                        echo " 		<td>".$row['hasta']."</td>";
                        echo " 		<td>".RestarHoras($row['desde'],$row['hasta'])."</td>";
                        echo " 		<td>".$row['motivo']."</td>";
                        echo " 		<td>".$row['solicitante']."</td>";
                        echo " 		<td>".$row['creada']."</td>";
                        if ($row['estado']=="aprobado"){
                            echo "<td><a href='../pdf_word/output_pdf.php?id=".$row['idhe']."&archivo=horaextra' target='_blank'><img src='/intranielsen/img/pdf.png' width='30' \></a></td>";
                        }else{
                            echo " 		<td>".$row['estado']."</td>";
                        }
                        echo "	</tr>";
                    }
                    mysqli_close($link);
                    ?>
                </form>
            </tbody>
        </table>
    </div>
</left>
<?php
function RestarHoras($horaini,$horafin)
{
	$horai=substr($horaini,0,2);
	$mini=substr($horaini,3,2);
	$segi=0;
 
	$horaf=substr($horafin,0,2);
	$minf=substr($horafin,3,2);
	$segf=0;
 
	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);
 
	$dif=$fin-$ini;
 
	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	return date("H:i",mktime($difh,$difm));
}
?>