<?php 
include("includes/config.php");
$tabla = 'criterios';
$modulo = 'Criterios de evaluación';
if (isset($_POST['alta']))
{
	mysqli_query($conexion,"ALTER TABLE $tabla AUTO_INCREMENT = 0");
	mysqli_query($conexion,"INSERT INTO $tabla VALUES (
	'0', 
	'" . $_POST[ 'nombre' ] . "',
	'" . $_POST[ 'descripcion' ] . "',
	'" . $_POST[ 'tipo_respuesta' ] . "'
	)" );
}
if (isset($_POST['editar']))
{
	mysqli_query($conexion,"UPDATE $tabla SET 
		nombre = '" . $_POST[ 'nombre' ] . "',
		descripcion = '" . $_POST[ 'descripcion' ] . "',
		tipo_respuesta = '" . $_POST[ 'tipo_respuesta' ] . "'
		WHERE id = '".$_POST['editar']."' LIMIT 1");
}
if (isset($_POST['eliminar']))
{
	mysqli_query($conexion,"DELETE FROM $tabla WHERE id = '".$_POST['eliminar']."' LIMIT 1");
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
		 <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <?php echo $modulo;?>
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo $tabla;?>_abc.php" method="post">
										<button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i> Nuevo </button>
									</form>
								</div>
							</div>
							<br>


                            <div>
                                <table class="table table-striped table-bordered table-hover" id="tabla">
                                    <thead>
                                        <tr>
											<th> Nombre </th>
											<th> Descripción </th>
											<th> Tipo de respuesta </th>
											<th> <i class="fa fa-pencil"></i> </th>
											<th> <i class="fa fa-trash"></i> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$consulta = mysqli_query($conexion,"SELECT * FROM $tabla");
										while ($d = mysqli_fetch_array($consulta))
										{
											$tipo = $d['tipo_respuesta']==1?'Libre':'Sí/No';
											echo '
											<tr class="odd">
												<td>'.$d['nombre'].'</td>
												<td>'.$d['descripcion'].'</td>
												<td>'.$tipo.'</td>
												<td>
													<form action="'.$tabla.'_abc.php" method="post">
														<input type="hidden" name="editar" value="1">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i></button>
													</form>
												</td>
												<td> 
													<form action="'.$tabla.'_abc.php" method="post">
														<input type="hidden" name="eliminar" value="1">
														<input type="hidden" name="id" value="'.$d['id'].'">
														<button type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i></button>
													</form>
												</td>
											</tr>';
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
			</script>            
        </div>

    </div>

</body>

</html>