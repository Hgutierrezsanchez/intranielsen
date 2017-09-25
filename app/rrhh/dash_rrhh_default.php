<head>
	<meta charset="utf-8">
</head>

<section class="content-header">
    <h4>
        <i class="fa fa-users"></i> RRHH HD
    </h4>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div id="calendario_dash" class="datepicker" style="" data-date="<?php echo date('d-m-Y'); ?>">
            </div><input type="hidden" id="fecha_cons">
        </div>
        <div class="col-lg-3 col-xs-6" id="carga_dash_dia">
            <div class="table-responsive">
            <?php include_once('principal/resumenes_dia.php'); ?>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6" id="carga_dash_dia2">
            <div class="table-responsive">
            <?php  ?>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6" id="carga_dash_dia3">
            <div class="table-responsive">
            <?php  ?>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
</section>
<script>
        
</script>