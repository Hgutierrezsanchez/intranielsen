<head>
	<meta charset="utf-8">
</head>

 
<?php

if(isset($_GET['fecha']))
{
    $fecha=$_GET['fecha'];
    if (substr($_GET['fecha'],4,1)=="-" || substr($_GET['fecha'],4,1)=="/" ){
        $fecha=substr($_GET['fecha'], 0,4).substr($_GET['fecha'], -5,2).substr($_GET['fecha'], -2);
    }
    include("../../../includes/conexion.php");
}else if (!empty($_POST['fecha'])){
    $fecha=$_POST['fecha'];
    if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
        $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
    }
    include("../../../includes/conexion.php");
}else{
    $fecha=date("Ymd");
}

//echo $fecha;
$linkc=conectar();
 
$query_num_services =  mysqli_query($linkc,"select t.rut from tblturnos t inner join tblusuario u on t.rut=u.rut where u.estado=1 and fecha=$fecha");
$num_total_registros = mysqli_num_rows($query_num_services);

 
if ($num_total_registros > 0) {
    //numero de registros por página
    $rowsPerPage = 10;

    //por defecto mostramos la página 1
    $pageNum = 1;

    // si $_GET['page'] esta definido, usamos este número de página
    if(isset($_GET['page'])) {
        //sleep(1);
        $pageNum = $_GET['page'];
        
    }
   
    //contando el desplazamiento
    $offset = ($pageNum - 1) * $rowsPerPage;
    $total_paginas = ceil($num_total_registros / $rowsPerPage);

    $sql=mysqli_query($linkc,"select t.rut,nombre,tarea,horaingreso,horasalida,hdiarias,tiempocolacion,nsemana,idusuario from tblturnos t inner join tblusuario u on t.rut=u.rut where u.estado=1 and fecha=$fecha order by tarea,nombre,horaingreso LIMIT $offset, $rowsPerPage"); 
    
    
    if ($total_paginas > 1) {
        echo '<div class="pagination">';
        echo '<ul>';
            if ($pageNum != 1)
                    echo '<li><a class="paginate" data="'.($pageNum-1).'">Anterior</a></li>';
                for ($i=1;$i<=$total_paginas;$i++) {
                    if ($pageNum == $i)
                            //si muestro el índice de la página actual, no coloco enlace
                            echo '<li class="active"><a>'.$i.'</a></li>';
                    else
                            //si el índice no corresponde con la página mostrada actualmente,
                            //coloco el enlace para ir a esa página
                            echo '<li><a class="paginate" data="'.$i.'">'.$i.'</a></li>';
            }
            if ($pageNum != $total_paginas)
                    echo '<li><a class="paginate" data="'.($pageNum+1).'">Siguiente</a></li>';
       echo '</ul>';
       echo '</div>';
    }

?>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Semana </th>
                <th>Ejecutivo</th>
                <th>Tarea</th>
                <th>Hora Ingreso</th>
                <th>Hora Salida</th>
                <th>Horas Diarias</th>
                <th>Minutos Colación</th>
                <th>Asistencia</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            $i=1;
            while($row = mysqli_fetch_array($sql)){
                echo "	<tr>";
                echo " 		<td>".$i."</td>";
                echo " 		<td>".$row['nsemana']."</td>";
                echo "<td><a title='ver turnos de Ejecutivo' style=\"text-decoration:underline;cursor:pointer;\" onclick=\"cargaturnoejecutivo_blank('".$row['idusuario']."',document.form_busca_turno.fecha_turno.value)\">".utf8_encode($row['nombre'])."</a></td>";
                echo " 		<td>".$row['tarea']."</td>";
                if ($row['horaingreso']=="00:00:00"){
                    echo " 		<td>LIBRE</td>";
                    echo " 		<td>LIBRE</td>";
                }else{
                    echo " 		<td>".$row['horaingreso']."</td>";
                    echo " 		<td>".$row['horasalida']."</td>";
                }

                echo " 		<td>".$row['hdiarias']."</td>";
                echo " 		<td>".$row['tiempocolacion']."</td>";

                $sql_ina=mysqli_query($linkc,"Select id,tipo_licencia From tblinasistencia Where rut='".$row['rut']."' And licencia_desde<=$fecha And licencia_hasta>=$fecha");
               
                if (mysqli_num_rows($sql_ina)>0) 
	            {
                    $row_ina=mysqli_fetch_array($sql_ina);
                    echo "<td><a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"buscar_ausencia('".$row['rut']."','".$row_ina['id']."')\">".strtoupper($row_ina['tipo_licencia'])."</a></td>";
                }else{
                    if ($row['horaingreso']=="00:00:00"){
                        echo " 		<td>LIBRE</td>";
                    }else{
                        echo "<td></td>";
                    }
                }
                echo "	</tr>";
                $i++;
            }
            mysqli_close($linkc);
            ?>
        </tbody>
    </table>
<?php 

     if ($total_paginas > 1) {
        echo '<div class="pagination">';
        echo '<ul>';
            if ($pageNum != 1)
                    echo '<li><a class="paginate" data="'.($pageNum-1).'">Anterior</a></li>';
                for ($i=1;$i<=$total_paginas;$i++) {
                    if ($pageNum == $i)
                            //si muestro el índice de la página actual, no coloco enlace
                            echo '<li class="active"><a>'.$i.'</a></li>';
                    else
                            //si el índice no corresponde con la página mostrada actualmente,
                            //coloco el enlace para ir a esa página
                            echo '<li><a class="paginate" data="'.$i.'">'.$i.'</a></li>';
            }
            if ($pageNum != $total_paginas)
                    echo '<li><a class="paginate" data="'.($pageNum+1).'">Siguiente</a></li>';
       echo '</ul>';
       echo '</div>';
    }
}
?>

    