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
    
    $sql="select bt.codi_horario,count(bt.codi_horario) cantidad from tbl_pendiente_blindaje bt where FINAL<>'FINALIZADA' and ubicacion='Nivel 1' and fecha_compromiso='$fecha' and ejecutivo='' group by bt.codi_Horario";
    $query=mysqli_query($link,$sql);
    while ($row = mysqli_fetch_object($query)){
        $sql="select count(*) q from tbl_blindaje_bloque_ejecutivo where bloque='$row->codi_horario' And tarea='Nivel 1' And estado=1";
        $query_2=mysqli_query($link,$sql);
        $q = mysqli_fetch_object($query_2);
        if ($q->q > 0){
             
            $resultd=ceil($row->cantidad / $q->q);

            $sql="select idusuario from tbl_blindaje_bloque_ejecutivo where bloque='$row->codi_horario' And tarea='Nivel 1' And estado=1";
            $query_3=mysqli_query($link,$sql);
            $i=($q->q)-1;
            while ($r_comuna = mysqli_fetch_object($query_3)){
                $sql="Select id From tbl_pendiente_blindaje Where FINAL<>'FINALIZADA' and codi_horario='$row->codi_horario' and fecha_compromiso='$fecha' and ejecutivo='' and ubicacion='Nivel 1' limit $i,$resultd";
                $query_4=mysqli_query($link,$sql);
                while ($r_orden = mysqli_fetch_object($query_4)){
                    $sql="Update tbl_pendiente_blindaje Set ejecutivo='$r_comuna->idusuario',FINAL='PENDIENTE',MARCA='N' where id=$r_orden->id";
                    mysqli_query($link,$sql);
                }
                mysqli_free_result($query_4);
                $i--;
            }
            mysqli_free_result($query_3);
        }
        mysqli_free_result($query_2);
    }
    mysqli_free_result($query);
    
    $sql="Select count(*) q from tbl_pendiente_blindaje where ubicacion='Nivel 1' and ejecutivo=''";
    $query=mysqli_query($link,$sql);
    $q=mysqli_fetch_object($query);
    mysqli_free_result($query);
    mysqli_close($link);
    if ($q->q != 0)
    {
        include('listar_dist_ordenes_sinasignar.php');
    }
?>