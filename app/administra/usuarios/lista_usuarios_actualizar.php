<head>
	<meta charset="utf-8">
</head>
<?php

include_once("../../../includes/conexion.php");
$linkc=conectar();

if(isset($_GET['perfil']))

{
    $perfil=$_GET['perfil'];
}else{
    $perfil=$_POST['perfil'];
}
    
    $sql=mysqli_query($linkc,"SELECT nombre FROM tblusuario where perfil='$perfil'");
    $num_total_registros = mysqli_num_rows($sql);

if ($num_total_registros > 0) {
    //numero de registros por página
    $rowsPerPage = 10;

    //por defecto mostramos la página 1
    $pageNum = 1;

    // si $_GET['page'] esta definido, usamos este número de página
    if(isset($_GET['page'])) {
        //sleep(1);
        $pageNum = $_GET['page'];
        
    }
   
    //contando el desplazamiento
    $offset = ($pageNum - 1) * $rowsPerPage;
    $total_paginas = ceil($num_total_registros / $rowsPerPage);
    
     $sql=mysqli_query($linkc,"SELECT nombre,idusuario,if(admin=1,'Si','No') adm,correo,if(estado=1,'Si','No') est,rut,perfil FROM tblusuario where perfil='$perfil' Order by nombre LIMIT $offset, $rowsPerPage");
    
    if ($total_paginas > 1) {
        echo '<div class="pagination">';
        echo '<ul>';
            if ($pageNum != 1)
                    echo '<li><a class="paginate" data="'.($pageNum-1).'">Anterior</a></li>';
                for ($i=1;$i<=$total_paginas;$i++) {
                    if ($pageNum == $i)
                            //si muestro el índice de la página actual, no coloco enlace
                            echo '<li class="active"><a>'.$i.'</a></li>';
                    else
                            //si el índice no corresponde con la página mostrada actualmente,
                            //coloco el enlace para ir a esa página
                            echo '<li><a class="paginate" data="'.$i.'">'.$i.'</a></li>';
            }
            if ($pageNum != $total_paginas)
                    echo '<li><a class="paginate" data="'.($pageNum+1).'">Siguiente</a></li>';
       echo '</ul>';
       echo '</div>';
    }
?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rut</th>
                <th>Activo</th>
                <th></th>
                <th>OPCIONES</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_perfil="Select distinct nombre from tblperfiles";
            $sql_perfil=mysqli_query($linkc,$query_perfil);

            while($row = mysqli_fetch_array($sql)){
                echo "	<tr>";
                echo " 		<td>".utf8_encode(strtolower($row['nombre']))."</td>";
                echo " 		<td>".$row['idusuario']."</td>";
                echo " 		<td>".$row['correo']."</td>";
                echo " 		<td>".$row['rut']."</td>";
                echo " 		<td>".$row['est']."</td>";
                
                echo "         <td><a href=\"#\" onclick=\"updateusuarioperfil('".$row['idusuario']."')\"><button class='btn btn-block btn-success btn-xs'>Modificar Datos</button></a></td>";
                echo "         <td><a href=\"#\" onclick=\"actualizapassxusuario('".$row['idusuario']."')\"><button class='btn btn-block btn-info btn-xs'>Reset Password</button></a></td>";
                if ($row['est']=='Si'){
                    echo "         <td><a href=\"#\" onclick=\"actualizaestadousuario('".$row['idusuario']."','".$row['est']."')\"><button class='btn btn-block btn-danger btn-xs'>Desactivar Cuenta</button></a></td>";
                }else{
                    echo "         <td><a href=\"#\" onclick=\"actualizaestadousuario('".$row['idusuario']."','".$row['est']."')\"><button class='btn btn-block btn-warning btn-xs'>Activar Cuenta</button></a></td>";
                }
                
                echo "  </tr>";
            }
            mysqli_close($linkc);
            ?>
        </tbody>
    </table>
<?php 
    if ($total_paginas > 1) {
        echo '<div class="pagination">';
        echo '<ul>';
            if ($pageNum != 1)
                    echo '<li><a class="paginate" data="'.($pageNum-1).'">Anterior</a></li>';
                for ($i=1;$i<=$total_paginas;$i++) {
                    if ($pageNum == $i)
                            //si muestro el índice de la página actual, no coloco enlace
                            echo '<li class="active"><a>'.$i.'</a></li>';
                    else
                            //si el índice no corresponde con la página mostrada actualmente,
                            //coloco el enlace para ir a esa página
                            echo '<li><a class="paginate" data="'.$i.'">'.$i.'</a></li>';
            }
            if ($pageNum != $total_paginas)
                    echo '<li><a class="paginate" data="'.($pageNum+1).'">Siguiente</a></li>';
       echo '</ul>';
       echo '</div>';
    }

} ?>
