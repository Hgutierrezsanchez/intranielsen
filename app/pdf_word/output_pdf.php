<?php


$id=$_GET['id'];

if ($_GET['archivo']=="horaextra") $archivo_imprimir="http://".$_SERVER['SERVER_NAME']."/intranielsen/app/rrhh/horasextras/inprimir_form_hora_extra.php?id=".$id;
if ($_GET['archivo']=="epp") $archivo_imprimir="http://".$_SERVER['SERVER_NAME']."/intranielsen/app/rrhh/horasextras/inprimir_form_hora_extra.php?id=".$id;
    
require_once ('mpdf/mpdf.php');    
$mpdf = new mPDF('c','LETTER');


$mpdf->SetDisplayMode('fullpage');
$mpdf->writeHTML( utf8_encode(file_get_contents( $archivo_imprimir )));

$mpdf->Output($_GET['archivo'].".pdf",'I');
?>