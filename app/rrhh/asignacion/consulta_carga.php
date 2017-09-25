<head>
	<meta charset="utf-8">
</head>
<?php
    $perfil=$_POST['perfil'];

	include_once("../../../includes/conexion.php");
	$link=conectar();

	$user=mysqli_query($link,"Select nombre,idusuario from tblusuario where perfil='$perfil' and estado=1 order by nombre");  
?>
	<br />
	<b>Asignar ejecutivos a Supervisor</b>
	<form id="form_supervisor" method="post" action="" name="form_supervisor">
		<label>
		
            <?php echo "<select name=select1 onchange=traerejecutivos(); >"; ?>
            <?php echo "<option selected='selected'>--</option>"; ?>
            <?php while($rs=mysqli_fetch_array($user)) 
                { 
                    echo "<option value='".$rs['idusuario']."'> ".utf8_encode($rs['nombre'])."</option>";
                } 
                echo "</select>";
            ?>
		</label>
		<input type='button' name='Submit' value='Consultar' id='submit' onclick="traerejecutivos(); return false"/>
    </form>
    <div id="resultado_check"></div>
<?php 
    mysqli_close($link);
?>	
