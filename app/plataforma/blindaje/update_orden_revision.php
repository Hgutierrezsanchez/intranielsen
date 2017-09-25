<?php
if ( ! session_id() ) @ session_start();
$iduser=$_SESSION['iduser'];

extract($_POST);

include_once("../../../includes/conexion.php");
$link=conectar();

if ($accion == 'SEGUIMIENTO'){
    
    $sql="update tbl_pendiente_blindaje set MARCA='S',FINAL='SEGUIMIENTO',GESTION_HD='$gestion' where id=".$id;
    $query =  mysqli_query($link,$sql);
    
    $final="SEGUIMIENTO";
    
}elseif ($accion == 'FINALIZAR'){
    
    $sql="update tbl_pendiente_blindaje set MARCA='F',FINAL='FINALIZADA',ESTADO_REAL='FINALIZADA',GESTION_HD='$gestion' where id=".$id;
    $query =  mysqli_query($link,$sql);    
    
    $final="FINALIZADA";
    
}elseif ($accion == 'ESCALAR'){
    
    if ($ubicacion == 'Nivel 1' ){
        $sql="update tbl_pendiente_blindaje set MARCA='N',FINAL='PENDIENTE',GESTION_HD='$gestion' where id=".$id;
        $final="PENDIENTE";
    }
    elseif ($ubicacion == 'Nivel 2' ){
        $sql="update tbl_pendiente_blindaje set MARCA='N2',FINAL='ESCALADA',GESTION_HD='$gestion' where id=".$id;
        $final="ESCALADA";
    }
    elseif ($ubicacion == 'Nivel 3' ){
        $sql="update tbl_pendiente_blindaje set MARCA='R',FINAL='ESCALADA',GESTION_HD='$gestion' where id=".$id;
        $final="ESCALADA";
    }
    $query =  mysqli_query($link,$sql);
}

$sql="Insert Into tbl_blindaje_hist_gestion_hd(ID_ORDEN,NMRO_ORDEN,FECHA,ACCION,OBSERVACION,GESTION_HD,IDUSUARIO,HORA) Value($id,'$orden',date(now()),'$accion','$observacion','$gestion','$iduser',time(now()))";
$query =  mysqli_query($link,$sql);

$sql="Select count(*) q from tbl_blindaje_hist_gestion_hd where ID_ORDEN=".$id;
$query_r =  mysqli_query($link,$sql);
$r_real = mysqli_fetch_object($query_r);


$arr_update_table[]=array("gestion" => $gestion,"final" => $final, "q_obs" => $r_real->q);
echo json_encode($arr_update_table,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);

mysqli_close($link);
?>