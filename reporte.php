<?php 
include("includes/config.php");
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
							<h2 class="text-center">Reportes</h2>
                        </div>
						
						<div class="panel-body">							
							<form action="reporte.php" method="post" id="registro-form">
								<div class="row">
									<div class="form-wrapper col-sm-3">
										<label>Trimestre</label>
										<div class="form-group ">
											<select class="form-control" name="trimestre">
												<?php
												if ($_POST['trimestre'] == 0 )
												{
													echo '
												<option value="0" selected>Todos</option>
												<option value="1">Primer trimestre</option>
												<option value="2">Segundo trimestre</option>
												<option value="3">Tercer trimestre</option>
												<option value="4">Cuarto trimestre</option>';
												}
												else if ($_POST['trimestre'] == 1 )
												{
													echo '
												<option value="0">Todos</option>
												<option value="1" selected>Primer trimestre</option>
												<option value="2">Segundo trimestre</option>
												<option value="3">Tercer trimestre</option>
												<option value="4">Cuarto trimestre</option>';
												}
												else if ($_POST['trimestre'] == 2 )
												{
													echo '
													<option value="0">Todos</option>
													<option value="1">Primer trimestre</option>
													<option value="2" selected>Segundo trimestre</option>
													<option value="3">Tercer trimestre</option>
													<option value="4">Cuarto trimestre</option>';
												}
												else if ($_POST['trimestre'] == 3 )
												{
													echo '
													<option value="0">Todos</option>
													<option value="1">Primer trimestre</option>
													<option value="2">Segundo trimestre</option>
													<option value="3" selected>Tercer trimestre</option>
													<option value="4">Cuarto trimestre</option>';
												}
												else if ($_POST['trimestre'] == 4 )
												{
													echo '
													<option value="0">Todos</option>
													<option value="1">Primer trimestre</option>
													<option value="2">Segundo trimestre</option>
													<option value="3">Tercer trimestre</option>
													<option value="4" selected>Cuarto trimestre</option>';
												}
												else
												{
													echo '
													<option value="0">Todos</option>
													<option value="1" selected>Primer trimestre</option>
													<option value="2">Segundo trimestre</option>
													<option value="3">Tercer trimestre</option>
													<option value="4">Cuarto trimestre</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-wrapper col-sm-3">
										<label>Año</label>
										<select class="form-control" name="anio">
										<?php
										$consulta_cat = mysqli_query($conexion,"SELECT MIN(anio) AS anio FROM ideas");
										$cat = mysqli_fetch_array($consulta_cat);
										for ($c=$cat['anio'];$c<=$anio;$c++)
										{
											if ($_POST['anio']==$c)
											{
												echo '<option value="'.$c.'" selected>'.$c.'</option>';
											}
											else
											{
												echo '<option value="'.$c.'">'.$c.'</option>';
											}
										}
										?>
										</select>
									</div>
									<div class="form-wrapper col-sm-3">
										<label>Estatus de idea</label>
										<select name="status" id="status" class="form-control">
											<?php
											$selected1 = $_POST['status']==1?'selected':'';
											$selected2 = $_POST['status']==2?'selected':'';
											?>
											<option value="1" <?php echo $selected1;?>>Generada</option>
											<option value="2" <?php echo $selected2;?>>Implementada</option>
										</select>
									</div>
									<div class="form-wrapper col-sm-3">
										<label>Área</label>
										<select name="tipo" class="form-control">
											<?php
											$selected1 = $_POST['tipo']==1?'selected':'';
											$selected2 = $_POST['tipo']==2?'selected':'';
											?>
											<option value="1" <?php echo $selected1;?>>Administrativo (UEAS)</option>
											<option value="2" <?php echo $selected2;?>>Estaciones (UENS)</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<button type="submit" class="btn btn-success btn-block btn-lg">Buscar <i class="fa fa-search"></i></button>
									</div>
								</div>								
                            </form>							
							<br>
							<div class="row">
								<div class="col-sm-12">
									<div class="panel">
										<div class="panel-heading">
											Período:
											<?php 
											if ($_POST['trimestre'] == 0)
											{
												echo 'Todos';
											}
											else
											{
												echo $_POST['trimestre'] <=3 ? $_POST['trimestre'].'er Trimestre '.$_POST['anio']:$_POST['trimestre'].'to Trimestre '.$_POST['anio'];
											}
											?>
										</div>
										<div class="panel-body">
											<div id="grafica"></div>
										</div>
									</div>
								</div>
							</div>
												
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
		<!-- Current page scripts -->
        <div class="current-scripts">
			<!-- Current page addons -->
			
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <!-- Charts -->
            <script>
            	google.charts.load('current', {packages: ['corechart', 'bar']});
      			google.charts.setOnLoadCallback(Grafica);

      			function Grafica() {
					
					var data = google.visualization.arrayToDataTable([
						["Área", "Resultado", { role: "style" }, { role: 'annotation' } ],
						<?php
							//Todos los proveedores todos los clientes
							$cantidad=0;
							$total_final = 0;
							if ($_POST['trimestre'] >= 0)
							{
								switch ($_POST['trimestre']){
									case 0:{
										$min = 12;
										$max = 11;
										break;
									}
									case 1:{
										$min = 12;
										$max = 2;
										break;
									}
									case 2:{
										$min = 3;
										$max = 5;
										break;
									}
									case 3:{
										$min = 6;
										$max = 8;
										break;
									}
									case 4:{
										$min = 9;
										$max = 11;
										break;
									}
								}
								
								$titulo = $_POST['status']==1?'GENERADAS':'IMPLEMENTADAS';
								$area = $_POST['tipo']==1?'ADMINISTRATIVO':'ESTACIONES';
								//Todos los aspectos
								$consulta = mysqli_query($conexion,"SELECT * FROM equipos WHERE tipo = '".$_POST['tipo']."'");
								while($d = mysqli_fetch_array($consulta))
								{
									$total = 0;
									if ($min == 12)
									{
										$consulta2 = mysqli_query($conexion,"SELECT * FROM ideas WHERE status = '".$_POST['status']."' AND anio = '".($_POST['anio']-1)."' AND id_equipo = '".$d['id']."' AND mes =".$min." ");
										while ($d2 = mysqli_fetch_array($consulta2))
										{
											$consulta3 = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea ='".$d2['id']."' ");
											$d3 = mysqli_fetch_array($consulta3);
											if ($d3['status']==0)
											{
												continue;
											}
											$total++;
										}
										
										$consulta2 = mysqli_query($conexion,"SELECT * FROM ideas WHERE status = '".$_POST['status']."' AND anio = '".$_POST['anio']."' AND id_equipo = '".$d['id']."' AND mes <=".$max." ");
										while ($d2 = mysqli_fetch_array($consulta2))
										{
											$consulta3 = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea ='".$d2['id']."' ");
											$d3 = mysqli_fetch_array($consulta3);
											if ($d3['status']==0)
											{
												continue;
											}
											$total++;
										}
									}
									else
									{									
										$consulta2 = mysqli_query($conexion,"SELECT * FROM ideas WHERE status = '".$_POST['status']."' AND anio = '".$_POST['anio']."' AND id_equipo = '".$d['id']."' AND mes >=".$min." AND mes <= ".$max." ");
										while ($d2 = mysqli_fetch_array($consulta2))
										{
											$consulta3 = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea ='".$d2['id']."' ");
											$d3 = mysqli_fetch_array($consulta3);
											if ($d3['status']==0)
											{
												continue;
											}
											$total++;
										}
									}
									
									if ($total > 0)
									{
										$cantidad++;
										$nombres[$cantidad] = $d['nombre'];
										$res[$cantidad] = $total;
									}
								}	
								//{ y: 'Aceites y lubricantes', a: 100},
								arsort($res);
								foreach ($res as $key => $val) {
									//key tiene el [id]
									//val tiene el valor
									echo '/*'.$nombres[$key].'*/';
									$color = '#3366cc';
									echo '["'.$nombres[$key].'", '.number_format($res[$key],2).',"'.$color.'","'.number_format($res[$key],2).'"],';
								}
								if ($cantidad==0)
								{
									echo '["", 0, "#3366cc", "0" ]';
								}
							}
							else
							{
								echo '["", 0, "#3366cc", "0" ]';
							}							
						?>
												
						
				  	]);

      				var view = new google.visualization.DataView(data);
      				view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      				var options = {
						
						title: "CANTIDAD DE IDEAS <?php echo $titulo;?> - <?php echo $area;?>",
						height:400,
						bar: {groupWidth: "70%"},
						vAxis:{
							//format: 'percent',
							minValue:0,
							maxValue:100,}
        				};
      				var chart = new google.visualization.ColumnChart(document.getElementById("grafica"));
      				chart.draw(view, options);
					
      			};
                
            </script>
        </div>

    </div>

</body>

</html>