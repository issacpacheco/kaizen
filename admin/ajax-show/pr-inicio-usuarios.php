<?php
include("class/allClass.php");

use nsinfoconsultas\infoconsultas;
$info = new infoconsultas();

$mejorequipo    = $info -> obtener_mejor_equipo();
$equipoperte    = $info -> obtener_equipo_perteneciente();
$mejorgenera    = $info -> obtener_mejor_generdor();
$mispuntos      = $info -> obtener_mis_puntos();

?>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-body btn-success text-white">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin">Puntos: <?php echo $mejorequipo['puntos'][0]; ?></h3>
                    <span class="text-uppercase text-size-mini">Equipo: <?php echo $mejorequipo['nombre'][0]; ?> </span>
                </div>

                <div class="media-right h1">
                    <i class="fas fa-wreath"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-body btn-info text-white">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin">Puntos: <?php echo $equipoperte['puntos'][0]; ?></h3>
                    <span class="text-uppercase text-size-mini">Equipo perteneciente: <?php echo $equipoperte['nombre'][0]; ?></span>
                </div>

                <div class="media-right h1">
                    <i class="fas fa-users-class"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-body btn-warning text-white">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin">Puntos: <?php echo $mejorgenera['puntos'][0]; ?></h3>
                    <span class="text-uppercase text-size-mini">Generador con mayor puntaje: <?php echo $mejorgenera['nombre'][0]; ?> </span>
                </div>

                <div class="media-right h1">
                    <i class="fas fa-stars"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-body btn-danger text-white">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin">Puntos: <?php echo $mispuntos['puntos'][0]; ?></h3>
                    <span class="text-uppercase text-size-mini">Generador de la plataforma: <?php echo $mispuntos['nombre'][0]; ?></span>
                </div>

                <div class="media-right h1">
                    <i class="fas fa-child"></i>
                </div>
            </div>
        </div>
    </div>
</div>