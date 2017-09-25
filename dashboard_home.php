<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
               
            <div class="row"><!-- Fila administrador -->
                <?php 
                if ($_SESSION['admin']==1){
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Informar Actualización</span>
                            <p />
                            <p />
                            <a href="#" onclick="informar_actualizacion_app()"><button class='btn btn-block btn-success btn-sm'>Informar</button></a>
                            <div id="informa_update_app"></div>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col --> 
                <?php
                }
                ?>
            </div>
            
            <div class="row">
                  
                
                
            </div>
            
            
            
        </section><!-- /.content -->