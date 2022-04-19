<?php 
include("includes/config.php");
$titulo = "Evaluación";
//idea
$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$_POST['id']."' LIMIT 1");
$d = mysqli_fetch_array($consulta);

//Evaluación
$consulta1 = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea = '".$d['id']."' LIMIT 1");
$d1 = mysqli_fetch_array($consulta1);

function LeerArchivos($path)
{
	$dir = opendir($path);
	while ($elemento = readdir($dir)) 
	{
		if($elemento == '.' || $elemento == '..' || $elemento == 'medium' || $elemento == 'thumb') {}
		elseif (esArchivo($elemento,array("jpeg", "jpg","png","gif"))) 
		{						
			
		}
		else
		{
			$elementos[] = $elemento;
		}
	}
	return $elementos;
	closedir($dir); 
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
	<!-- blueimp Gallery styles -->
	<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
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
							<div style="padding: 5px 10px">
								<div class="row">
									<div class="col-lg-12">

										<p>Nombre de la idea: <strong><?php echo $d['nombre'];?></strong></p>
										<p>Mes en que se generó o implementó la idea: <strong><?php echo $meses[$d['mes']];?></strong></p>
										<p>Idea de nueva creación: <strong><?php echo $d['idea_nueva']==1?'Sí':'No';?></strong></p>
										<?php
										if ($d['idea_nueva']==2)
										{
											echo '<p>Departamento/estación que la creó: <strong>'.$d['departamento'].'</strong></p>';
										}
										?>
																				
										<p>Status de la idea: <strong><?php echo $d['status']==1?'Generada':'Implementada';?></strong></p>

										<?php
										if ($d['status']==2)
										{
											echo '<p>Fecha de implementación: <strong>'.Fecha($d['fecha_implementacion']).'</strong></p>';
										}
										?>

										<p>Problemática: <strong><?php echo nl2br($d['problematica']);?></strong></p>
										<p>Idea propuesta: <strong><?php echo nl2br($d['idea_propuesta']);?></strong></p>
										<p>Resultado o beneficio: <strong><?php echo nl2br($d['resultado']);?></strong></p>


									</div>
								</div>
							</div>
							
							<?php
							if ($d['status']==2)
							{
							?>
							<div style="padding: 5px 10px">
								<h3>Fotos de evidencia</h3>

								<div class="row">
									<?php
									$imagenes = LeerImagenes('images/ideas/'.$d['id']);
									for ($c=0;$c<count($imagenes);$c++)
									{
									?>
										<div class="col-lg-3">
											<a href="images/ideas/<?php echo $d['id'].'/'.$imagenes[$c];?>" data-gallery>
												<img src="images/ideas/<?php echo $d['id'];?>/medium/<?php echo $imagenes[$c].'?v='.rand();?>" class="img-thumbnail">
											</a> 
										</div>
									<?php
									}
									$archivos = LeerArchivos('images/ideas/'.$d['id']);
									for ($c=0;$c<count($archivos);$c++)
									{
									?>
										<div class="col-lg-3">
											<a href="images/ideas/<?php echo $d['id'].'/'.$archivos[$c];?>">
												<?php echo $archivos[$c];?>
											</a> 
										</div>
									<?php
									}
									?>
								</div>
							</div>
							<?php
							}
							?>
							
							<hr>
							<form action="ideas.php" id="form" method="post">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label>Clasificación</label>
											<select name="id_clasificacion" id="id_clasificacion" class="form-control">
												<?php
												$consulta_cat = mysqli_query($conexion,"SELECT * FROM clasificacion");
												while($cat = mysqli_fetch_array($consulta_cat))
												{
													if ($d1['id_clasificacion']==$cat['id'])
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
										<div class="col-md-6">
											<label>Estado de la idea</label>
											<select name="status" id="status" class="form-control">
												<?php
												$selected1 = $d1['status']==0?'selected':'';
												$selected2 = $d1['status']==1?'selected':'';
												?>
												<option value="0" <?php echo $selected1;?>>Rechazada</option>
												<option value="1" <?php echo $selected2;?>>Aceptada</option>
											</select>
										</div>
									</div>
								</div>
								
								<?php
								$consulta2 = mysqli_query($conexion,"SELECT * FROM criterios");
								while ($d2 = mysqli_fetch_array($consulta2))
								{
									$consulta3 = mysqli_query($conexion,"SELECT * FROM evaluacion_criterios WHERE id_idea = '".$d['id']."' AND id_criterio = '".$d2['id']."'");
									$d3 = mysqli_fetch_array($consulta3);
								?>
								<div class="form-group">
									<div class="row">
										<label class="col-md-12"><?php echo $d2['nombre'];?></label>
									</div> 
									<?php
									// 1: Libre
									// 2: Sí/No
									if ($d2['tipo_respuesta']==1)
									{
									?>
									<div class="row">
										<div class="col-md-12">
											<textarea class="form-control" rows="6" name="respuesta_<?php echo $d2['id'];?>" placeholder="Respuesta"><?php echo $d3['respuesta'];?></textarea>
										</div>
									</div>
									<?php
									}
									else
									{
									?>
									<div class="row">
										<div class="col-md-2">
											<select name="respuesta_<?php echo $d2['id'];?>" class="form-control">
												<?php
													$selected1 = $d3['respuesta']=='Sí'?'selected':'';
													$selected2 = $d3['respuesta']=='No'?'selected':'';
													?>
													<option value="Sí" <?php echo $selected1;?>>Sí</option>
													<option value="No" <?php echo $selected2;?>>No</option>
											</select>
										</div>
									</div>
									<?php
									}
									?>
								</div>
								<?php
								}
								?>
								
								<div class="row">
									<label class="col-md-12">Retroalimentación</label>
								</div>                                        

								<div class="row">
									<div class="col-md-12">
										<textarea class="form-control" rows="6" name="retroalimentacion" id="retroalimentacion"><?php echo $d1['retroalimentacion'];?></textarea>
									</div>
								</div>
								
								<?php
								if ($_SESSION['nivel']==1)
								{
								?>
								<div class="row" style="margin-top: 10px">
									<div class="col-sm-12">
										<a href="ideas.php" class="btn btn-info btn-lg btn-block"><i class="fa fa-chevron-circle-left"></i> Regresar</a>
									</div>
								</div>
								<?php
								}
								else
								{
								?>
								<div class="row" style="margin-top: 10px">
									<div class="col-sm-8">
										<input type="hidden" name="evaluacion" value="1">
										<input type="hidden" name="id_idea" value="<?php echo $_POST['id'];?>">
										<button type="submit" class="btn btn-success btn-lg btn-block" id="boton">Guardar <i class="fa fa-save"></i></button>
									</div>
									<div class="col-sm-4">
										<a href="ideas.php" class="btn btn-info btn-lg btn-block">Cancelar <i class="fa fa-close"></i></a>
									</div>
								</div>
								<?php
								}
								?>
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
	
	<!-- The blueimp Gallery widget -->
	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" >
		<div class="slides"></div>
		<h3 class="title"></h3>
		<a class="prev"></a>
		<a class="next"></a>
		<a class="close"></a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
	</div>
	<!-- The template to display files available for upload -->
	
	
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
			<!-- blueimp Gallery script -->
			<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
			
        </div>
    </div>

</body>