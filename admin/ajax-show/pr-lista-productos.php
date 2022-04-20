<?php 

include('../class/allClass.php'); 
include('../ajax-save/carrito.php');
use nsproductos\productos;
use nsfunciones\funciones;

$info        = new productos();
$fn          = new funciones();

$productos    = $info  -> obtener_productos();
$cproductos   = $fn    -> cuentarray($productos);

?>
<div class="col-sm-12">
    <div class="panel">
        <div class="row panel-body">
            <div class="col-sm-6 h1">
                Canjeo
                <a href="#">
                    <?php if(!empty($_SESSION['carrito'])){ ?><button class="btn btn-warning white carrito" data-bs-toggle="" data-bs-target="#exampleModal" onclick="showcarrito()">Carrito<span class="fas fa-shopping-cart"></span><span class="NumCar"><?php echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']); ?></span></button><?php }else{ } ?>
                </a>
            </div>
        </div>
        <div class="row panel-body">
            <div class="col-sm-12 h3">
                Los puntos son acumulables en el trimestre y se reinician al finalizar el concurso trimestral (Dejar el espacio para ser editado el texto por el administrador)
            </div>
        </div>
        <div class="panel-body">
            <form action="" method="POST">
                <table class="table table-striped table-bordered table-hover" id="tabla">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Costo</th>
                            <th>Cantidad a canjear</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < $cproductos; $i++){ ?>
                            <input type="hidden" name="id_producto" value="<?php echo $productos['id'][$i]; ?>">
                            <input type="hidden" name="nombre" value="<?php echo $productos['nombre'][$i]; ?>">
                            <input type="hidden" name="descripcion" value="<?php echo $productos['descripcion'][$i]; ?>">
                            <input type="hidden" name="costo" value="<?php echo $productos['costo'][$i]; ?>">
                        <tr>
                            <td style="width:30%;"><img src="images/productos/<?php echo $productos['foto'][$i]; ?>" alt="" style="width:25%;"></td>
                            <td><?php echo $productos['nombre'][$i]; ?></td>
                            <td><?php echo $productos['descripcion'][$i]; ?></td>
                            <td><?php echo $productos['costo'][$i]; ?></td>
                            <td><input type="number" name="cantidad" id="cantidad_canjear" value=""></td>
                            <td><button class="btn btn-primary btnservices fw-light white fw-bold" value="Agregar" name="btnAccion">Agregar</button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>