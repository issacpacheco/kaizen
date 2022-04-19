<?php
$conexion = mysqli_connect("localhost","root","toor2017","kaizen");
//$conexion = mysqli_connect("localhost","leafseve_kaizen_user","fabricandomarcas","leafseve_kaizen");
mysqli_query($conexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$hoy = date("Y-m-d");
$anio = substr($hoy,0,4);
$hora = date('H:i:s');
$mes_actual = substr($hoy,5,2);
$meses = array("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

switch ($_POST['token']){
	case md5(1):{
		$min = 12;
		$max = 2;
		break;
	}
	case md5(2):{
		$min = 3;
		$max = 5;
		break;
	}
	case md5(3):{
		$min = 6;
		$max = 8;
		break;
	}
	case md5(4):{
		$min = 9;
		$max = 11;
		break;
	}
	default:{
		if ($mes_actual <=2)
		{
			$min = 12;
			$max = 2;
		}
		else if ($mes_actual <=5)
		{
			$min = 3;
			$max = 5;
		}
		else if ($mes_actual <=6)
		{
			$min = 6;
			$max = 8;
		}
		else if ($mes_actual <=9)
		{
			$min = 9;
			$max = 11;
		}
		break;
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>KAIZEN</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="images/favicon.png"/>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'/>

	<!-- Styling -->
	<link rel="stylesheet" href="addons/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="addons/toastr/toastr.min.css"/>
	<link rel="stylesheet" href="addons/fontawesome/css/font-awesome.css"/>
	<link rel="stylesheet" href="addons/ionicons/css/ionicons.css"/>
	<link rel="stylesheet" href="addons/noUiSlider/nouislider.min.css"/>

	<link rel="stylesheet" href="styles/style.css"/>
	<link rel="stylesheet" href="styles/theme-blue.css" class="theme"/>
	<!-- End of Styling -->

	<!-- FontAwesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">
	<style>
		body{
			
		}
		.panel-options a {
			color: #fff;
			opacity: 1;
		}
		.panel.panel-gold > .panel-heading {
			background-color: #c9b037;
			color: #fff;
		}
		.panel.panel-silver > .panel-heading {
			background-color: #b4b4b4;
			color: #fff;
		}
		.panel.panel-bronze > .panel-heading {
			background-color: #ad8a56;
			color: #fff;
		}
		.border-gold{
			border: 1px solid #c9b037;
		}
		.border-silver{
			border: 1px solid #b4b4b4;
		}
		.border-bronze{
			border: 1px solid #ad8a56;
		}
		.text-gold{
			color: #c9b037;
		}
		.text-silver{
			color: #b4b4b4;
		}
		.text-bronze{
			color: #ad8a56;
		}
		
	</style>
</head>

<body>
	<!-- Main content-->
	<div class="container" style="padding-top: 20px">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel">
					<div class="panel-heading">
                    	<h1 class="text-center">KAIZEN</h1>
					</div>
                    <div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<h2 class="text-center text-uppercase">Ideas ganadoras e implementadas <?php echo isset($_POST['anio'])?$_POST['anio']:$anio;?></h2>
							</div>
						</div>
						<form action="kaizen.php" method="post">
							<div class="row">
								<div class="col-lg-3">
									<label>Año</label>
									<select class="form-control" name="anio">
										<?php 
										$consulta = mysqli_query($conexion,"SELECT DISTINCT anio FROM ranking");
										while ($d=mysqli_fetch_array($consulta))
										{
											if ($_POST['anio']==$d['anio'])	
											{
												echo '<option value="'.$d['anio'].'" selected>'.$d['anio'].'</option>';
											}
											else
											{
												echo '<option value="'.$d['anio'].'">'.$d['anio'].'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="col-lg-6">
									<label>Área</label>
									<select class="form-control" name="id_tipo">
										<?php
										$sel1=$_POST['id_tipo']==1?'selected':'';
										$sel2=$_POST['id_tipo']==2?'selected':'';
										?>
										<option value="1" <?php echo $sel1;?>>Administrativo (UEAS)</option>
										<option value="2" <?php echo $sel2;?>>Estaciones (UENS)</option>
									</select>
								</div>
								<div class="col-lg-3">
									<label>&nbsp;</label>
									<button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i> Ver</button>
								</div>
							</div>
						</form>
						<br>
						<div class="row">
							<div class="col-lg-3">
								<form action="kaizen.php" method="post">
									<button type="submit" class="btn btn-block btn-dark"><i class="fas fa-calendar-alt"></i> Primer trimestre</button>
									<input type="hidden" name="token" value="<?php echo md5(1);?>">
									<input type="hidden" name="id_tipo" value="<?php echo $_POST['id_tipo'];?>">
									<input type="hidden" name="anio" value="<?php echo $_POST['anio'];?>">
								</form>
							</div>
							<div class="col-lg-3">
								<form action="kaizen.php" method="post">
									<button type="submit" class="btn btn-block btn-dark"><i class="fas fa-calendar-alt"></i> Segundo trimestre</button>
									<input type="hidden" name="token" value="<?php echo md5(2);?>">
									<input type="hidden" name="id_tipo" value="<?php echo $_POST['id_tipo'];?>">
									<input type="hidden" name="anio" value="<?php echo $_POST['anio'];?>">
								</form>
							</div>
							<div class="col-lg-3">
								<form action="kaizen.php" method="post">
									<button type="submit" class="btn btn-block btn-dark"><i class="fas fa-calendar-alt"></i> Tercer trimestre</button>
									<input type="hidden" name="token" value="<?php echo md5(3);?>">
									<input type="hidden" name="id_tipo" value="<?php echo $_POST['id_tipo'];?>">
									<input type="hidden" name="anio" value="<?php echo $_POST['anio'];?>">
								</form>
							</div>
							<div class="col-lg-3">
								<form action="kaizen.php" method="post">
									<button type="submit" class="btn btn-block btn-dark"><i class="fas fa-calendar-alt"></i> Cuarto trimestre</button>
									<input type="hidden" name="token" value="<?php echo md5(4);?>">
									<input type="hidden" name="id_tipo" value="<?php echo $_POST['id_tipo'];?>">
									<input type="hidden" name="anio" value="<?php echo $_POST['anio'];?>">
								</form>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10">
								<?php
								$tipo = $_POST['id_tipo']!=''?$_POST['id_tipo']:1;
								$anio = isset($_POST['anio'])?$_POST['anio']:$anio;
								$consulta = mysqli_query($conexion,"SELECT * FROM ranking WHERE mes >= '".$min."' AND mes <='".$max."' AND anio = '".$anio."' ORDER BY ranking");
								if ($min == 12)
								{
									$consulta = mysqli_query($conexion,"SELECT * FROM ranking WHERE mes = '".$min."' AND anio = '".($anio-1)."' UNION ALL SELECT * FROM ranking WHERE mes <='".$max."' AND anio = '".$anio."' ORDER BY ranking");
								}
								
								while ($d = mysqli_fetch_array($consulta))
								{
									//Idea
									$consulta1 = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$d['id_idea']."'");
									$d1 = mysqli_fetch_array($consulta1);
									
									//Equipo
									$consulta2 = mysqli_query($conexion,"SELECT * FROM equipos WHERE id = '".$d1['id_equipo']."'");
									$d2 = mysqli_fetch_array($consulta2);
									if ($d2['tipo']!=$tipo)
									{
										//echo "SELECT * FROM equipos WHERE id = '".$d1['id_equipo']."'";
										continue;
									}
									
									$lugar = $d['ranking']==1?'GANADOR':$d['ranking'].'º Lugar';
									
									switch($d['ranking']){
										case 1:{
											$class = 'panel-gold border-gold';
											$color = 'text-gold';
											$lugar = 'GANADOR';
											break;
										}
										case 2:{
											$class = 'panel-silver border-silver';
											$color = 'text-silver';
											$lugar = $d['ranking'].'º Lugar';
											break;
										}
										case 3:{
											$class = 'panel-bronze border-bronze';
											$color = 'text-bronze';
											$lugar = $d['ranking'].'º Lugar';
											break;
										}
										default:{
											$class = 'panel-success';
											$lugar = $d['ranking'].'º Lugar';
											break;
										}
									}
									
								?>
								<div class="panel <?php echo $class;?>">
									<div class="panel-heading">
										<?php echo $lugar;?>
										 <div class="panel-options">
											<a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-6">
											<?php
												if (file_exists('videos/'.$d1['id'].'.mp4'))
												{
													$video = 'videos/'.$d1['id'].'.mp4';
												?>
												<div align="center" class="embed-responsive embed-responsive-16by9">
													<video class="embed-responsive-item" controls>
														<source src="<?php echo $video;?>" type="video/mp4">
													</video>
												</div>
												<?php
												}
												?>
											</div>
											<div class="col-lg-6">
												<h2 class="<?php echo $color;?> text-uppercase"><i class="fas fa-medal"></i> <?php echo $d1['nombre'];?></h2>
												<p>Periodo: <strong><?php echo $meses[$min].' - '.$meses[$max];?></strong></p>
												<p>Equipo: <strong><?php echo $d2['nombre'];?></strong></p>
												<p>Promotor: <strong><?php echo $d['promotor'];?></strong></p>
												<p>Generador: <strong><?php echo $d['generador'];?></strong></p>
											</div>
										</div>
										<div class="row" style="margin-top: 20px">
											<div class="col-lg-12">
											<p><?php echo nl2br($d1['idea_propuesta']);?></p>
											</div>
										</div>
									</div>
								</div>
								
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Main content-->

	<div class="scripts">

		<!-- Addons -->
		<script src="addons/jquery/jquery.min.js"></script>
		<script src="addons/jquery-ui/jquery-ui.min.js"></script>
		<script src="addons/bootstrap/js/bootstrap.min.js"></script>
		<script src="addons/toastr/toastr.min.js"></script>

		<!-- scripts -->
		<script src="addons/scripts.js"></script>
		<!-- SwwetAlert -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		
	</div>

</body>

</html>