<?php 
include("includes/config.php");
$tabla = 'equipos';
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
	<!--fileupload-->
	<link rel="stylesheet" type="text/css" href="plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
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
							<form action="<?php echo $tabla;?>.php" id="form" method="post" enctype="multipart/form-data">
								<div class="row">										
									<div class="form-wrapper col-sm-6">
										<label>Nombre del equipo</label>
										<div class="form-group">
											<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $d['nombre'];?>">
										</div>
									</div>
									<div class="form-wrapper col-sm-6">
										<label>Área</label>
										<div class="form-group">
											<select name="tipo" id="tipo" class="form-control">
												<?php
												$selected1 = $d['tipo']==1?'selected':'';
												$selected2 = $d['tipo']==2?'selected':'';
												?>
												<option value="1" <?php echo $selected1;?>>Administrativo (UEAS)</option>
												<option value="2" <?php echo $selected2;?>>Estaciones (UENS)</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">										
									<div class="form-wrapper col-sm-12">
										<label>Promotor</label>
										<div class="form-group">
											<input type="text" class="form-control" name="promotor" id="promotor" placeholder="Promotor" value="<?php echo $d['promotor'];?>">
										</div>
									</div>
								</div>
								
								<div class="row">
									<?php
									$img = 'https://via.placeholder.com/600x600/EFEFEF/AAAAAA&amp;text=500x500';
									if (file_exists('images/equipos/'.$d['id'].'.jpg'))
									{
										$img = 'images/equipos/'.$d['id'].'.jpg?v='.rand();
									}
									?>
									<div class="form-group">
										<label class="control-label col-md-3">Logo<br> 
											<small>Tamaño sugerido  500 x 500px</small><br>
											<small>Archivos en formato JPG</small><br>
											<small>Archivos no mayores a 5MB</small><br>
										</label>
										<div class="col-md-9">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 250px; height: 250px;">
													<img src="<?php echo $img;?>" alt="" />
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-info btn-file">
														<span class="fileupload-new"><i class="fa fa-paperclip"></i> Seleccionar foto</span>
														<span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
														<input type="file" class="default" name="imagen" id="imagen" />
													</span>
												</div>
												<div style="margin-top: 20px" id="list">
													<div class="alert alert-info">
														<i class="fa fa-exclamation-circle"></i> Formato de archivo: imagen jpg.
													</div>
													<div class="alert alert-info">
														<i class="fa fa-exclamation-circle"></i> Tamaño máximo de archivo: 5MB.
													</div>
												</div>
												<script>
													document.getElementById('imagen').addEventListener('change', handleFileSelect, false);
													
													function handleFileSelect(evt) 
													{
														var files = evt.target.files;
														var output = [];
														for (var i = 0, f; f = files[i]; i++)
														{
															output.push(f.type == "image/jpeg" ? '<div class="alert alert-info"><i class="fa fa-check"></i> Formato de archivo correcto</div>' : '<div class="alert alert-danger"><i class="fa fa-close"></i> Formato de archivo incorrecto</div>');
															
															output.push(f.size < 5000000 ? '<div class="alert alert-info"><i class="fa fa-check"></i> Tamaño de archivo correcto</div>' : '<div class="alert alert-danger"><i class="fa fa-close"></i> Tamaño de archivo incorrecto</div>');
														}
														document.getElementById('list').innerHTML =  output.join('');
												   }
												
												</script>
											</div>
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
			<!--fileupload-->
			<script type="text/javascript" src="plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
			
        </div>
    </div>

</body>