<?php 
    $zona="";
    
    if (isset($_POST['zona']))
    {
        include_once("../../../includes/conexion.php");
        $zona=$_POST['zona'];
    }else
    {
        include_once("../../includes/conexion.php");
    }
    $linkt=conectar();

    if (isset($_POST['fecha'])){
        if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
            $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
        }
    }else{
        $fecha=date('Ymd'); //hoy
    }

    if ($zona=="" || $zona=="TODAS" )
        $sql="select sum(q) total from tbl_pendientes_historico Where fecha='$fecha' ";
    else
        $sql="select sum(q) total from tbl_pendientes_historico where fecha='$fecha' and territorio='$zona'";

    $result=mysqli_query($linkt,$sql);
    $total = mysqli_fetch_object($result);
    mysqli_free_result($result);
    if ($total->total==0)
    {
        $fecha=substr($fecha,6,2).'-'.substr($fecha,4,2).'-'.substr($fecha,0,4);
        echo "<center><b>Detalle de Ordenes Pendientes Diarias</b></center> ";
        echo "Sin datos cargados para el día: $fecha";
    }else{

        //columnas
        if ($zona=="" || $zona=="TODAS" )
            $sql="select ag from tbl_pendientes_historico Where fecha='$fecha' group by ag";
        else
            $sql="select ag from tbl_pendientes_historico where fecha='$fecha' and territorio='$zona' group by ag";

        $result=mysqli_query($linkt,$sql);
        while($row = mysqli_fetch_object($result)){
            $columna[]=$row->ag;
        }
        mysqli_free_result($result);
        if (!isset($columna)) {$columna[]="";}

        //filas
        if ($zona=="" || $zona=="TODAS" )
            $sql="select clasificacion from tbl_pendientes_historico where fecha='$fecha' group by clasificacion";
        else
            $sql="select clasificacion from tbl_pendientes_historico where fecha='$fecha' and territorio='$zona' group by clasificacion";

        $result=mysqli_query($linkt,$sql);
        while($row = mysqli_fetch_object($result)){
            $fila[]=$row->clasificacion;
        }
        mysqli_free_result($result);
        if (!isset($fila)) {$fila[]="";}
?>  
    <center><b>Detalle de Ordenes Pendientes Diarias</b></center> 
    <table border="2">
        <thead>
            <tr>
                <th>&nbsp;ACTIVIDAD</th>
                <?php
                    foreach ($columna as $valor)
                    {
                        echo "<th style={text-align: center }>&nbsp;".$valor."&nbsp;</th>";
                    }
                ?>
                <th>&nbsp;TOTAL&nbsp;</th>
                <th>&nbsp;Porcentaje&nbsp;</th>
            </tr>
        </thead>
        <tbody>
                <?php
                   
                    foreach ($fila as $valor_fila)
                    {
                        echo "<tr>";
                        echo "<td><b>&nbsp;&nbsp;".$valor_fila."&nbsp;</b></td>";
                        $cantidad=0; $i=0;
                        
                        foreach ($columna as $valor_col)
                        {
                            if ($zona=="" || $zona=="TODAS" )
                                $sql="select sum(q) as cantidad from tbl_pendientes_historico where fecha='$fecha' And ag='".$valor_col."' and clasificacion='".$valor_fila."'";
                            else
                                $sql="select sum(q) as cantidad from tbl_pendientes_historico where fecha='$fecha' and territorio='$zona' And ag='".$valor_col."' and clasificacion='".$valor_fila."'";
                            
                            
                            $result=mysqli_query($linkt,$sql);

                            $row = mysqli_fetch_object($result);
                            
                            if (!isset($totalcol[$i]))
                            {
                                if ($row->cantidad==0)
                                    $totalcol[]="0";
                                else
                                    $totalcol[]=$row->cantidad;
                            }
                            else
                            {
                                $totalcol[$i]+=$row->cantidad;
                            }
                            
                            $q=number_format($row->cantidad,0,',','.');
                            echo "<td align='right'>&nbsp;$q&nbsp;&nbsp;</td>";
                            
                            $cantidad+=$row->cantidad;
                            
                            
                            
                            mysqli_free_result($result);
                            $i++;
                        }
                        echo "<td align='right'>".number_format($cantidad,0,',','.')."&nbsp;&nbsp;</td>";
                        $porc=number_format(($cantidad/$total->total)*100,2,",",".");
                        echo "<td align='right'>".$porc."%&nbsp;&nbsp;</td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td><b>&nbsp;&nbsp;TOTAL GENERAL&nbsp;&nbsp;</b></td>";
        
                    $cantidad=0;
                    foreach ($totalcol as $valor_col)
                    {
                        $q=number_format($valor_col,0,',','.');
                        echo "<td align='right'>$q&nbsp;&nbsp;</td>";
                        $cantidad+=$valor_col;
                    }
                    echo "<td align='right'>".number_format($cantidad,0,',','.')."&nbsp;&nbsp;</td>";
                    echo "</tr>";
                    unset($totalcol); unset($fila); unset($columna);
            
                ?>
        </tbody>
    </table>
    
<?php
    }
mysqli_close($linkt);
?>