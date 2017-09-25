<head>
	<meta charset="utf-8">
</head>
<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>
<?php

if ( ! session_id() ) @ session_start();
$iduser=$_SESSION['iduser'];

if (empty($_SESSION['iduser']))
{
    header("location:/intranielsen/index.php");
}
else
{
include_once("../../../includes/conexion.php");
$link=conectar();

extract($_POST);


$sql="Select NMRO_ORDEN,RUT,UBICACION from tbl_pendiente_blindaje where id=$id";
$query =  mysqli_query($link,$sql);

$r_orden = mysqli_fetch_object($query);
?>
<div id="row">
<div class="box-body col-sm-4"></div>
<div class="box-body col-sm-4">
    <form name="frm_update_orden_seguimiento" action="" method="POST" onsubmit="update_orden_seguimiento('<?php echo $id; ?>','<?php echo $accion; ?>'); return false">
        <center><h2><?php echo $accion; ?> ORDEN </h2></center>    
        <hr \>
        <input name="usuario" type="hidden" id="usuario" value="<?php echo $iduser; ?>"/>
        <div class="form-group">
            ORDEN:
            <input class="form-control" name="orden" type="text" id="orden" value="<?php echo $r_orden->NMRO_ORDEN; ?>" readonly="readonly"/>
            Rut Cliente:
            <input class="form-control" name="rut" type="text" id="rut" value="<?php echo $r_orden->RUT; ?>" readonly="readonly"/>
        </div>

        <div class="form-group">
            Observación:
            <input class="form-control" name="observacion" type="text" maxlength="100" size="100" id="observacion" placeholder="observacion" value="<?php ?>" required/>
        </div>
        
        <div class="form-group">
            GESTION HD:
            <select name='gestion' id='gestion' class='form-control' required >
            <option selected='selected'>S/LLAMADO</option>
            <option>CONTACTADO</option>
            <option>S/CONTACTO</option>
            </select>
        </div>

        <div class="form-group">
            <?php
                
                if ($accion == 'ESCALAR'){
                    echo "ESCALAR A:";
                    echo "<select name='escalar' id='escalar' class='form-control' required >";
                        echo  "<option value='--' selected='selected'>--</option>";
                    
                    if (strtolower($r_orden->UBICACION) == 'nivel 1'){
                        echo  "<option value='Nivel 2'>Especial -> Nivel 2</option>";
                        echo  "<option value='Nivel 3'>Redes -> Nivel 3</option>";
                    }elseif (strtolower($r_orden->UBICACION) == 'nivel 2'){
                        echo  "<option value='Nivel 1'>Devolver a Revisión -> Nivel 2</option>";
                        echo  "<option value='Nivel 3'>Redes -> Nivel 3</option>";
                    }elseif (strtolower($r_orden->UBICACION) == 'nivel 3'){
                        echo  "<option value='Nivel 1'>Devolver a Revisión -> Nivel 1</option>";
                        echo  "<option value='Nivel 2''>Devolver a Especiales -> Nivel 2</option>";
                    }
                    echo   "</select>";
                }
            ?>
        </div>

        <p>
            <label>
                <input type="submit" name="Submit" value="Grabar" />
            </label>
        </p>
  </form>
</div>
</div>
<?php

mysqli_close($link);
}
?>
