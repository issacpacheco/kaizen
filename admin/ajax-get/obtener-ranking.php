<?php
include("../class/allClass.php");
use nsinfoconsultas\infoconsultas;
use nsfunciones\funciones;

$trimestre = filter_input(INPUT_POST, 'trimestre', FILTER_SANITIZE_NUMBER_INT);
$anio = filter_input(INPUT_POST, 'anio', FILTER_SANITIZE_NUMBER_INT);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);

switch($trimestre){
    case 1: 
        $condicion = "r.mes >= 1 AND r.mes <= 3 AND r.anio =".$anio;
    break;
    case 2: 
        $condicion = "r.mes >= 4 AND r.mes <= 6 AND r.anio =".$anio;
    break;
    case 3: 
        $condicion = "r.mes >= 7 AND r.mes <= 9 AND r.anio =".$anio;
    break;
    case 4: 
        $condicion = "r.mes >= 10 AND r.mes <= 12 AND r.anio =".$anio;
    break;
}

$info = new infoconsultas();
$fn = new funciones();

$ranking = $info -> obtener_reporte_ranking($condicion);
$cranking = $fn -> cuentarray($ranking);
?>

<?php if($_SESSION['nivel'] == 3 || $_SESSION['nivel'] == 4){ ?>
<table class="table table-striped table-bordered table-hover" id="tabla">
    <thead>
        <tr>
            <th>Ranking</th>
            <th>Puntos</th>
            <th>Equipo o Generador</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < $cranking; $i++){ ?>
        <tr>
            <td><?php echo $ranking['ranking'][$i] ?></td>
            <td><?php echo $ranking['puntos'][$i] ?></td>
            <?php if($tipo == "generador"){ ?>
            <td><?php echo $ranking['generador'][$i] ?></td>
            <?php }else if($tipo == "equipo"){ ?>
            <td><?php echo $ranking['equipo'][$i] ?></td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>
<?php if($_SESSION['nivel'] == 5){ ?>
<table class="table table-striped table-bordered table-hover" id="tabla">
    <thead>
        <tr>
            <th>Ranking</th>
            <th>Puntos</th>
            <th>Equipo</th>
            <th>Nombre de la idea</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < $cproductos; $i++){ ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>
