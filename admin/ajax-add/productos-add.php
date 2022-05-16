<?php
include('../class/allClass.php');
error_reporting(0);

use nsfunciones\funciones;
$fn     = new funciones();
?>

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            Agregar Producto
        </div>
        <div class="panel-body">
            <form id="frmRegistro">
                <div class="row">
                    <div class="form-wrapper col-sm-4">
                        <label>Nombre</label>
                        <div class="form-group">
                            <input type="text" class="form-control validar" name="nombre" id="nombre" placeholder="Nombre" value="">
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Descripcion</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" value="">
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Costo</label>
                        <div class="form-group">
                            <input type="text" class="form-control esnumero" name="costo" id="costo" placeholder="Costo" value="">
                        </div>
                    </div>
                    <div class="form-wrapper col-sm-4">
                        <label>Estatus</label>
                        <div class="form-group">
                            <select name="estatus" id="estatus" class="form-control">
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </form>
            <div class="mright textright">
                <button type="button" class="btnRegresar right btngral" onclick="saveInfo('producto-add', 'pr-incentivos', this);">
                    <span class="letrablanca font14">Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>