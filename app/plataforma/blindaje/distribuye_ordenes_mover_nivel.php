<?php
 
    include_once("../../../includes/conexion.php");
    $link=conectar();
    
    extract($_POST);
    
    if ($filtro == 'AYER'){
        $nuevafecha = strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ;
        $fecha = date ( 'Ymd' , $nuevafecha );
    }elseif($filtro == 'HOY'){
        $fecha = date ( 'Ymd' );
    }
    
    $sql="Update tbl_pendiente_blindaje Set ejecutivo='',Ubicacion='$hasta',FINAL='PENDIENTE',MARCA='N' where fecha_compromiso<='$fecha' and ubicacion='$desde' AND FINAL<>'FINALIZADA'";
    mysqli_query($link,$sql);

   
    if ($pagina == 'DISTRIBUCION'){ 
        $sql="Select count(*) q from tbl_pendiente_blindaje where ubicacion='Nivel 1' and ejecutivo=''";
        $query=mysqli_query($link,$sql);
        $q=mysqli_fetch_object($query);
        mysqli_free_result($query);
        mysqli_close($link);
        if ($q->q != 0)
        {
            include('listar_dist_ordenes_sinasignar.php');
        }
    }
?>