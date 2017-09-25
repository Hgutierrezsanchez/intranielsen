
<?php 
if ( ! session_id() ) @ session_start();
if (!empty($_SESSION['iduser']))
{ 
    $iduser=$_SESSION['iduser'];
    $link=conectar();
?>
           <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>
            
            <?php
            if ($id==0)
            {
            ?>
                <li class="active treeview">
            <?php    
            }else{
            ?>                
                <li class="treeview">
            <?php
            }
            ?>
            
                <a href="/intranielsen/home.php">
                <i class="fa fa-home"></i> 
                <span>HOME</span>
                </a>
            </li>
            
            <?php
                
    
                $rscons=mysqli_query($link,"Select admin from tblusuario where idusuario='$iduser'");
                $rs=mysqli_fetch_array($rscons);
                if ($rs["admin"]==1)
                {
                    $obtenermenu=mysqli_query($link,"Select idopcion,descripcion,glyphicon from tblmenu order By PosI");
                    while($menu=mysqli_fetch_array($obtenermenu))
                    {
                        $submenu=mysqli_query($link,"Select idsubmenu,url,descripcion,glyphicon from tblsubmenu where idopcion='$menu[idopcion]' and estado=1 Order By PosS");
                        if(mysqli_num_rows($submenu)>0)
                        {
                            if ($id==$menu["idopcion"])
                            {
                            ?>
                            <li class="active treeview">
                            <?php    
                            }else{
                            ?>                
                                <li class="treeview">
                            <?php
                            }
                            ?>
                            
                            <a href="#">
                                <i class="fa <?php echo $menu['glyphicon']; ?>"></i><span><?php echo utf8_encode($menu['descripcion']); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                            <ul class="treeview-menu">
                            <?php
                            while($row1=mysqli_fetch_array($submenu))
                            {
                                ?>
                                
                                <li>
                                <a href="/intranielsen/<?php echo $row1['url'];?>"><i class="fa fa-circle-o"></i><?php echo utf8_encode($row1['descripcion']); ?></a>
                                </li>
                                
                                <?php
                            }
                            ?>
                            </ul>
                            </li>
                            <?php
                        }
                    }
                }else{
                    $obtenermenu=mysqli_query($link,"Select M.idopcion,M.descripcion,glyphicon from tblperfilesuser P inner Join tblmenu M On P.Idopcion=M.IdOpcion Where IdUsuario='$iduser' Group By M.idopcion,M.descripcion Order By PosI");
                    while($menu=mysqli_fetch_array($obtenermenu))
                    {
                        $submenu=mysqli_query($link,"Select S.idsubmenu,S.url,S.descripcion,glyphicon from tblperfilesuser P inner Join tblsubmenu S On P.idopcion=S.idopcion And P.idSubmenu=S.IdSubMenu where P.idopcion='$menu[idopcion]' and IdUsuario='$iduser' And  estado=1 Order By PosS");
                        if(mysqli_num_rows($submenu)>0)
                        {
                            if ($id==$menu["idopcion"])
                            {
                            ?>
                            <li class="active treeview">
                            <?php    
                            }else{
                            ?>                
                                <li class="treeview">
                            <?php
                            }
                            ?>
                            <a href="#">
                                <i class="fa <?php echo $menu['glyphicon']; ?>"></i><span><?php echo utf8_encode($menu['descripcion']); ?></span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                            <ul class="treeview-menu">
                            <?php
                            while($row1=mysqli_fetch_array($submenu))
                            {
                                ?>
                                
                                <li>
                                <a href="/intranielsen/<?php echo $row1['url'];?>"><i class="fa fa-circle-o"></i><?php echo utf8_encode($row1['descripcion']); ?></a>
                                </li>
                                
                                <?php
                            }
                            ?>
                            </ul>
                            </li>
                            <?php
                        }
                    }
                }
            ?>
          </ul>
<?php
    mysqli_close($link);
}
?>