<?php
	
include("../../includes/conexion.php");
$link=conectar();

session_start();
$iduser=$_SESSION['iduser'];
session_write_close();


$sql="SELECT turno,count(nombre) as cant FROM tbl_agen_bloques Group by turno";
$query_col=mysqli_query($link,$sql);

if (!empty($_POST['fecha']))
{
    $fecha=$_POST['fecha'];
    if (substr($_POST['fecha'],4,1)=="-" || substr($_POST['fecha'],4,1)=="/" ){
        $fecha=substr($_POST['fecha'], 0,4).substr($_POST['fecha'], -5,2).substr($_POST['fecha'], -2);
    }
	$fecha_completa=$_POST['fecha'];
}else{
	
	$fecha=date('Ymd');
	$fecha_completa=date('d-m-Y');
}

$comuna=$_POST['comuna'];
if ($comuna!="TODAS")
{
?>
   <br />
    <div class="callout callout-info"> <h4>Fecha:
        <?php echo $fecha_completa; ?>
	-	   Comuna: 
	    <?php echo $comuna; ?>
	    </h4></div>
	    
	    <?php
		while($col = mysqli_fetch_array($query_col)){
			
			echo"<table style='border:0px solid #FF0000; color:#000099;'>";
			echo"<tr>";
			echo"<td style='background:#99CCCC;'>Bloque: ".$col['turno']."</td>";
			
			$sql="SELECT nombre,cantidadmax FROM tbl_agen_bloques where turno='".$col['turno']."' Order By id";
			$query=mysqli_query($link,$sql);
			echo "</tr>";
			echo "<tr>";
			while($row = mysqli_fetch_array($query)){
				//echo date($fecha,"Ymd");
				$sql="SELECT Count(*) as cantidad FROM tbl_agen_ordenes where comuna='$comuna' And fecha='$fecha' and bloque='".$row['nombre']."'";
				$query_cant=mysqli_query($link,$sql);
				$row_c = mysqli_fetch_array($query_cant);
				if (mysqli_num_rows($query_cant)==0)
				{
					$cantidad=0;
				}
				else
				{
					$cantidad=$row_c['cantidad'];
				}
                
				$disponible=($row['cantidadmax'])-($cantidad);
                
				if ($cantidad==$row['cantidadmax'])
				{
					echo "<td style='background:#99CEFF;'>";
					echo "&nbsp;Casilla: ".$row['nombre']."<br />";
				}else{
					echo "<td>";
                    
					echo "&nbsp;<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"agrega_agendamiento('".$iduser."','".$row['nombre']."')\">Casilla: ".$row['nombre']."</a><br />";
				}
				echo "&nbsp;Disponible: ".$disponible."&nbsp;&nbsp;&nbsp;<br />";
                if ($cantidad>0){
                    echo "&nbsp;<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"listar_ordenes_blank('".$fecha."','".$row['nombre']."','".$comuna."')\">Agendados: ".$cantidad."</a><br />";
                    
                }else{
                    echo "&nbsp;Agendados: $cantidad";
                }
                echo "</td>";
			}
			echo"</tr>";
			echo "</table>";
            echo "<br />";
		}
		mysqli_close($link);
}else{
?>
    <br />
    <div class='callout callout-danger'><?php  echo "Seleccione Comuna Valida"; ?></div> 
<?php   
}
?>
