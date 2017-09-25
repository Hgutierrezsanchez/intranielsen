<?php

extract($_POST);

include_once("../../../includes/conexion.php");
$link=conectar();

if ($nivel == 'Nivel 1')
    $sql_w=" and CODI_HORARIO='".$bloque."' and ";
elseif ($nivel == 'Nivel 2' || $nivel == 'Nivel 4')
    $sql_w=" and comuna='".$bloque."' and ";

$sql="Select ejecutivo,count(ejecutivo) q from tbl_pendiente_blindaje Where ubicacion='$nivel' $sql_w final<>'FINALIZADA' group by ejecutivo";

$query_q=mysqli_query($link,$sql);
while ($r = mysqli_fetch_array($query_q)){
    
    $array_e[]=array("usuario"=> $r['ejecutivo'],"q"=> $r['q'] );
}
if (isset($array_e)){
    echo json_encode($array_e,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
}

mysqli_free_result($query_q);
mysqli_close($link);
?>