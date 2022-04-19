<?php
include ("../includes/config.php");
if (isset($_POST['id']))
{
	$html = '';
	
	//idea
	$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$_POST['id']."' LIMIT 1");
	$d = mysqli_fetch_array($consulta);
	
	//Evaluación
	$consulta1 = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea = '".$d['id']."' LIMIT 1");
	$d1 = mysqli_fetch_array($consulta1);
	$html = '<h4>'.$d1['retroalimentacion'].'</h4>';
}
$row = array(
	"idea"=>$d['nombre'],
	"html"=>$html
);
echo json_encode($row);
?>

