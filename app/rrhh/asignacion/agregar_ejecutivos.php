

<head>
	<meta charset="utf-8">
</head>

<a href="#" onclick="cerrar_div_modal()" style="float: right;"><button class='btn btn-block btn-success btn-xs'>SALIR</button></a>
<?php

extract($_POST);


include_once("../../../includes/conexion.php");
$link=conectar();

$tarea=mysqli_query($link,"Select distinct nombre from tblperfiles");  
?>
<br />
<h4>Asigna Usuario a: <?php echo $nombre; ?></h4>
<div class="container">
    <div class="box-body col-sm-12">
        <table class="table table-bordered">
            <tr>
                <td>
                    <form id="form_sinasginar" method="post" action="" name="form_sinasginar">
                        <p><input type='button' name='Submit' value='Cargar a Supervisor' id='cargar' onclick="agregar_ejecutivos(); return false"/>
                         <?php echo "<select name='perfil' id='perfil' onchange=\"muestra_ejecutivo_asignar('".$usuario."')\">"; ?>
                            <?php echo "<option selected='selected'>--</option>"; ?>
                            <?php while($rs=mysqli_fetch_array($tarea)) { 
                                        echo  "<option value='".utf8_encode($rs['nombre'])."'> ".utf8_encode($rs['nombre'])."</option>";
                                    } 
                            echo   "</select>";
                            ?>
                        <ul></ul>
                        
                        <div id="filtr_ejecutivos_asignar">
                        <?php 
                            $sql="SELECT nombre,idusuario FROM tblusuario Where idusuario<>'$usuario' and admin<>1 And estado=1 And idusuario not in (select idusuarioejecutivo from tblsuperejecutivo) order by nombre"; 

                            $ejecutivos=mysqli_query($link,$sql);

                            while($rs=mysqli_fetch_array($ejecutivos)) 
                            { 

                                echo "<p><input name='".$rs['idusuario']."' type='checkbox' value='".$rs['idusuario']."' id='check'> ".utf8_encode($rs['nombre'])."</input>";
                            } 

                        ?>
                        </div>
                    </form>
                </td>
                <td>

                    <form id="form_asignados" method="post" action="" name="form_asignados">
                        <p><input type='button' name='Submit' value='Quitar a Supervisor' id='quitar' onclick="quitarejecutivos(); return false"/>
                        <ul></ul>
                        <div id="filtr_ejecutivos_quitar">
                        <?php 
                            $sql="SELECT nombre,idusuario FROM tblusuario u inner join tblsuperejecutivo s on u.idusuario=s.idusuarioejecutivo Where s.idusuariosuper='$usuario' And u.estado=1 order by nombre"; 
                            $ejecutivos=mysqli_query($link,$sql);

                            while($rs=mysqli_fetch_array($ejecutivos)) 
                            { 

                            echo "<p><input name='".$rs['idusuario']."' type='checkbox' value='".$rs['idusuario']."' id='check'> ".utf8_encode($rs['nombre'])."</input>";
                            } 

                        ?>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php 
    mysqli_close($link);
?>