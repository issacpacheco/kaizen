<?php 
include("includes/config.php");

include('class/allClass.php'); 
include('ajax-save/carrito.php');
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

    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/<?php echo $theme;?>" class="theme" />	
    <!-- End of Styling -->
</head>
<body class="hold-transition" onload="nobackbutton();">

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
                            <a href="#">
                                <?php if(!empty($_SESSION['carrito'])){ ?><button class="btn btn-warning white carrito" data-bs-toggle="" data-bs-target="#exampleModal" onclick="showcarrito()">Carrito<span class="fas fa-shopping-cart"></span><span class="NumCar"><?php echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']); ?></span></button><?php }else{ } ?>
                            </a>
                        </div>
                    </div>
                    <div class="row panel-body">
                        <div class="col-sm-12 h3">
                            Los puntos son acumulables en el trimestre y se reinician al finalizar el concurso trimestral (Dejar el espacio para ser editado el texto por el administrador)
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <table class="table table-striped table-bordered table-hover" id="tabla">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Costo</th>
                                        <th>Cantidad a canjear</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i = 0; $i < $cproductos; $i++){ ?>
                                        <input type="hidden" name="id_producto" value="<?php echo $productos['id'][$i]; ?>">
                                        <input type="hidden" name="nombre" value="<?php echo $productos['nombre'][$i]; ?>">
                                        <input type="hidden" name="descripcion" value="<?php echo $productos['descripcion'][$i]; ?>">
                                        <input type="hidden" name="costo" value="<?php echo $productos['costo'][$i]; ?>">
                                    <tr>
                                        <td style="width:30%;"><img src="images/productos/<?php echo $productos['foto'][$i]; ?>" alt="" style="width:25%;"></td>
                                        <td><?php echo $productos['nombre'][$i]; ?></td>
                                        <td><?php echo $productos['descripcion'][$i]; ?></td>
                                        <td><?php echo $productos['costo'][$i]; ?></td>
                                        <td><input type="number" name="cantidad" id="cantidad_canjear" value=""></td>
                                        <td><button class="btn btn-primary btnservices fw-light white fw-bold" value="Agregar" name="btnAccion">Agregar</button></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
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