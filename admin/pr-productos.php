<?php 
include("includes/config.php");

include('class/allClass.php'); 

use nsproductos\productos;
use nsfunciones\funciones;

$info        = new productos();
$fn          = new funciones();

$productos    = $info  -> obtener_productos();
$cproductos   = $fn    -> cuentarray($productos);
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
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"/>
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
        <div class="container-fluid" id="contenedor">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="row panel-body">
                        <div class="col-sm-6 h1">
                            Canjeo
                        </div>
                    </div>
                    <div class="row panel-body">
                        <div class="col-sm-12 h3">
                            Los puntos son acumulables en el trimestre y se reinician al finalizar el concurso trimestral (Dejar el espacio para ser editado el texto por el administrador)
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="align-content:center;">
                            <?php for($i = 0; $i < $cproductos; $i++){ ?>
                            
                            <div class="col-sm-3 text-center">
                                <div class="card" style="background-color: #211F20;">
                                    <form action="#" method="POST">
                                        <input type="hidden" name="id_producto" value="<?php echo $productos['id'][$i]; ?>">
                                        <input type="hidden" name="nombre" value="<?php echo $productos['nombre'][$i]; ?>">
                                        <input type="hidden" name="descripcion" value="<?php echo $productos['descripcion'][$i]; ?>">
                                        <input type="hidden" name="costo" value="<?php echo $productos['costo'][$i]; ?>">
                                        <img class="card-img-top" src="images/productos/<?php echo $productos['foto'][$i]; ?>" alt="" style="width:100%;">
                                        <div class="card-body">
                                            <h2 class="card-title text-muted"><?php echo $productos['nombre'][$i]; ?></h2>
                                            <p class="card-text text-muted">Costo: <?php echo $productos['costo'][$i]; ?> Puntos</p>
                                            <input type="number" class="form-control center-block" name="cantidad" id="cantidad" min="0" max="100" style="width: 50%;margin-bottom:2rem">
                                            <button class="btn btn-primary btnservices fw-light white fw-bold" value="Agregar" name="btnAccion" style="margin-bottom: 1rem;">Agregar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
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
	<div class="alertas cajaAlertaRoja">
		<span class="fas fa-exclamation-triangle iconoalertas"></span>
		<p>
			Este es un mensaje de alerta para notificar a los usuarios que necesiten algo.
		</p>
	</div>
	<div class="alertas cajaAlertaVerde">
		<span class="fas fa-exclamation-triangle iconoalertas"></span>
		<p>
			Se ha guardado con exito
		</p>
	</div> 

	<div id="portapopups" class="oscuro oculto">
		<div id="popup" style="z-index:1000;"></div>
	</div>
	
    <div class="scripts">
        <!-- Addons -->
        <script src="addons/jquery/jquery.min.js"></script>
        <script src="addons/jquery-ui/jquery-ui.min.js"></script>
        <script src="addons/bootstrap/js/bootstrap.min.js"></script>
		<script src="addons/fullcalendar/lib/moment.min.js"></script>
		<script src="addons/pacejs/pace.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
        <!-- scripts -->
        <script src="addons/scripts.js"></script>
		<!-- Funciones -->
		<script src="js/generales.js"></script>
		<script src="js/loads.js"></script>
		<script src="js/funciones.js"></script>
        <!-- DataTables -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.js"></script>
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