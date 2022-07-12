<?php
include("../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsfunciones\funciones;
$ejecucion  = new mysqlconsultas();
$fn         = new funciones();

$json = json_encode($_SESSION['carrito']);
$json_de = json_decode($json,true);
$contador = count($json_de);
if($contador > 0){

    $folio  = "C".$_SESSION['id_equipo']."-".date('ymd').'-'.$fn->generateRandomString(3);
    $qry = "INSERT INTO canjeo_productos (id_equipo,fecha,folio) VALUES ({$_SESSION['id_equipo']},curdate(),'$folio')";
    $sqlid = $ejecucion->ejecuta($qry);

    for($i = 0; $i < $contador; $i++){
        $qry = "INSERT INTO canjeo_detalle (id_canjeo,id_producto,cantidad,estatus) VALUES ($sqlid,{$json_de[$i]['id']},{$json_de[$i]['cantidad']},1)";
        $id = $ejecucion->ejecuta($qry);
    }
    if(isset($id)){
        $qry = "UPDATE equipos SET puntos = {$_SESSION['puntos']} WHERE id = {$_SESSION['id_equipo']}";
        $ejecucion->ejecuta($qry);
        unset($_SESSION['carrito']);
    }
}