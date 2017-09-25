<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>INTRA-Nielsen | Turnos Usuarios</title>
    
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE for demo purposes -->
    <link rel="stylesheet" href="../../../dist/css/styles.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background:none">
    <h2>Turnos Asignados</h2>
    <hr />
    <?php
        if (empty($_SESSION['iduser']))
        {
            session_start();
        }

        include("../../../includes/conexion.php");
        $linkc=conectar();

        $op="0";
        if (empty($_GET['usuario']))
        {
            $op="1";
            $iduser=$_SESSION['iduser'];
        }else{
            $iduser=$_GET['usuario'];
        }
        $fecha=$_GET['fecha'];
        if (substr($_GET['fecha'],4,1)=="-" || substr($_GET['fecha'],4,1)=="/" ){
            $fecha=substr($_GET['fecha'], 0,4).substr($_GET['fecha'], -5,2).substr($_GET['fecha'], -2);
        }

        //$fecha=date("Ymd");
    
    
        echo "<p> Los turnos pueden estar afectos a cambios, favor revisar continuamente.";
        echo "<p> Turno desde: ".$_GET['fecha'];
        echo "<p> Usuario: ".$iduser;

        $sql=mysqli_query($linkc,"SET lc_time_names = 'es_UY'");
        $sql=mysqli_query($linkc,"SELECT t.tarea,DATE_FORMAT(t.fecha, '%W, %d de %M del %Y') as fechaf,t.horaingreso,t.horasalida,hdiarias,tiempocolacion,nsemana FROM tblturnos t inner join tblusuario u on t.rut=u.rut where u.idusuario='$iduser' And Fecha>=$fecha limit 14");
    ?>
        <br>
        <center>
           <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N°Semana</th>
                        <th>Tarea</th>
                        <th>Fecha</th>
                        <th>Hora Ingreso</th>
                        <th>Hora Salida</th>
                        <th>Min.Colación</th>
                        <th>Horas Diarias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_array($sql)){
                    $fechaf=utf8_encode($row['fechaf']);
                        echo "	<tr>";
                        echo " 		<td>".$row['nsemana']."</td>";
                        echo " 		<td>".$row['tarea']."</td>";
                        echo " 		<td>".$fechaf."</td>";
                        if ($row['horaingreso']=="00:00:00"){
                            echo " 		<td>LIBRE</td>";
                            echo " 		<td>LIBRE</td>";
                        }else{
                            echo " 		<td>".$row['horaingreso']."</td>";
                            echo " 		<td>".$row['horasalida']."</td>";
                        }

                        echo " 		<td>".$row['tiempocolacion']."</td>";
                        echo " 		<td>".$row['hdiarias']."</td>";
                        echo "	</tr>";
                    }
                    mysqli_close($linkc);

                    echo "</table>";

                        if ($op=="0")
                        {
                            echo "<a href='javascript:window.close();'><button class='btn btn-block btn-success btn-sm'>cerrar ventana</button></a>";
                        }

                    echo "</center>";
                ?>
                </tbody>
            </table>
          </div>
        </center>
         <!-- jQuery 2.1.4 -->
        <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $(document).keyup(function(event) {
            if (event.which == 27) {
                window.close();
                }
            });
        </script>
</body>

</html>