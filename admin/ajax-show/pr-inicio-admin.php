<?php
include("class/allClass.php");

use nsinfoconsultas\infoconsultas;
use nsfunciones\funciones;
$fn = new funciones();
$info = new infoconsultas();

$equipos    = $info -> obtener_equipos();
$cequipos   = $fn -> cuentarray($equipos);
?>
<div class="panel-body" id="contenedorAdmin">
    <div class="col-sm-12">
        <div class="col-sm-4">
            <label for="">Mes</label>
            <select name="mes" id="mes" class="form-control">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>
        <div class="col-sm-4">
            <label for="">Año</label>
            <select name="anio" id="anio" class="form-control">
                <option value="0">Seleccione un año</option>
                <?php for($i = 0, $año = 2021; $i < 10; $i++){ 
                    $años = $año + $i;?>
                <option value="<?php echo $años; ?>"><?php echo $años; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-sm-4">
            <label for="">Equipo</label>
            <select name="equipo" id="equipo" class="form-control">
                <option value="0">Seleccione un equipo</option>
                <?php for($i = 0; $i < $cequipos; $i++){ ?>
                <option value="<?php echo $equipos['id'][$i]; ?>"><?php echo $equipos['nombre'][$i]; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button type="button" onclick="obtener_ranking();" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i> Obtener información </button>
        </div>
    </div>
</div>