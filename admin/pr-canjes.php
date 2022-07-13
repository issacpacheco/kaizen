<?php 
include("includes/config.php");
include("class/allClass.php");

use nsproductos\productos;
use nsfunciones\funciones;
$info = new productos();
$fn = new funciones();

$canjes = $info->obtener_canjes();
$ccanjes = $fn->cuentarray($canjes);
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
		 <div class="container-fluid" id="contenedor">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <?php echo "Centro de canjes";?>
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
								</div>
							</div>
							<br>
                            <div>
                                <table class="table table-striped table-bordered table-hover" id="tabla">
                                    <thead>
                                        <tr>
											<th> Equipo </th>
											<th> Fecha solicitud </th>
											<th> Folio de canje </th>
											<th> <i class="fa fa-pencil"></i> </th>
											<th> <i class="fa fa-trash"></i> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php for($i = 0; $i < $ccanjes; $i++){ ?>
                                            <tr>
                                                <td><?php echo $canjes['equipo'][$i]; ?></td>
                                                <td><?php echo $canjes['fecha'][$i]; ?></td>
                                                <td><?php echo $canjes['folio'][$i]; ?></td>
                                                <td><button onclick="universalLoad(this)" data-postload="0" data-returnpage="pr-canjes" data-form="" data-page="productos-canjes-edit" data-carpeta="ajax-edit" data-load="contenedor" data-valores="" data-id="<?php echo $canjes["id"][$i]; ?>" type="submit" class="btn btn-md btn-success btn-block"><i class="fa fa-pencil"></i></button></td>
                                                <td><button onclick="cancelarCanje(<?php echo $canjes['id'][$i]; ?>);" type="submit" class="btn btn-md btn-danger btn-block"><i class="fa fa-trash"></i> Cancelar</button></td>
                                            </tr>
                                        <?php } ?>
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
		<!-- Funciones -->
		<script src="js/generales.js"></script>
		<script src="js/loads.js"></script>
		<script src="js/funciones.js"></script>
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
                
                function cancelarCanje(id){
                    var postpagina = "pr-canjes"
                    $.ajax({
                        type: "post",
                        url: "ajax-delete/cancelar-canjes.php",
                        data: {id: id},
                        success: function(response){
                            window.location.href = "pr-canjes.php";
                        }
                    })
                }
			</script>            
        </div>

    </div>

</body>

</html>