<?php
include_once("../class/allClass.php");

use conexionbd\mysqlconsultas;
$ejecucion = new mysqlconsultas;

use nsfunciones\funciones;
$fn = new funciones();

$filesize = $_FILES['file']['size'];
$filenamec = $_FILES['file']['name'];
$filenameb = $fn->replace_filename($filenamec);
$filename = $fn->generateRandomString(5)."_".$filenameb; 

$location = "../images/productos/" . $filename;
$id_producto = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$return_arr = array();

if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
    $src = "default.png";

    // checking file is image or not
    if (is_array(getimagesize($location))) {
        $src = $location;
        $src2="images/productos/".$filename;
    }    

    $qry = "UPDATE productos SET foto = '$filename' WHERE id = '$id_producto'";
    $idfoto = $ejecucion->ejecuta($qry);
    $return_arr = array("name" => $filename, "size" => $filesize, "src" => $src2, "idfoto" => $idfoto);    
}

echo json_encode($return_arr);
