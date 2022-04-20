<?php
include( "includes/config.php" );
session_start();
//Verificar que no exista en la base de datos
extract($_REQUEST);

if ($opcion == 1)//ALTA
{
	$mes_actual = substr($hoy,5,2);
	//$mes_actual = 1;
	if ($mes_actual == 1 && $mes == 12)
	{
		$anio--;
	}
	
	if ($_SESSION['nivel'] > 1)
	{
		$id_equipo = $_SESSION['id_equipo'];
		$id_usuario = $_SESSION['id_usuario'];
	}
	
	if (isset($_POST['anio']))
	{
		$anio = $_POST['anio'];
	}
	
	mysqli_query($conexion,"ALTER TABLE ideas AUTO_INCREMENT = 0");
	if (mysqli_query($conexion,"INSERT INTO ideas VALUES (
	'0', 
	'".$id_equipo."',
	'".$id_usuario."', 
	'".$nombre."', 
	'".$mes."', 
	'".$anio."', 
	'".$idea_nueva."', 
	'".$departamento."', 
	'".$status."',
	'".$fecha_implementacion."',
	'".addslashes($problematica)."', 
	'".addslashes($idea_propuesta)."', 
	'".addslashes($resultado)."',
	'".$id_colaborador."',
	'".$inversion_cant."',
	'".$beneficio_cant."',
	'0')"))
	{
		$id = mysqli_insert_id($conexion);
		
		//Crear carpeta
		rename("images/ideas/temp_bak","images/ideas/".$id);
		rename("images/ideas/temp_bak/medium","images/ideas/".$id."/medium");
		rename("images/ideas/temp_bak/thumb","images/ideas/".$id."/thumb");
		echo $id;//Se guardo el registro satisfactoriamente
	}
	else
	{
		echo "-1";//Ocurrío un error en el sistema
	}
}
else if ($opcion == 2)//CAMBIOS
{
	if ($_SESSION['nivel'] > 1)
	{
		$id_equipo = $_SESSION['id_equipo'];
		$id_usuario = $_SESSION['id_usuario'];
		
		if (mysqli_query($conexion,"UPDATE ideas SET 
		nombre ='".$nombre."',
		id_equipo = '".$id_equipo."',
		id_usuario = '".$id_usuario."', 
		mes ='".$mes."', 
		idea_nueva = '".$idea_nueva."', 
		departamento = '".$departamento."',
		status ='".$status."', 
		fecha_implementacion ='".$fecha_implementacion."', 
		problematica ='".addslashes($problematica)."',
		idea_propuesta ='".addslashes($idea_propuesta)."',
		resultado ='".addslashes($resultado)."'
		WHERE id = '".$id."'"))
		{
			echo $id;//Se guardo el registro satisfactoriamente
		}
		else
		{
			echo "-1";//Ocurrío un error en el sistema
		}
	}
	else
	{
		if (mysqli_query($conexion,"UPDATE ideas SET 
		nombre ='".$nombre."',
		id_equipo = '".$id_equipo."',
		id_usuario = '".$id_usuario."', 
		mes ='".$mes."', 
		anio = '".$_POST['anio']."',
		idea_nueva = '".$idea_nueva."', 
		departamento = '".$departamento."',
		status ='".$status."', 
		fecha_implementacion ='".$fecha_implementacion."', 
		problematica ='".addslashes($problematica)."',
		idea_propuesta ='".addslashes($idea_propuesta)."',
		resultado ='".addslashes($resultado)."'
		WHERE id = '".$id."'"))
		{
			echo $id;//Se guardo el registro satisfactoriamente
		}
		else
		{
			echo "-1";//Ocurrío un error en el sistema
		}
	}
}
else if ($opcion == 3)//ELIMINAR
{
	$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$id."' LIMIT 1" );
	$result = mysqli_fetch_array($consulta);
	if ($result['id'] != NULL && $result['id'] != '')
	{
		mysqli_query($conexion,"DELETE FROM ideas WHERE id = '".$id."'");
		//Evaluacion
		mysqli_query($conexion,"DELETE FROM evaluacion WHERE id_idea = '".$id."'");
		mysqli_query($conexion,"DELETE FROM evaluacion_criterios WHERE id_idea = '".$id."'");
		
		if ($id != '')
		{
			BorrarCarpeta('images/ideas/'.$id);
		}
		echo $id;//Se elimino el registro satisfactoriamente
	}
}
?>