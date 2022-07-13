<?php
include("../class/allClass.php");
use conexionbd\mysqlconsultas;
use nsfunciones\funciones;
use nsproductos\productos;

$fn     = new funciones();
$info   = new productos();

$ejecucion = new mysqlconsultas();

$id     = filter_input(INPUT_POST, 'id',    FILTER_SANITIZE_NUMBER_INT);

$lista = $info -> obtener_listado($id);
$clista = $fn -> cuentarray($lista);

$devolucion = 0;
for($i = 0; $i < $clista; $i++){

    $producto = $info -> obtener_material($lista['id_producto'][$i]);

    $totaldevolver = $producto['costo'][0] * $lista['cantidad'][$i];

    $devolucion = $devolucion + $totaldevolver;
}

$puntos = $info -> obtener_puntos($id);

$nuevospuntos = $puntos['puntos'][0] + $devolucion;

$qry = "UPDATE equipos SET puntos = '$nuevospuntos' WHERE id = {$puntos['id'][0]}";
$ejecucion->ejecuta($qry);

$qry = "DELETE FROM canjeo_detalle WHERE id_canjeo = $id";
$ejecucion->ejecuta($qry);

$qry = "DELETE FROM canjeo_productos WHERE id = $id";
$ejecucion->ejecuta($qry);