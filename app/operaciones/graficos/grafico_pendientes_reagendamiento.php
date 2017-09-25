<?php
    header('Content-Type: application/json');

    $zona="";
    
    if (isset($_POST['zona']))
    {
        include_once("../../../includes/conexion.php");
        $zona=$_POST['zona'];
    }else
    {
        include_once("../../../includes/conexion.php");
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
        $sql="select q_agendamiento x,sum(q_ordenes) y from tbl_pendientes_historico_reagendamiento where fecha='$fecha' group by q_agendamiento";
    else
        $sql="select q_agendamiento x,sum(q_ordenes) y from tbl_pendientes_historico_reagendamiento where fecha='$fecha' and territorio='$zona' group by q_agendamiento";
    
    $result=mysqli_query($linkt,$sql);
    
    unset($pend_valores_test);
    while ($total = mysqli_fetch_object($result))
    {
        $pend_valores_test[]=array("x" => $total->x, "y" =>$total->y);
        
    }
    if (isset($pend_valores_test)){
        echo json_encode($pend_valores_test);
    }else{
        $fecha=substr($fecha,6,2).'-'.substr($fecha,4,2).'-'.substr($fecha,0,4);
        echo "<center><b>Q de Ordenes con Reagendamiento</b></center> ";
        echo "Sin datos cargados para el día: $fecha";
    }
    mysqli_free_result($result);
    mysqli_close($linkt);  
?>