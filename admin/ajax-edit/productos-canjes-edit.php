<?php
include('../class/allClass.php');

$regresar   = filter_input(INPUT_POST, 'regresar',      FILTER_SANITIZE_SPECIAL_CHARS);
$postload   = filter_input(INPUT_POST, 'returnpage',    FILTER_SANITIZE_SPECIAL_CHARS);
$div        = filter_input(INPUT_POST, 'load',          FILTER_SANITIZE_SPECIAL_CHARS);
$id         = filter_input(INPUT_POST, 'id',            FILTER_SANITIZE_NUMBER_INT);

use nsfunciones\funciones;
use nsproductos\productos;

$fn     = new funciones();
$info   = new productos();


$producto       = $info -> obtener_lista_canjes($id);
$cproducto      = $fn   -> cuentarray($producto);
?>

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            Lista de canjes
        </div>
        <div class="panel-body">
            <form id="frmRegistro">
                <?php for($i = 0; $i < $cproducto; $i++){ ?>
                <input type="hidden" name="idproducto" id="idproducto" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="form-wrapper col-sm-4">
                        <label>Nombre</label>
                        <div class="form-group">
                            <input type="text" class="form-control validar" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $producto['producto'][$i]; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Cantidad</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="costo" id="costo" placeholder="Costo" value="<?php echo $producto['cantidad'][$i]; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Estatus de entrega</label>
                        <div class="form-group">
                            <?php if($producto['estatus'][$i] == 2){ ?>
                                <p>ENTREGADO</p>
                            <?php }else{ ?>
                            <select name="estatus" id="estatus" class="form-control">
                                <option value="2" selected>Selecciona un estatus</option>
                                <option value="1" <?php if($producto['estatus'][$i] == 1){ echo "selected"; }?>>Solicitado</option>
                                <option value="0" <?php if($producto['estatus'][$i] == 0){ echo "selected"; }?>>Entregado</option>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
                <?php } ?>
                <div class="mright textright">
                    <button type="button" class="btnRegresar right btngral" onclick="saveInfo('productos-canje-edit', 'pr-canjes', this);">
                        <span class="letrablanca font14">Guardar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>