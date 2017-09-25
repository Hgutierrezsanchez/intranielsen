
<?php
if (isset($_POST['iduser'])){
    $iduser=$_POST['iduser'];
}elseif (isset($_GET['iduser'])){
    $iduser=$_GET['iduser'];
}else{
    if ( ! session_id() ) @ session_start();
    $iduser=$_SESSION['iduser'];
}

if ( ! session_id() ) @ session_start();
if (empty($_SESSION['iduser']))
{
    header("location:/intranielsen/index.php");
}
else
{

extract($_GET);

$sql_where="";
if (isset($_POST['filtraje'])){
    $filtraje =  $_POST['filtraje'];
    include_once("../../../includes/conexion.php");
}elseif (isset($_GET['filtraje'])){
    include_once("../../../includes/conexion.php");
    $filtraje =  $_GET['filtraje'];
}

$link=conectar();

if (isset($filtraje)){
    $filtraje= mysqli_real_escape_string($link,$filtraje);
    if ($filtraje != "")
    {
        $sql_where="and ( COMUNA like '%$filtraje%' or 
        RUT like '%$filtraje%' or 
        NMRO_ORDEN like '%$filtraje%' or 
        FECHA_COMPROMISO like '%$filtraje%' or 
        CODI_HORARIO like '%$filtraje%' or 
        ESTD_ACTIV like '%$filtraje%' or 
        ESTADO_REAL like '%$filtraje%' or 
        GESTION_HD like '%$filtraje%'
        )";
    }
}





$sql="Select count(*) q From tbl_pendiente_blindaje where ejecutivo='$iduser' and fecha_compromiso>date(now()) and FINAL<>'FINALIZADA' and Marca<>'S' $sql_where";
$query_num_services =  mysqli_query($link,$sql);
$r_count = mysqli_fetch_object($query_num_services);
$num_total_registros=$r_count->q;

 
if ($num_total_registros > 0) {
    //numero de registros por página
    $rowsPerPage = 15;

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
echo "<br/>";
echo 'Total Registros: '.$num_total_registros;
?>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>COMUNA</th>
                        <th>ORDEN</th>
                        <th>Rut </th>
                        <th>Compromiso</th>
                        <th>Bloque</th>
                        <th>EST_FLUJO</th>
                        <th>ESTADO REAL</th>
                        <th>GESTION HD</th>
                        <th>ESTADO</th>
                        <th>OBSERV</th>
                        <th>REAGEND</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="Select pb.id,COMUNA,RUT,NMRO_ORDEN,FECHA_OT,FECHA_COMPROMISO,CODI_HORARIO,bb.desde,CONTEXTO,ESTD_ACTIV,ESTADO_REAL,GESTION_HD,FINAL,MARCA From tbl_pendiente_blindaje pb inner join tbl_blindaje_bloques bb on pb.CODI_HORARIO=bb.bloque where ejecutivo='$iduser' and fecha_compromiso>date(now()) and FINAL<>'FINALIZADA' and Marca<>'S' $sql_where order by FECHA_COMPROMISO,bb.desde,NMRO_ORDEN Asc limit $offset, $rowsPerPage ";
                    
                    $query =  mysqli_query($link,$sql);
                    while($r_pend = mysqli_fetch_object($query)){
                        echo"<tr id='tr-".$r_pend->id."' >";
                            echo "<td>$r_pend->COMUNA</td>";
                            echo "<td>$r_pend->NMRO_ORDEN</td>";
                            echo "<td>$r_pend->RUT</td>";
                            echo "<td>$r_pend->FECHA_COMPROMISO</td>";
                            echo "<td align='center'>$r_pend->CODI_HORARIO</td>";
                            echo "<td align='center'>$r_pend->ESTD_ACTIV</td>";
                            echo "<td>";
                                echo "<select id='real-".$r_pend->id."' onchange=\"update_estado_real_orden('".$r_pend->id."')\">";
                                    $sql="Select DESCRIPCION from tbl_blindaje_estado_real order by descripcion";
                                    $query_r =  mysqli_query($link,$sql);
                                    while($r_real = mysqli_fetch_object($query_r)){
                                        if ($r_real->DESCRIPCION == $r_pend->ESTADO_REAL ){
                                            echo "<option selected='selected'>$r_real->DESCRIPCION</option>";
                                        }else{
                                            echo "<option>$r_real->DESCRIPCION</option>";
                                        }
                                    }
                                    mysqli_free_result($query_r);
                                echo "</select>";
                            echo "</td>";
                            echo "<td><div id='gestion-".$r_pend->id."'>$r_pend->GESTION_HD</div></td>";
                            echo "<td><div id='final-".$r_pend->id."'>$r_pend->FINAL</div></td>";
                            echo "<td align='center'><div id='observacion-".$r_pend->id."'>"; 
                                $sql="Select count(*) q from tbl_blindaje_hist_gestion_hd where NMRO_ORDEN=".$r_pend->NMRO_ORDEN;
                                $query_r =  mysqli_query($link,$sql);
                                $r_real = mysqli_fetch_object($query_r);
                                if ($r_real->q > 0)
                                    echo "<a href='#' onclick=\"mostrar_observaciones_orden('".$r_pend->NMRO_ORDEN."');\">".$r_real->q."</a>";
                                else
                                    echo $r_real->q;
                                mysqli_free_result($query_r);
                            echo "</div></td>";
                            echo "<td align='center'>"; 
                                $sql="Select count(*) q from tbl_blindaje_hist_gestion_hd where NMRO_ORDEN=".$r_pend->NMRO_ORDEN." And ACCION='REAGENDAMIENTO'";
                                $query_r =  mysqli_query($link,$sql);
                                $r_real = mysqli_fetch_object($query_r);
                                
                                echo $r_real->q;
                                mysqli_free_result($query_r);
                            echo "</td>";
                            echo "<td><div id='accion-".$r_pend->id."'>";
                                echo "<select id='marca-".$r_pend->id."' onchange=\"ejecutar_accion_orden('".$r_pend->id."','N')\">";
                                    echo "<option>--</option>";
                                    if ($r_pend->FINAL != 'ESCALADA') echo "<option>ESCALAR</option>";
                                    echo "<option>FINALIZAR</option>";
                                    echo "<option>SEGUIMIENTO</option>";
                                echo "</select>";
                            echo "</div></td>";
                        echo"</tr>";
                    }
                     mysqli_free_result($query);
                ?>
                </tbody>
            </table>
<?php
    mysqli_close($link);


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
}
?>