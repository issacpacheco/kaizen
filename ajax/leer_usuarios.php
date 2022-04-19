<?php
include("../includes/config.php");
if (isset($_POST['id']))
{
	$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$_POST['id_idea']."'");
	$d = mysqli_fetch_array($consulta);
	$id_usuario = $d['id_usuario'];
	
	$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id_equipo = '".$_POST['id']."' AND nivel = 3");	
	while ($d = mysqli_fetch_array($consulta))
	{
		if ($id_usuario==$d['id'])
		{
			$datos.='<option value="'.$d['id'].'" selected>'.$d['usuario'].'</option>';
		}
		else
		{
			$datos.='<option value="'.$d['id'].'">'.$d['usuario'].'</option>';
		}
	}
}
echo $datos;
exit();
?>

