<?php
include("../class/allClass.php");
use conexionbd\mysqlconsultas;
$ejecucion = new mysqlconsultas();

$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
$costo = filter_input(INPUT_POST, 'costo', FILTER_SANITIZE_SPECIAL_CHARS);
$estatus = filter_input(INPUT_POST, 'estatus', FILTER_SANITIZE_NUMBER_INT);

$qry = "INSERT INTO productos (nombre, descripcion, costo, estatus) VALUES ('$nombre','$descripcion','$costo','$estatus')";
$ejecucion->ejecuta($qry);
