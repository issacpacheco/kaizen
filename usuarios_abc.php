<?php 
include("includes/config.php");
$tabla = 'usuarios';
if (!isset($_POST['id']))
{
	//Nueva 
	$titulo = 'Nuevo';
}
else if (isset($_POST['id']))
{
	$consulta = mysqli_query($conexion,"SELECT * FROM $tabla WHERE id = '".$_POST['id']."' LIMIT 1");
	$d = mysqli_fetch_array($consulta);
	if ($_POST['editar'] == 1)
	{
		//Editar
		$titulo = 'Editar';
	}
	else if ($_POST['eliminar'] == 1)
	{
		//Eliminar
		$titulo = 'Eliminar';
		$read = 'readonly';
		$disabled = 'disabled';
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $title;?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height">
    <link rel="shortcut icon" href="images/favicon.png"/>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'/>
    
    <!-- Styling -->
    <link rel="stylesheet" href="addons/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="addons/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="addons/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="addons/ionicons/css/ionicons.css"/>
    <link rel="stylesheet" href="addons/noUiSlider/nouislider.min.css"/>
	
    <link rel="stylesheet" href="styles/style.css"/>
	<link rel="stylesheet" href="styles/<?php echo $theme;?>" class="theme" />	
    <!-- End of Styling -->
	
</head>
<body class="hold-transition">

    <!-- Header -->
    <?php include("includes/header.php");?>
    <!-- End of Header -->

    <!-- Navigation -->
    <?php include("includes/menu.php");?>
    <!-- End of Navigation -->

    <!-- Scroll up button -->
    <a class="scroll-up"><i class="fa fa-chevron-up"></i></a>
    <!-- End of scroll up button -->

    <!-- Main content-->
    <div class="content">
		 <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
					
										
					<div class="panel">
						<div class="panel-heading">
                            <?php echo $titulo;?>
                        </div>
						<div class="panel-body">
							<form action="<?php echo $tabla;?>.php" id="form" method="post">
								<div class="row">
									<div class="form-wrapper col-sm-3">
										<label>Nombre de usuario</label>
										<div class="form-group">
											<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de usuario" value="<?php echo $d['usuario'];?>">
										</div>
									</div>
									<div class="form-wrapper col-sm-3">
										<label>Contraseña</label>
										<div class="form-group">
											<input type="text" class="form-control" name="pass" id="pass" placeholder="Contraseña" value="<?php echo $d['pass'];?>">
										</div>
									</div>
																	
									<div class="form-wrapper col-sm-3">
										<label>Tipo de Usuario</label>
										<div class="form-group">
											<select name="nivel" class="form-control">
												<?php
												$consulta_cat = mysqli_query($conexion,"SELECT * FROM nivel_usuarios WHERE id > 1");
												if ($_SESSION['nivel']==2)
												{
													$consulta_cat = mysqli_query($conexion,"SELECT * FROM nivel_usuarios WHERE id > 2");
												}
												while($cat = mysqli_fetch_array($consulta_cat))
												{
													if ($d['nivel'] == $cat['id'])
													{
														echo '<option value="'.$cat['id'].'" selected>'.$cat['nombre'].'</option>';
													}
													else
													{
														echo '<option value="'.$cat['id'].'">'.$cat['nombre'].'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-wrapper col-sm-3">
										<label>Equipo</label>
										<div class="form-group">
											<select name="id_equipo" class="form-control">
												<?php
												$consulta_cat = mysqli_query($conexion,"SELECT * FROM equipos");
												if ($_SESSION['nivel']==2)
												{
													$consulta_cat = mysqli_query($conexion,"SELECT * FROM equipos WHERE id = '".$_SESSION['id_equipo']."'");
												}
												while($cat = mysqli_fetch_array($consulta_cat))
												{
													if ($d['id_equipo'] == $cat['id'])
													{
														echo '<option value="'.$cat['id'].'" selected>'.$cat['nombre'].'</option>';
													}
													else
													{
														echo '<option value="'.$cat['id'].'">'.$cat['nombre'].'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-8">
										<?php
										if ($_POST['editar'] == 1)
										{
											echo '
											<input type="hidden" name="editar" value="'.$d['id'].'">
											<button type="submit" class="btn btn-success btn-lg btn-block" id="boton">Guardar <i class="fa fa-save"></i></button>
											';
										}
										else if ($_POST['eliminar'] == 1)
										{
											echo '
											<input type="hidden" name="eliminar" value="'.$d['id'].'">
											<button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">Eliminar <i class="fa fa-trash"></i></button>
											';
										}
										else
										{
											echo '
											<input type="hidden" name="alta" value="1">
											<button type="submit" class="btn btn-success btn-lg btn-block" id="boton">Guardar <i class="fa fa-save"></i></button>
											';
										}
										?>
									</div>
									<div class="col-sm-4">
										<a href="<?php echo $tabla;?>.php" class="btn btn-info btn-lg btn-block">Cancelar <i class="fa fa-close"></i></a>
									</div>
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include("includes/footer.php");?>
        <!-- End of Footer -->
    </div>
    <!-- End of Main content-->
	
	
    <div class="scripts">
        <!-- Addons -->
        <script src="addons/jquery/jquery.min.js"></script>
        <script src="addons/jquery-ui/jquery-ui.min.js"></script>
        <script src="addons/bootstrap/js/bootstrap.min.js"></script>
		<script src="addons/fullcalendar/lib/moment.min.js"></script>
        <script src="addons/pacejs/pace.min.js"></script>
        <!-- scripts -->
        <script src="addons/scripts.js"></script>
		
		 <!-- Current page scripts -->
        <div class="current-scripts">
			
			
        </div>
    </div>

</body>