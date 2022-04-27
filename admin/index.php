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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
    <link rel="stylesheet" href="addons/ionicons/css/ionicons.css"/>
    <link rel="stylesheet" href="addons/noUiSlider/nouislider.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>

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
            <div class="row">
				<div class="col-sm-12">
					<div class="panel">
                        <div class="panel-heading">
							<h2 class="text-center">Panel de Administración - <?php echo $title;?></h2>
                        </div>
						<div class="panel-body">
							<p class="text-center">BIENVENIDO AL SISTEMA KAIZEN</p>
						</div>
					</div>
				</div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-body btn-success text-white">
                            <div class="media no-margin">
                                <div class="media-body">
                                    <h3 class="no-margin">Puntos: 00000</h3>
                                    <span class="text-uppercase text-size-mini">Equipo: XXX </span>
                                </div>

                                <div class="media-right h1">
                                    <i class="fas fa-wreath"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-body btn-info text-white">
                            <div class="media no-margin">
                                <div class="media-body">
                                    <h3 class="no-margin">Puntos: 00000</h3>
                                    <span class="text-uppercase text-size-mini">Equipo perteneciente: XXX</span>
                                </div>

                                <div class="media-right h1">
                                    <i class="fas fa-users-class"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-body btn-warning text-white">
                            <div class="media no-margin">
                                <div class="media-body">
                                    <h3 class="no-margin">Puntos: 00000</h3>
                                    <span class="text-uppercase text-size-mini">Generador con mayor puntaje: XXX </span>
                                </div>

                                <div class="media-right h1">
                                    <i class="fas fa-stars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-body btn-danger text-white">
                            <div class="media no-margin">
                                <div class="media-body">
                                    <h3 class="no-margin">Puntos: 00000</h3>
                                    <span class="text-uppercase text-size-mini">Generador de la plataforma: XXX</span>
                                </div>

                                <div class="media-right h1">
                                    <i class="fas fa-child"></i>
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
		<!-- Current page scripts -->
        <div class="current-scripts">

           
            
        </div>

    </div>

</body>

</html>