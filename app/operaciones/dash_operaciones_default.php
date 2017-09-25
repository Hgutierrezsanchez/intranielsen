<head>
	<meta charset="utf-8">
</head>
<?php 
    include_once("../../includes/conexion.php");
    $link=conectar();
    
    $sql="Select new_territorio from tbl_pendiente_territorio Where lower(Mercado)='nielsen' group by new_territorio";
    $result=mysqli_query($link,$sql);
    
        

?>
<section class="content-header">
    <h4>
        <i class="fa fa-tachometer"></i> OPERACIONES
        <div id="zona">
           ZONA: 
            <SELECT id="zona_select" NAME="zona_select" SIZE="auto"> 
                <option selected='selected'>TODAS</option>
                <?php
                while($row = mysqli_fetch_object($result)){
                    echo "<option>".$row->new_territorio."</option>";
                }
                mysqli_free_result($result);
                ?>   
            </SELECT>
            Fecha:
            <input id="fecha" type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
        </div>
    </h4>
</section>

<section class="content">
    <div class="box-body">
        <div class="row">
            <div class="col-lg-5">
                <div id="tabla_pendientes" class="table-responsive">
                    <?php include_once('tablas/tabla_pendientes.php'); ?>
                </div>
            </div>
            <div class="col-lg-7">
                <div id="contenedor_graf_pendiente_reag" class="table-responsive">
                </div>
            </div>
            
        </div>
        <br />
        <div class="row">
            <div class="col-lg-12">
                <div id="contenedor_graf_pendiente" class="table-responsive">
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    mysqli_close($link);
?>