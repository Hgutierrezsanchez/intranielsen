<head>
	<meta charset="utf-8">
</head>

<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>
<?php 
$idusuario=$_POST['usuario'];
?>
<div class="box-body col-sm-4"></div>
<div class="box-body col-sm-4">
    <form name="cambiarpassword_form" action="" method="POST" onsubmit="cambiarpassword('admin'); return false">
        <h2>Cambiar password: <?php echo $idusuario; ?> </h2>
        <hr \>
        
        <div class="form-group">
            <input class="form-control" name="passn" type="password" id="passn" placeholder="Nueva Password" required/>
            <input class="form-control" name="passr" type="password" id="passr" placeholder="Repetir Nueva Password" required/>
            <input name="usuario" type="hidden" id="usuario" value="<?php echo $idusuario; ?>" />
        </div>
        
        <p>
        <label>
        <input type="submit" name="Submit" value="Grabar" />
        </label>
        </p>
    </form>
</div>
