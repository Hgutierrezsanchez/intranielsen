<?php
    
    $fdesde=$_GET['fdesde'];
    if (substr($_GET['fdesde'],4,1)=="-" || substr($_GET['fdesde'],4,1)=="/" ){
        $fdesde=substr($_GET['fdesde'], 0,4).substr($_GET['fdesde'], -5,2).substr($_GET['fdesde'], -2);
    }
    $fhasta=$_GET['fhasta'];
    if (substr($_GET['fhasta'],4,1)=="-" || substr($_GET['fhasta'],4,1)=="/" ){
        $fhasta=substr($_GET['fhasta'], 0,4).substr($_GET['fhasta'], -5,2).substr($_GET['fhasta'], -2);
    }
    
    $usuario=$_GET['usuario'];

    include("../../includes/conexion.php");
    $linkc=conectar();

    $query="SELECT comuna,bloque,u.nombre,`norden`,`rut_cliente`,`observacion`,fecha FROM `tbl_agen_ordenes` a inner join tblusuario u on u.idusuario=a.idusuario Where  CAST( create_at AS DATE ) BETWEEN '$fdesde' AND '$fhasta' Order By bloque,ID";

    $sql=mysqli_query($linkc,"SET lc_time_names = 'es_UY'");
    $sql=mysqli_query($linkc,$query);
    
    if (mysqli_num_rows($sql)==0)
    {
        $json = array(
        "aaData"=>array(
            array(
                $fdesde,
                $fhasta,
                "Sin Datos",
                "",
                "",
                "",""
                )
            )
        );
        
    }else{

        $json = array(
        "aaData"=>array(
            )
        );
        
        while($row = mysqli_fetch_array($sql)){
            $json['aaData'][] = array($row['comuna'],$row['bloque'],$row['nombre'],$row['norden'],$row['rut_cliente'],$row['observacion'],$row['fecha']);
        }
        
    }
    $jsonencoded = json_encode($json,JSON_UNESCAPED_UNICODE);
    
    $fh = fopen("../../app/agendamiento_ordenes/base_tabla_agendamientos_".$usuario.".php", 'w');
    fwrite($fh, $jsonencoded);
    fclose($fh);
    mysqli_close($linkc);
?>