<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body style="background:none">
    <?php
        include("../../../includes/conexion.php");
        $link=conectar();

        $id=$_GET['id'];
        $consulta="SELECT idhe,h.rut,fecha, desde, hasta, motivo, u.nombre ,h.estado FROM tblhorasextras h left join tblusuario u on u.idusuario=h.solicitante WHERE idhe =$id";

        $sql=mysqli_query($link,$consulta);

        $row = mysqli_fetch_array($sql);        
        ?>
        <img style="vertical-align: top; opacity: 0.5" src="/intranielsen/img/n1.png" width="80" />
        <center>
        <div style="text-aling:center;">
            <table style="margin:0 auto;">
                <tr>
                    <td>
                        <h1>Formulario de Horas Extras</h1>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                    </td>
                </tr>
            </table>
        
            <table style="margin:0 auto;">
                
                <tr>
                    <td> RUT </td>
                    <td>:&nbsp;&nbsp;<?php 
                        $consulta="SELECT nombre FROM tblusuario WHERE rut =".$row['rut'];
                        $sql_rut=mysqli_query($link,$consulta);

                        $row_rut = mysqli_fetch_array($sql_rut);  
                        echo utf8_encode($row['rut'])."&nbsp;&nbsp;&nbsp;&nbsp;".$row_rut['nombre']; 
                        
                        ?></td>
                </tr>
                <tr>
                    <td> FECHA </td>
                    <td>:&nbsp;&nbsp;<?php echo utf8_encode($row['fecha']); ?></td>
                </tr>
                <tr>
                    <td> DESDE </td>
                    <td>:&nbsp;&nbsp;<?php echo utf8_encode($row['desde']); ?></td>
                </tr>
                <tr>
                    <td> HASTA </td>
                    <td>:&nbsp;&nbsp;<?php echo utf8_encode($row['hasta']); ?></td>
                </tr>
                <tr>
                    <td> MOTIVO </td>
                    <td>:&nbsp;&nbsp;<?php echo utf8_encode(strtoupper($row['motivo'])); ?></td>
                </tr>
                <tr>
                    <td> SOLICITANTE </td>
                    <td>:&nbsp;&nbsp;<?php echo utf8_encode($row['nombre']); ?></td>
                </tr>
            </table>
            
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            
            
            <table style="text-align: center">
                <tr>
                    <?php 
                    echo "<td>______________________________________</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>______________________________________</td>";
                    echo "</tr><tr>";
                    echo "<td>JEFATURA</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$row_rut['nombre']."</td>";

                    ?>
                </tr>
            </table>
        </div>     
        </center>   
    <?php
        mysqli_close($link);
    ?>
    </body>
</html>