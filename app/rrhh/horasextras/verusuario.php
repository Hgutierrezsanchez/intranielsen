<head>
	<meta charset="utf-8">
</head>
  
   <?php
    include("../../../includes/conexion.php");
    $link=conectar();
        
    $id=$_POST['idhe'];
    $consulta="SELECT idhe,h.rut,fecha, desde, hasta, motivo, u.nombre ,h.estado FROM tblhorasextras h left join tblusuario u on u.idusuario=h.solicitante WHERE idhe =$id";
    
    $sql=mysqli_query($link,$consulta);

    $row = mysqli_fetch_array($sql);        
    ?>
    <br />
    <form role="form" name="editarhe" action="" onsubmit="enviarupdatehe(); return false">
        <table>
            <tr>
                <input name="idhe" type="hidden" disabled="true" id="idhe" value="<?php echo utf8_encode($row['idhe']); ?>" />
                <td> RUT </td>
                <td><input name="nombres" type="text" disabled="true" id="nombre" value="<?php echo utf8_encode($row['rut']); ?>" /></td>
            </tr>
            <tr>
                <td> FECHA </td>
                <td><input name="fecha" type="text" disabled="true" id="fecha" value="<?php echo utf8_encode($row['fecha']); ?>" /></td>
            </tr>
            <tr>
                <td> DESDE </td>
                <td><input name="desde" type="text" disabled="true" id="desde" value="<?php echo utf8_encode($row['desde']); ?>" /></td>
            </tr>
            <tr>
                <td> HASTA </td>
                <td><input name="hasta" type="text" disabled="true" id="hasta" value="<?php echo utf8_encode($row['hasta']); ?>" /></td>
            </tr>
            <tr>
                <td> MOTIVO </td>
                <td><input name="motivo" type="text" disabled="true" id="motivo" value="<?php echo utf8_encode($row['motivo']); ?>" /></td>
            </tr>
            <tr>
                <td> SOLICITANTE </td>
                <td><input name="solicitante" type="text" disabled="true" id="solicitante" value="<?php echo utf8_encode($row['nombre']); ?>" /></td>
            </tr>

            <tr>
                <td> Estado de Solicitud </td>
                <td>
                    <SELECT id="estado" NAME="estado" SIZE=auto border="1"> 
                        <OPTION> <?php echo utf8_encode($row['estado']); ?> </OPTION> 
                        <OPTION value="aprobado"> APROBAR </OPTION> 
                        <OPTION value="pendiente"> PENDIENTES </OPTION>
                        <OPTION value="rechazado"> RECHAZAR </OPTION> 
                    </SELECT>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="Submit" value=" Actualizar " onclick="enviarupdatehe(); return false" />
                </td>
            </tr>
        </table>
    </form>
<?php
    mysqli_close($link);
?>
