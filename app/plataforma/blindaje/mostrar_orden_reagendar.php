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
    include_once("../../../includes/conexion.php");
    extract($_POST);
    $link=conectar();

    $sql="Select nmro_orden,fecha_compromiso,codi_horario From tbl_pendiente_blindaje where NMRO_ORDEN='$nmro_orden'";
    $query =  mysqli_query($link,$sql);
    if (mysqli_num_rows($query)>0){
      $row=mysqli_fetch_object($query);

      echo '<br/>';
      echo '<br/>';
      echo '<table class="table table-bordered table-striped">';
      echo '<thead><th>ORDEN: '.$nmro_orden.'</th><th>ACTUAL</th><th>REAGENDAMIENTO</th></thead>';
      echo '<tbody><tr>';
      echo '<td><b>COMPROMISO</b></td>';
      echo '<td>'.$row-> fecha_compromiso.'</td>';
      echo '<td><input type="date" value='.date("Y-m-d").'></td>';
      echo '<tr></tr>';
      echo '<td><b>BLOQUE</b></td>';
      echo '<td>'.$row-> codi_horario.'</td>';
      echo '<td>';
        echo '<select id="sel_bloque">';
          $sql="select bloque from tbl_blindaje_bloques where nivel='Nivel 1' order by id";
          $query_b=mysqli_query($link,$sql);
          while($row = mysqli_fetch_object($query_b)){
              echo "<option> $row->bloque </option>";
          }
          mysqli_free_result($query_b);
        echo '</select>';
      echo '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td><b>MOTIVO</b></td>';
      echo '<td>';
        echo '<select id="sel_motivo">';
          echo "<option> -- </option>";
          $sql="select descripcion from tbl_motivo_reagendamientos";
          $query_b=mysqli_query($link,$sql);
          while($row = mysqli_fetch_object($query_b)){
              echo "<option> $row->descripcion </option>";
          }
          mysqli_free_result($query_b);
        echo '</select>';
      echo '</td>';
      echo '</tr>';
      echo '</tbody>';
      echo '<table>';
  ?>

  <?php
    }
    mysqli_free_result($query);
    mysqli_close($link);
  }
?>
