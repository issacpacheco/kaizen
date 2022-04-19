<?php
if (isset($_POST['usuario']) && isset($_POST['pass']))
{
	$conexion = mysqli_connect("localhost","root","toor2017","kaizen");
	mysqli_query($conexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario = '".mysqli_real_escape_string($conexion,$_POST['usuario'])."' AND pass = '".mysqli_real_escape_string($conexion,$_POST['pass'])."' LIMIT 1");
	if (mysqli_num_rows($consulta) == 0)
	{
		echo "-1";
		exit();	
	}
	else
	{	
		$d = mysqli_fetch_array($consulta);
		$consulta1 = mysqli_query($conexion,"SELECT * FROM nivel_usuarios WHERE id = '".$d['nivel']."'");
		$d1 = mysqli_fetch_array($consulta1);
		session_start();
		$_SESSION['id_admin'] = $d['id'];
		$_SESSION['nombre'] = $d1['nombre'];
		$_SESSION['nivel'] = $d['nivel'];
		$_SESSION['id_equipo'] = $d['id_equipo'];
		$_SESSION['id_usuario'] = $d['id'];
		echo "1";//OK
		exit();
	}
}
?>