<?php
if ( ! session_id() ) @ session_start();

if (!empty($_SESSION['iduser']))
{

    include("includes/conexion.php");
    $link=conectar();

    $iduser=$_SESSION['iduser'];

    $sql="Select count(*) as cuenta from tblnotificaciones where idusuario='$iduser' and estado=0";
    $r_message=mysqli_query($link,$sql);
    $rs_mess_count=mysqli_fetch_array($r_message);
    
?>
      <header class="main-header">
        <!-- Logo -->
        <a href="/intranielsen/home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C-N</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>INTRA</b>NIELSEN</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Tienes 0 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                    </ul>
                  </li>
                  <li class="footer"><a href="#">Ver Todo</a></li>
                </ul>
              </li>
              
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-success"><?php if ($rs_mess_count['cuenta']>0){ echo $rs_mess_count['cuenta'];} ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Tienes <?php echo $rs_mess_count['cuenta']; ?> Notificaciones</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        <?php
                            $sql="Select id,message,fecha,estado from tblnotificaciones where idusuario='$iduser' order by estado asc,fecha desc,id asc limit 5";
                            $r_message=mysqli_query($link,$sql);
                            while($rs = mysqli_fetch_array($r_message))
                            {
                                echo "<li>";
                                echo "<a href=\"#\" onclick=\"rebaja_notificacion('2','".$rs['id']."','".$iduser."');location.reload();\" >";
                                if ($rs['estado']=="1"){
                                    echo "<i class='fa fa-users text-aqua'></i>".$rs['fecha']." | ".$rs['message'] ;
                                }else{
                                    echo "<i class='fa fa-users text-aqua'></i><b>".$rs['fecha']." | ".$rs['message']."</b>";
                                }
                                echo "</a>";
                                echo "</li>";
                            }
                        ?>
                    </ul>
                  </li>
                  <!--<li class="footer"><a href="#">Ver Todo</a></li>-->
                </ul>
              </li>
              
              
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <!--<span class="label label-danger">0</span>-->
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Tienes 0 tareas</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">Ver Todo</a>
                  </li>
                </ul>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/intranielsen/dist/img/user2-160x160.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombreusuario']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/intranielsen/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $_SESSION['nombreusuario']; ?>
                      <small></small>
                    </p>
                  </li>
                  
                  <!-- Menu Body -->
                  <li class="user-body">
                     <div class="col-xs-4 text-center"></div>
                     <div class="col-xs-4 text-center"><a href="portalnielsen/">Portal</a></div>
                     <div class="col-xs-4 text-center"></div>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat" onclick="mostrar_cambiar_pass('<?php echo $_SESSION['iduser']; ?>');">Reset Password</a>
                    </div>
                    
                    <div class="pull-right">
                      <a href="/intranielsen/includes/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
</header>
<?php 
mysqli_close($link);
}else{
   header("location:/intranielsen/index.php");
}
?>