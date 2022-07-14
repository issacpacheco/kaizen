<?php
include("../class/allClass.php");
use conexionbd\mysqlconsultas;
use nsfunciones\funciones;
use nsproductos\productos;

$fn     = new funciones();
$info   = new productos();

$ejecucion = new mysqlconsultas();

$iddetalle  = $_REQUEST['iddetalle'];
$estatus    = $_REQUEST['estatus'];

$contador   = count($iddetalle);
$devolucion = 0;
for($i = 0; $i < $contador; $i++){

    if($estatus[$i] == 3){
        
        $lista = $info -> obtener_detalle($iddetalle[$i]);

        $producto = $info -> obtener_material($lista['id_producto'][0]);

        $totaldevolver = $producto['costo'][0] * $lista['cantidad'][0];
        
        $devolucion = $devolucion + $totaldevolver;

        $puntos = $info -> puntos_equipo($iddetalle[$i]);

        $nuevospuntos = $puntos['puntos'][0] + $devolucion;

        $qry = "UPDATE equipos SET puntos = '$nuevospuntos' WHERE id = {$puntos['id'][0]}";
        $ejecucion->ejecuta($qry);
    }

    $qry = "UPDATE canjeo_detalle SET estatus = $estatus[$i] WHERE id = $iddetalle[$i]";
    $ejecucion->ejecuta($qry);
}

?>
<script>
    location.href = "pr-canjes.php";
</script>