<head>
	<meta charset="utf-8">
</head>

<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>

<?php
	
include_once("../../../includes/conexion.php");
$linkt=conectar();

$idusuario=$_POST['usuario'];

$q_perfil=mysqli_query($linkt,"Select distinct nombre from tblperfiles");  

$q_usuario=mysqli_query($linkt,"Select nombre,correo,admin,rut,perfil From tblusuario where idusuario='$idusuario'");
$row = mysqli_fetch_array($q_usuario);

if (mysqli_num_rows($q_usuario)>0) 
{
?>

<div class="box-body col-sm-4"></div>
<div class="box-body col-sm-4">
    <form name="modifica_usuario" action="" method="POST" onsubmit="enviardatosusuarioupdate('Modificar'); return false">
        <h2>Modificar Usuario </h2>
        <hr \>
        
        <div class="form-group">
            Nombre:
            <input class="form-control" name="nombres" type="text" id="nombre" placeholder="Nombre Completo" value="<?php echo utf8_encode($row['nombre']); ?>" required/>
            Rut:
            <input class="form-control" name="rut" type="text" id="rut" placeholder="Rut" value="<?php echo $row['rut']; ?>" required/>
        </div>

        <div class="form-group">
            Nombre de Usuario:
            <input class="form-control" name="usuario" type="text" id="usuario" value="<?php echo $idusuario; ?>" readonly="readonly"/>
            Correo:
            <input class="form-control" name="correo" type="email" id="correo" placeholder="E-Mail" value="<?php echo $row['correo']; ?>" required/>
        </div>
        <div class="checkbox">
            <label>
                <?php
                    if ($row['admin']==1)
                    {
                        echo "<input name='admin' type='checkbox' id='admin' checked='checked'/>";
                    }else{
                        echo "<input name='admin' type='checkbox' id='admin' />";
                    }
                ?>
                Usuario Administrador
            </label>
        </div>    
        <div class="form-group">
            <?php echo "<select name='perfil' id='perfil' class='form-control' >"; 
                  while($rs=mysqli_fetch_array($q_perfil)) {  
                        if ($rs['nombre']==$row['perfil'])
                        {
                          echo  "<option value='".utf8_encode($rs['nombre'])."' selected='selected'> ".utf8_encode($rs['nombre'])."</option>";
                        }
                        else
                        {
                          echo  "<option value='".utf8_encode($rs['nombre'])."'> ".utf8_encode($rs['nombre'])."</option>";
                        }
                    }
                    if ($row['perfil']=="Otro")
                    {
                        echo  "<option value='Otro' selected='selected'>Otro</option>";
                    }else{
                        echo  "<option value='Otro'>Otro</option>";
                    }
                  echo   "</select>";
            ?>
        </div>
        <p>
            <label>
                <input type="submit" name="Submit" value="Grabar" />
            </label>
        </p>
  </form>
</div>

<?php
}
mysqli_close($linkt);
?>
