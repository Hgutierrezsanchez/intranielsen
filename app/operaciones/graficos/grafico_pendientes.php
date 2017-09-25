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
        $fecha_desde=date('Ymd',strtotime ( '-1 month' , strtotime ( $_POST['fecha'] ) ));
        if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
            $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
        }
    }else{
        $fecha=date('Ymd'); //hoy
        $fecha_desde=date('Ymd',strtotime ( '-1 month' , strtotime ( date('Y-m-d') ) ));
    }
    
    
        
    if ($zona=="" || $zona=="TODAS" )
        $sql="select fecha as x,sum(q) as y from tbl_pendientes_historico where lower(ag)='hoy' and fecha>='$fecha_desde' and fecha<='$fecha' group by fecha ";
    else
        $sql="select fecha as x,sum(q) as y from tbl_pendientes_historico where lower(ag)='hoy' and fecha>='$fecha_desde' and fecha<='$fecha' and territorio='$zona' group by fecha";
    
    $result=mysqli_query($linkt,$sql);
    
    unset($pend_valores_test);
    while ($total = mysqli_fetch_object($result))
    {
        $pend_valores_test[]=array("x" => $total->x, "y" =>$total->y);
        
    }
    
    echo json_encode($pend_valores_test);
    mysqli_free_result($result);
    mysqli_close($linkt);  
?>