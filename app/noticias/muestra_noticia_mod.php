<?php 
include("../../includes/conexion.php");
$link=conectar();
$id = $_POST['id'];
            $dc=mysqli_query($link,"Select * from tbl_noticias_blog where id='$id' ");         while($titulo=mysqli_fetch_array($dc)){                           
            ?>

        <head>
            <meta charset="utf-8">
        </head>
        <a href="#" onclick="cerrar_div_modal()" style="float: right;">
            <button class='btn btn-block btn-success btn-xs'>SALIR</button>
        </a>
        <div class="box-body col-sm-4">
            
        </div>

       <div class="box-body col-sm-4">
        <div class="mod">
           <center>
        
            <form method="POST" id="modificaa" name="modificaa">
              <div class="form-group">
                  <label id="id1" name="id1" value="<?php echo $id ?>">Noticia con ID <?php echo $id ?></label>
                </div>
                <div class="form-group">
                <label>Titulo:</label>
                    <input class="form-control" type="text" value="<?php echo $titulo['titulo']; ?>" name="titulo1" id="titulo1">
                </div>
                <div class="form-group">
                <label>Descripción corta:</label> 
                <input class="form-control" type="text" value="<?php echo $titulo['dcorta']; ?>" id="dcorta1" name="dcorta1">
                </div>
                <div class="form-group">
                <label>Descripción larga:</label> 
                    <input class="form-control" type="text" value="<?php echo $titulo['dlarga']; ?>" id="dlarga1" name="dlarga1">
                </div>
                <div class="form-group">
                <label>Estatus:</label> 
                <select class="form-control" class="control" value="<?php echo $titulo['estatus']; ?>" id="importancia1" name="importancia1">
                    <option>importante1</option>
                    <option>importante2</option>
                    <option>importante3</option>
                    <option>No es importante</option>
              </select>
                </div>
                <br>
                <br>
                <button class="btn btn-secondary" type="submit" onclick="modificarnoticiass(<?php echo $titulo['id'] ?>); return false"  id="btnmod2">
                      <span>Modificar
                      </span>
                </button>
                <br>
            </form>
        </center>
    </div>
    <div id="otros">
    </div>
</div>
<?php }
?>
