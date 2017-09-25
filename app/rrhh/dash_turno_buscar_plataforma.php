<head>
	<meta charset="utf-8">
</head>
 
<section class="content-header">
    <h4>
        <i class="fa fa-th"></i> TURNOS PLATAFORMA
    </h4>
</section>

<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3>Seleccione Fecha de Turno </h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <div class="box-body">

            <form name="form_busca_turno" action="" method="POST" onsubmit="buscar_turno(); return false">
                <table>
                    <tr>
                        <td>Fecha: <input name="fecha_turno" type="date" id="fecha_turno" value="<?php echo date('Y-m-d'); ?>" />
                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="Buscar Turno" />&nbsp;&nbsp;&nbsp;
                            <a href="#" onclick="exporta_excel_turno_plataforma(document.forms[0].fecha_turno.value)" ><button class='btn btn-success btn-xs'> Exportar a Excel </button></a>
                        </td>
                    </tr>
                </table>
            </form>
            <br />
            <div id="turnos_plataforma" class="table-responsive">
                <?php include('turnos/listar_turnos_plataforma.php') ?>
            </div>
                
        </div>
    </div>
</section>
