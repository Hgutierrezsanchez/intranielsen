<?php
 
    include_once("../../../includes/conexion.php");
    $link=conectar();
    
    //asigno ordenes nuevas a ejecutivos nivel 1
    $sql="select bt.comuna,count(bt.comuna) cantidad from tbl_pendiente_blindaje_temp bt where ubicacion='Nivel 2' group by bt.comuna";
    $query=mysqli_query($link,$sql);
    while ($row = mysqli_fetch_object($query)){
        $sql="select count(*) q from tbl_blindaje_bloque_ejecutivo where bloque='$row->comuna' And tarea='Nivel 2' And estado=1";
        $query_2=mysqli_query($link,$sql);
        $q = mysqli_fetch_object($query_2);
        if ($q->q > 0){
            $resultd=ceil($row->cantidad / $q->q);
            
            $sql="select bloque,idusuario from tbl_blindaje_bloque_ejecutivo where bloque='$row->comuna' And tarea='Nivel 2' And estado=1";
            $query_3=mysqli_query($link,$sql);
            $i=($q->q)-1;
            while ($r_comuna = mysqli_fetch_object($query_3)){
                $insert="insert into tbl_pendiente_blindaje (RUT,DESC_ACTIV,LOCALIDAD,NMRO_ORDEN,FECHA_COMPROMISO,CODI_HORARIO,CONTEXTO,ESTD_ACTIV,DESC_AREAFUN,FECHA_OT,COMUNA,ejecutivo,ACTIVIDAD,NODO,SUBNODO,MARCA,ubicacion) ";
                $sql="Select RUT,DESC_ACTIV,LOCALIDAD,NMRO_ORDEN,FECHA_COMPROMISO,CODI_HORARIO,CONTEXTO,ESTD_ACTIV,DESC_AREAFUN,FECHA_OT,COMUNA,'$r_comuna->idusuario',ACTIVIDAD,NODO,SUBNODO,MARCA,ubicacion from tbl_pendiente_blindaje_temp where ubicacion='Nivel 2' And comuna='".$r_comuna->bloque."' limit $i,$resultd";    
                mysqli_query($link,$insert.$sql);
                
                $sql="Delete from tbl_pendiente_blindaje_temp where NMRO_ORDEN in (Select NMRO_ORDEN from tbl_pendiente_blindaje) ";  
                mysqli_query($link,$sql);
                
                $i--;
            }
            mysqli_free_result($query_3);
        }
        mysqli_free_result($query_2);
    }
    mysqli_free_result($query);
    
    $sql="Select count(*) q from tbl_pendiente_blindaje_temp where ubicacion='Nivel 2' limit 1";
    $query=mysqli_query($link,$sql);
    $q=mysqli_fetch_object($query);
    
    mysqli_free_result($query);
    mysqli_close($link);
    if ($q->q != 0)
    {
        include('listar_dist_ordenes_cargadas_n2.php');
    }
   
?>