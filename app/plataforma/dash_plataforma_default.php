<head>
	<meta charset="utf-8">
</head>
<?php
    
    $link=conectar();
    
?>
<section class="content-header">
    <h4>
        <i class="fa fa-headphones"></i> PLATAFORMA
    </h4>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Resumen Gestión Nivel 1</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
             
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Resumen Gestión Nivel 4</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            
        </div>
    </div>
</section>
<?php
    mysqli_close($link);
?>