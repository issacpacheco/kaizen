<?php 
include("includes/config.php");
extract( $_REQUEST );
$titulo = "Ranking";
$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$id."' LIMIT 1");
$d = mysqli_fetch_array($consulta);

$consulta1 = mysqli_query($conexion,"SELECT * FROM ranking WHERE id_idea = '".$id."' LIMIT 1");
$d1 = mysqli_fetch_array($consulta1);
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
	
	<style>
		label {
    		margin-top: 10px !important;
		}		
	</style>
		
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
							<section class="col-lg-12 col-md-12 col-sm-12">
								<form method="post" action="ideas.php" enctype="multipart/form-data">							
									<div class="form-group">
										<div class="row">
											<div class="col-md-9">
												<label>Nombre</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" value="<?php echo $d['nombre'];?>" readonly>
												</div>
											</div>
											<div class="col-md-3">
												<label>Ranking</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-star fa-fw"></i></span>
													<input type="number" class="form-control" placeholder="Ranking" name="ranking" id="ranking" value="<?php echo $d1['ranking'];?>">
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Promotor</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Nombre del promotor" name="promotor" value="<?php echo $d1['promotor'];?>">
												</div>
											</div>
											<div class="col-md-6">
												<label>Generador</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
													<input type="text" class="form-control" placeholder="Nombre del generador de la idea" name="generador" value="<?php echo $d1['generador'];?>">
												</div>
											</div>
										</div>
									</div>
									

									<div class="form-group">
										<div class="row">
											<label class="col-md-12">Idea propuesta</label>
										</div>                                        
									</div> 
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<textarea class="form-control" rows="6" name="idea_propuesta" id="idea_propuesta"><?php echo $d['idea_propuesta'];?></textarea>
											</div>
										</div>
									</div>
									
									<?php
									if (file_exists('videos/'.$d['id'].'.mp4'))
									{
										$video = 'videos/'.$d['id'].'.mp4';
									?>
									<div class="row">
										<div class="form-wrapper col-sm-6 col-sm-offset-3">
											<label>Video Actual</label>
											<div align="center" class="embed-responsive embed-responsive-16by9">
												<video class="embed-responsive-item" controls>
													<source src="<?php echo $video;?>" type="video/mp4">
												</video>
											</div>
										</div>
									</div>
									<?php
									}
									?>	

									<div class="row">
										<div class="form-wrapper col-sm-12">
											<label>Video (Formato mp4)</label>
											<div class="form-group">
												<input type="file" class="form-control" name="video" id="video" accept="video/mp4">
											</div>
										</div>
									</div>
									
									<input type="hidden" name="id" value="<?php echo $d['id'];?>">
									
									<div class="row">
										<div class="col-lg-8">
											<button type="submit" class="btn btn-success btn-lg btn-block" id="boton"><i class="fa fa-save"></i> Guardar</button>
										</div>
										<div class="col-lg-4">
											<a href="ideas.php" class="btn btn-default btn-lg btn-block"><i class="fa fa-close"></i> Cancelar</a>
										</div>
									</div>
								</form>
							</section>
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

</html>