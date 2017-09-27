<?php
if ( ! session_id() ) @ session_start();
$iduser=$_SESSION['iduser'];

extract($_POST);
echo guardar_reagendamiento($iduser,$nmro_orden,$tecnico,$fecha_old,$bloque_old,$fecha_new,$bloque_new,$motivo,$observacion);

function guardar_reagendamiento($iduser,$nmro_orden,$tecnico,$fecha_old,$bloque_old,$fecha_new,$bloque_new,$motivo,$observacion){
  try {

    include_once("../../../includes/conexion.php");
    $link=conectar();

    if (substr($fecha_old,4,1)=="-" || substr($fecha_old,4,1)=="/" ){
        $fecha_old=substr($fecha_old, 0,4).substr($fecha_old, -5,2).substr($fecha_old, -2);
    }
    if (substr($fecha_new,4,1)=="-" || substr($fecha_new,4,1)=="/" ){
        $fecha_new=substr($fecha_new, 0,4).substr($fecha_new, -5,2).substr($fecha_new, -2);
    }

    $sql="insert into tbl_blindaje_reagendamientos(id_usuario,nmro_orden,tecnico,fecha_old,bloque_old,fecha_new,bloque_new,motivo,observacion)
    value('$iduser','$nmro_orden','$tecnico',$fecha_old,'$bloque_old',$fecha_new,'$bloque_new','$motivo','$observacion')";
    $query =  mysqli_query($link,$sql);
    if (!$query) {
      throw new Exception(mysqli_error($link)."[$sql]");
    }


    $result = "<br/>
              <div class='callout callout-success'>
              Reagendamineto registrado satisfactoriamente...
              </div>";

    mysqli_close($link);

    return ($result);
  } catch(ModelException $e) {

    $result = "<br/>
              <div class='callout callout-danger'>
              Se ha detectado un problema favor intentar nuevamente...
              <br/>
              .$e->getMessage().
              </div>";
      return ($result);
  }
}
?>
