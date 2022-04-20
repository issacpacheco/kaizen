<?php 
session_start();
include('carrito.php');
$id = $_POST['id'];
$estatus = $_POST['estatus'];
if($estatus == '1'){
    foreach($_SESSION['carrito'] as $indice=>$listaProductos){
        if($listaProductos['id'] == $id){
            unset($_SESSION["carrito"][$indice]);
            $_SESSION["carrito"]=array_values($_SESSION["carrito"]);
        }
    }
}


?>