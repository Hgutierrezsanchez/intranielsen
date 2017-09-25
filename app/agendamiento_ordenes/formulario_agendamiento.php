<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>

<?php

$fecha=$_POST['fecha'];
$idusuario=$_POST['idusuario'];
$bloque=$_POST['bloque'];
$comuna=$_POST['comuna'];

?>



<center>
<h2>Nuevo Agendamiento</h2>

<hr />
<form name="form_agendamiento" action="" method="POST" onsubmit="guardar_agendamiento(); return false">
   

    <label>
        <input type="submit" name="Submit" value="Guardar Orden"/>
    </label>
    <table>
        <tr>
            <td>Fecha</td>
            <td>
                <input name="fecha" type="text" id="fecha" readonly="readonly" value="<?php echo $fecha; ?>" />
                <input name="idusuario" type="hidden" id="idusuario" value="<?php echo $idusuario; ?>" />
                
            </td>
        </tr>
        <tr>
            <td>Casilla</td>
            <td><input name="bloque" type="text" id="bloque" readonly="readonly" value="<?php echo $bloque; ?>" /></td>
        </tr>
        <tr>
            <td>Comuna</td>
            <td><input name="comuna" type="text" id="comuna" readonly="readonly" value="<?php echo $comuna; ?>" /></td>
        </tr>
        <tr>
            <td>N° Orden</td>
            <td><input name="norden" type="text" id="norden" required/></td>
        </tr>
        <tr>
            <td>Rut</td>
            <td><input name="rut" type="text" id="rut" required/></td>
        </tr>
        <tr>
            <td>Observacion</td>
            <td><textarea name="observacion" type="text" id="observacion" rows="10" cols="22" required></textarea></td>
        </tr>
    </table>
</form>
</center>