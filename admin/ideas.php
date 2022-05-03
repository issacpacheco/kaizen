<?php 
include("includes/config.php");
if ($_POST['evaluacion']==1)
{
	extract($_REQUEST);
	//Verificar si existe la evaluación
	$consulta = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea = '".$_POST['id_idea']."'");
	if (mysqli_num_rows($consulta)>0)
	{
		$contador = count($id_clasificacion);
		$id_clasificacion = "";
		for($i = 0; $i < $contador; $i++){
			$ids_clasificaciones .= $_REQUEST['id_clasificacion'][$i].",";
		}
		$ids_clasificaciones = trim($ids_clasificaciones, ',');
		//UPDATE
		mysqli_query($conexion,"UPDATE evaluacion SET 
		id_clasificacion  = '".$ids_clasificaciones."',
		retroalimentacion = '".addslashes($retroalimentacion)."',
		status = '".$status."',
		fecha = '".$hoy."'
		WHERE id_idea = '".$id_idea."'
		");
		
		//Guardar criterios
		$consulta1 = mysqli_query($conexion,"SELECT * FROM criterios");
		while ($d1 = mysqli_fetch_array($consulta1))
		{
			$aux = 'respuesta_'.$d1['id'];
			mysqli_query($conexion,"UPDATE evaluacion_criterios SET 
			respuesta = '".addslashes($$aux)."'
			WHERE id_idea = '".$id_idea."' AND id_criterio = '".$d1['id']."'");
		}
	}
	else
	{
		$contador = count($id_clasificacion);
		$id_clasificacion = "";
		for($i = 0; $i < $contador; $i++){
			$ids_clasificaciones .= $_REQUEST['id_clasificacion'][$i].",";
		}
		
		$ids_clasificaciones = trim($ids_clasificaciones, ',');
		//INSERT INTO
		mysqli_query($conexion,"ALTER TABLE evaluacion AUTO_INCREMENT = 0");
		mysqli_query($conexion,"INSERT INTO evaluacion VALUES (
		'0',
		'".$id_idea."',
		'".$_SESSION['id_admin']."', 
		'".$ids_clasificaciones."', 
		'".addslashes($retroalimentacion)."', 
		'".$status."',
		'".$hoy."'
		)");
		
		//Guardar criterios
		$consulta1 = mysqli_query($conexion,"SELECT * FROM criterios");
		while ($d1 = mysqli_fetch_array($consulta1))
		{
			$aux = 'respuesta_'.$d1['id'];
			mysqli_query($conexion,"ALTER TABLE evaluacion_criterios AUTO_INCREMENT = 0");
			mysqli_query($conexion,"INSERT INTO evaluacion_criterios VALUES (
			'0',
			'".$id_idea."',
			'".$d1['id']."',
			'".addslashes($$aux)."'
			)");
		}
	}
}
if (isset($_POST['ranking']))
{
	extract( $_REQUEST );
	//Verificar si existe la evaluación
	$consulta = mysqli_query($conexion,"SELECT * FROM ranking WHERE id_idea = '".$id."'");
	if (mysqli_num_rows($consulta)>0)
	{
		//UPDATE
		mysqli_query($conexion,"UPDATE ranking SET 
		ranking = '".$ranking."',
		promotor = '".$promotor."',
		generador = '".$generador."'
		WHERE id_idea = '".$id."'
		");
	}
	else
	{
		$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id = '".$id."'");
		$d = mysqli_fetch_array($consulta);
		//INSERT INTO
		mysqli_query($conexion,"ALTER TABLE ranking AUTO_INCREMENT = 0");
		mysqli_query($conexion,"INSERT INTO ranking VALUES (
		'0',
		'".$id."',
		'".$ranking."',
		'".$promotor."',
		'".$generador."',
		'".$d['mes']."',
		'".$d['anio']."'
		)");
	}
	mysqli_query($conexion,"UPDATE ideas SET 
	idea_propuesta ='".addslashes($idea_propuesta)."'
	WHERE id = '".$id."'");
	
	//No esta entrando cuando se envia el archivo
	//echo 'Archivo:'.$_FILES['video']['tmp_name'];
	//exit();
	if ($_FILES['video']['tmp_name'] != '' && $_FILES['video']['type']=='video/mp4')
	{
		echo copy($_FILES['video']['tmp_name'],'./videos/'.$id.'.mp4');
	}
	
	if ($ranking == '' || $ranking == 0)
	{
		$consulta = mysqli_query($conexion,"DELETE FROM ranking WHERE id_idea = '".$id."'");
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
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
    <link rel="stylesheet" href="addons/ionicons/css/ionicons.css"/>
    <link rel="stylesheet" href="addons/noUiSlider/nouislider.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>

    <link rel="stylesheet" href="styles/style.css"/>
	<link rel="stylesheet" href="styles/<?php echo $theme;?>" class="theme" />	
    <!-- End of Styling -->
	
	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"/>
	
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
		 <div class="container-fluid" id="contenedor">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            IDEAS
                        </div>
                        <div class="panel-body">
							<?php
							if ($_SESSION['nivel']==1 || $_SESSION['nivel']==3 || $_SESSION['nivel'] == 4 || $_SESSION['nivel'] == 5)
							{	
							?>
							<div class="row">
								<div class="col-lg-12">
									<form action="ideas_abc.php" method="post">
										<input type="hidden" name="opcion" value="1">
										<button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i> Nueva idea </button>
									</form>
								</div>
							</div>
							<br>
							<?php
							}
							if ($_SESSION['nivel']==1 || $_SESSION['nivel']==2 || $_SESSION['nivel'] == 4)
							{
							?>
							<form action="ideas.php" method="post">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label>Mes</label>
											<select class="form-control" name="mes">
												<option value="">Todos</option>
											<?php
											for ($c=1;$c<=12;$c++)
											{
												if ($_POST['mes']==$c)
												{
													echo '<option value="'.$c.'" selected>'.$meses[$c].'</option>';
												}
												else
												{
													echo '<option value="'.$c.'">'.$meses[$c].'</option>';
												}
											}
											?>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Año</label>
											<select class="form-control" name="anio">
												<option value="">Todos</option>
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
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Equipo</label>
											<select class="form-control" name="id_equipo">
											<?php
											$consulta_cat = mysqli_query($conexion,"SELECT * FROM equipos");
											if ($_SESSION['nivel']==1 || $_SESSION['nivel'] == 4)
											{
												echo '<option value="">Todos</option>';
											}
											if ($_SESSION['nivel']==2)
											{
												$consulta_cat = mysqli_query($conexion,"SELECT * FROM equipos WHERE id = '".$_SESSION['id_equipo']."'");
											}
											while($cat = mysqli_fetch_array($consulta_cat))
											{
												if ($_POST['id_equipo'] == $cat['id'])
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
									<div class="col-lg-12">
										<button type="submit" class="btn btn-success btn-block btn-lg">Buscar <i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
							<br>
							<?php
							}
							?>

                            <div>
                                <table class="table table-striped table-bordered table-hover" id="tabla">
                                    <thead>
                                        <tr>
											<th> Generador </th>
											<th> Nombre de la idea </th>
											<th> Equipo </th>
											<th> Mes </th>
											<th> Año </th>
											<th> Estatus </th>
											<?php
											if ($_SESSION['nivel']==1 || $_SESSION['nivel'] == 4)
											{	
											?>
											<th> Fecha de evaluación</th>
											<th> <i class="fa fa-search"></i> </th>
											<th> <i class="fa fa-star"></i> </th>
											<th> <i class="fa fa-pencil"></i> </th>
											<th> <i class="fa fa-trash"></i> </th>
											<?php
											}
											else if ($_SESSION['nivel']==2)
											{
											?>
											<th> <i class="fa fa-check"></i> </th>
											<th> <i class="fa fa-check"></i> Concursa</th>
											<?php
											}
											else if ($_SESSION['nivel']==3)
											{
											?>
											<th> Concursa </th>
											<th> <i class="fa fa-check-circle"></i> </th>
											<th> <i class="fa fa-pencil"></i> </th>
											<th> <i class="fa fa-trash"></i> </th>
											<?php
											}
											else if($_SESSION['nivel'] == 5)
											{
											?>
											<th> Fecha de evaluación</th>
											<th> <i class="fa fa-search"></i> </th>
											<th> <i class="fa fa-star"></i> </th>
											<?php
											}
											?>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$query_mes = $_POST['mes']!=''?' mes = "'.$_POST['mes'].'"':' 1 ';
										
										$query_anio = $_POST['anio']!=''?' anio = "'.$_POST['anio'].'"':' 1 ';
										
										$query_equipo = $_POST['id_equipo']!=''?' id_equipo = "'.$_POST['id_equipo'].'"':' 1 ';
										
										if ($_SESSION['nivel']==1 || $_SESSION['nivel'] == 4)
										{
											$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE $query_mes AND $query_anio AND $query_equipo");
										}
										else if($_SESSION['nivel']==2)
										{
											$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id_equipo = '".$_SESSION['id_equipo']."' AND $query_mes AND $query_anio");
										}
										else if ($_SESSION['nivel']==3)
										{
											$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE id_equipo = '".$_SESSION['id_equipo']."' AND id_usuario = '".$_SESSION['id_usuario']."'");
										}
										else if($_SESSION['nivel'] == 5)
										{
											$consulta = mysqli_query($conexion,"SELECT * FROM ideas WHERE $query_mes AND $query_anio AND $query_equipo");
										}
										while ($d = mysqli_fetch_array($consulta))
										{
											$consulta1 = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id = '".$d['id_usuario']."' LIMIT 1");
											$d1 = mysqli_fetch_array($consulta1);
											
											$consulta2 = mysqli_query($conexion,"SELECT * FROM equipos WHERE id = '".$d['id_equipo']."' LIMIT 1");
											$d2 = mysqli_fetch_array($consulta2);
											
											$consulta3 = mysqli_query($conexion,"SELECT * FROM ranking WHERE id_idea = '".$d['id']."' LIMIT 1");
											$d3 = mysqli_fetch_array($consulta3);
											$ranking = $d3['ranking']>0?'('.$d3['ranking'].')':'';
											
											$class = '';
											$fecha_evaluacion = 'Sin evaluar';
											$consulta3 = mysqli_query($conexion,"SELECT * FROM evaluacion WHERE id_idea = '".$d['id']."'");
											if (mysqli_num_rows($consulta3)==0)
											{
												//No se ha evaluado
											}
											else
											{
												//Ya se evaluó
												$d3 = mysqli_fetch_array($consulta3);
												if ($d3['status']==1)
												{
													$class = 'success';
												}
												else
												{
													$class = 'danger';
												}
												$fecha_evaluacion = Fecha($d3['fecha']);
											}
											
											if ($_SESSION['nivel']==1 || $_SESSION['nivel'] == 4)
											{
												if ($class != 'success')
												{
													continue;
												}
											}
											
											$mes_actual = substr($hoy,5,2);
											$mes_anterior = $mes_actual == 1?1:$mes_actual-1;
											
											echo '
											<tr class="'.$class.'">
												<td>'.$d1['usuario'].'</td>
												<td>'.$d['nombre'].'</td>
												<td>'.$d2['nombre'].'</td>
												<td>'.$meses[$d['mes']].'</td>
												<td>'.$d['anio'].'</td>
												<td>'.($d['status']==1?'Generada':'Implementada').'</td>';
											if ($_SESSION['nivel'] == 1 )
											{
												echo '
												<td>'.$fecha_evaluacion.'</td>
												<td>
													<form action="evaluacion.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-info btn-block"><i class="fa fa-search"></i> Ver</button>
													</form>
												</td>
												<td>
													<form action="ranking.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-warning btn-block"><i class="fa fa-star"></i> Ranking '.$ranking.'</button>
													</form>
												</td>
												<td>
													<form action="ideas_abc.php" method="post">
														<input type="hidden" name="opcion" value="2">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i> Editar</button>
													</form>
												</td>
												<td> 
													<form action="ideas_abc.php" method="post">
														<input type="hidden" name="opcion" value="3">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar</button>
													</form>
												</td>';
											}
											else if ($_SESSION['nivel']==2)
											{
												echo '<td>
													<form action="evaluacion.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-info btn-block"><i class="fa fa-check"></i> Evaluar</button>
													</form>
												</td>';
												echo '<td>
														<input type="checkbox" value=""  onchange="handleChange(this);"> Validar participación
												</td>';
											}
											else if ($_SESSION['nivel']==3)
											{
												$concursa = $d3['status'] == '1' ? 'SI' : 'NO';
												echo '<td>'.$concursa.'</td>';
												if ($d['mes']>=$mes_anterior && $d['mes']<= $mes_actual)
												{
													echo '
													<td>
														<button type="button" class="btn btn-md btn-info btn-block" onClick="Modal('.$d['id'].')"><i class="fa fa-check-circle"></i> Retro</button>
													</td>
													<td>
														<form action="ideas_abc.php" method="post">
															<input type="hidden" name="opcion" value="2">
															<input type="hidden" name="id" value="'.$d['id'].'">
															<button type="submit" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i> Editar</button>
														</form>
													</td>
													<td> 
														<form action="ideas_abc.php" method="post">
															<input type="hidden" name="opcion" value="3">
															<input type="hidden" name="id" value="'.$d['id'].'">
															<button type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar</button>
														</form>
													</td>';
												}
												else if ($mes_actual==1 && $d['mes']==12 && $d['anio'] == ($anio-1))
												{
													echo '
													<td>
														<button type="button" class="btn btn-md btn-info btn-block" onClick="Modal('.$d['id'].')"><i class="fa fa-check-circle"></i> Retro</button>
													</td>
													<td>
														<form action="ideas_abc.php" method="post">
															<input type="hidden" name="opcion" value="2">
															<input type="hidden" name="id" value="'.$d['id'].'">
															<button type="submit" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i> Editar</button>
														</form>
													</td>
													<td> 
														<form action="ideas_abc.php" method="post">
															<input type="hidden" name="opcion" value="3">
															<input type="hidden" name="id" value="'.$d['id'].'">
															<button type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar</button>
														</form>
													</td>';
												}
												else
												{
													echo '<td>
														<button type="button" class="btn btn-md btn-info btn-block" onClick="Modal('.$d['id'].')"><i class="fa fa-check-circle"></i> Retro</button>
													</td>
													<td></td><td></td>';
												}
											}else if ($_SESSION['nivel'] == 4 )
											{
												echo '
												<td>'.$fecha_evaluacion.'</td>
												<td>
													<form action="evaluacion.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-info btn-block"><i class="fa fa-search"></i> Ver</button>
													</form>
												</td>
												<td>
													<form action="ranking.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-warning btn-block" disabled><i class="fa fa-star"></i> Ranking '.$ranking.'</button>
													</form>
												</td>
												<td>
													<form action="ideas_abc.php" method="post">
														<input type="hidden" name="opcion" value="2">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-success btn-block" disabled><i class="fa fa-pencil"></i> Editar</button>
													</form>
												</td>
												<td> 
													<form action="ideas_abc.php" method="post">
														<input type="hidden" name="opcion" value="3">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-danger btn-block" disabled><i class="fa fa-trash"></i> Eliminar</button>
													</form>
												</td>';
											}else if ($_SESSION['nivel'] == 5 )
											{
												echo '
												<td>'.$fecha_evaluacion.'</td>
												<td>
													<form action="evaluacion.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-info btn-block"><i class="fa fa-search"></i> Ver</button>
													</form>
												</td>
												<td>
													<form action="ranking.php" method="post">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-warning btn-block" disabled><i class="fa fa-star"></i> Ranking '.$ranking.'</button>
													</form>
												</td>
												<td>
													<form action="ideas_abc.php" method="post">
														<input type="hidden" name="opcion" value="2">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-success btn-block" disabled><i class="fa fa-pencil"></i> Editar</button>
													</form>
												</td>
												<td> 
													<form action="ideas_abc.php" method="post">
														<input type="hidden" name="opcion" value="3">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-danger btn-block" disabled><i class="fa fa-trash"></i> Eliminar</button>
													</form>
												</td>';
											}
											echo '</tr>';
										}
										?>
                                    </tbody>
                                </table>
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
	
	<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_title">Retroalimentación</h4>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body" id="modal_content">

				</div>
			</div>
		</div>
	</div>
	
	
    <div class="scripts">
        <!-- Addons -->
        <script src="addons/jquery/jquery.min.js"></script>
        <script src="addons/jquery-ui/jquery-ui.min.js"></script>
        <script src="addons/bootstrap/js/bootstrap.min.js"></script>
		<script src="addons/fullcalendar/lib/moment.min.js"></script>
        <script src="addons/pacejs/pace.min.js"></script>
		<!-- DataTables -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
		<!-- Funciones -->
		<script src="js/generales.js"></script>
		<script src="js/loads.js"></script>
		<script src="js/funciones.js"></script>
        <!-- scripts -->
        <script src="addons/scripts.js"></script>
		
		 <!-- Current page scripts -->
        <div class="current-scripts">
			<script>
				$(document).ready(function(){	
					$('#tabla').DataTable( {
					   "language": { url:"//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"},
						"ordering": true,
						"paging": true,
						"searching": true,
						"info": true,
						"fixedHeader": true,
						"autoFill": false,
						"colReorder": false,
						"fixedColumns": false,
						"responsive": true,
					} );
				});	
				
				function Modal(id){
					console.log('Clic');
					$.ajax( {
						type: "POST",
						url: "ajax/get_modal.php",
						dataType: "json",
						data: {
							id: id,
						},
						success: function ( data ) {
							console.log( data.html );
							$('#modal_title').html('Idea: '+data.idea);
							$('#modal_content').html(data.html);
							$('#Modal').modal('toggle');
						}
					} )	
				}

				function handleChange(checkbox) {
					if(checkbox.checked == true){
						console.log("Se da check");
					}else{
						console.log("Se quita el check");
					}
				}
			</script>            
        </div>

    </div>

</body>

</html>