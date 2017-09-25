<?php

    include_once("../../../includes/conexion.php");
    $link=conectar();
    
    extract($_POST);
    
    
    
    $q_bloque="bloque='$bloque' And tarea='$tarea' And ";
    if ($tarea == 'Nivel 1') $q_bloque2="and CODI_HORARIO='$bloque'";
    elseif ($tarea == 'Nivel 2') $q_bloque2="and comuna='$bloque'";
    elseif ($tarea == 'Nivel 4') $q_bloque2="and comuna='$bloque'";
   
    
    $sql="Select estado from tbl_blindaje_bloque_ejecutivo where $q_bloque idusuario='$usuario'";
    $query=mysqli_query($link,$sql);
    if (mysqli_num_rows($query)){
        $sql="update tbl_blindaje_bloque_ejecutivo Set estado=$estado where $q_bloque idusuario='$usuario'";
        mysqli_query($link,$sql);
    }else{
        $sql="insert into tbl_blindaje_bloque_ejecutivo(idusuario,bloque,tarea,estado) value('$usuario','$bloque','$tarea',$estado)";
        mysqli_query($link,$sql);
    }
    
    if ($estado == 0){
        $sql="Update tbl_pendiente_blindaje Set ejecutivo='' where FINAL<>'FINALIZADA' and ejecutivo='$usuario' and ubicacion='$tarea' $q_bloque2 ";
        mysqli_query($link,$sql);
    }

    mysqli_close($link);
    if ($tarea == 'Nivel 1') include('listar_dist_ordenes_sinasignar.php');
    elseif ($tarea == 'Nivel 2') include('listar_dist_ordenes_sinasignar_n2.php');
    elseif ($tarea == 'Nivel 4') include('listar_dist_ordenes_sinasignar_n4.php');
?>