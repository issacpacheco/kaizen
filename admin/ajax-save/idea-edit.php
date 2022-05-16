<?php
include("../class/allClass.php");
use conexionbd\mysqlconsultas;
$ejecucion = new mysqlconsultas();

$id     = filter_input(INPUT_POST, 'id',    FILTER_SANITIZE_NUMBER_INT);
$tipo   = filter_input(INPUT_POST, 'tipo',  FILTER_SANITIZE_NUMBER_INT);

$qry = "UPDATE ideas SET tipo_idea = '$tipo' WHERE id = '$id'";
$ejecucion->ejecuta($qry);