<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php 
    extract($_POST); 
    include_once("../../../includes/conexion.php");
    $link=conectar();

    $sql=mysqli_query($link,"select IdOpcion,Descripcion from tblmenu order by PosI");

    while($row = mysqli_fetch_array($sql))
    {
        $array[]= array("root",$row[0],utf8_encode($row[1]));
    }
?>
    <br />
	<form action="<?php $PHP_SELF ?>" method="post" name="form_update_perfil_usuario" id="form_update_perfil_usuario" onsubmit="update_peril_usuario_db(); return false" style="width:50%; margin-left:10%;">
        <input type="submit" value="Actualizar" />
	    <!--   padres -->
	    <?php 
        for($i=0; $i<sizeof($array); $i++) 
		{
			echo  "<li id=show-'".$i."'>";  
			echo "<strong>";
			echo $array[$i][2];
			echo "<strong/>"; 
			$hijo=$array[$i][1]; 
	
            //<!--  hijos  -->
            $hij="SELECT descripcion,S.idsubmenu,if(P.IdSubMenu Is NULL,0,1) est from tblsubmenu S Left Join tblperfilesuser P On P.Idopcion='$hijo' And S.IdSubMenu=P.IdSubMenu And IdUsuario='$usuario' Where S.idopcion='$hijo' Order By PosS";
            
            $hijos=mysqli_query($link,$hij);
            while($hi = mysqli_fetch_array($hijos))
            {
                $array2[]=array(utf8_encode($hi['descripcion']),$hi['est'],$hi['idsubmenu'],$usuario);
            } 
            ?>
            <ul id="<?php echo "tree-".$array[$i][1]; ?>">
                <?php 
                for($j=0; $j<sizeof($array2); $j++)
                {   
                ?>
                <li>
                    <div class="checkbox">
                    <label>    
                    <?php  
                        if($array2[$j][1] == "1" && $array2[$j][3] == $usuario)
                        {
                    ?> 
                        <input name="<?php echo $hijo.','.$array2[$j][2]; ?>" type="checkbox" value="<?php echo $array2[$j][1];?>" id="check" checked='checked' >
                    <?php  
                        }else{ 
                    ?>
                        <input name="<?php echo $hijo.','.$array2[$j][2]; ?>" type="checkbox" value="0" id="check" >
                    <?php  
                        }  
                        $hijo;
                        echo $array2[$j][0];
                    ?>
                    </label>
                    </div>
                </li>
                <?php
                }
                array_splice($array2, 0);?>
            </ul>
            <?php 
        } 
        ?>
        <p>
            <input name="usuario" type="hidden" value="<?php echo $usuario; ?>" id="usuario" >
            <input type="submit" value="Actualizar" />
        </p>
    </form>
<?php
    mysqli_close($link);
?>