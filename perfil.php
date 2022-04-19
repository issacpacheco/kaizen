<?php 
include("includes/config.php");
extract($_REQUEST);

//Guardar perfil
if (isset($_POST['editar']))
{
	if ($_POST['editar'] == $_SESSION['id_admin'])
	{
		mysqli_query($conexion,"UPDATE usuarios SET 
		pass = '".$_POST['pass']."'
		WHERE id = '".$_POST['editar']."' LIMIT 1");
		$_POST['id']=$_POST['editar'];
	}
}

$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id = '".$_SESSION['id_admin']."' LIMIT 1");
$d=mysqli_fetch_array($consulta);

$consulta1 = mysqli_query($conexion,"SELECT * FROM equipos WHERE id = '".$d['id_equipo']."'");
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
	
	<!--ihover-->
	<link rel="stylesheet" href="plugins/ihover/ihover.css">
	<!-- Cropper-->
	<link href="plugins/cropper-master/dist/cropper.min.css" rel="stylesheet">
	<link href="css/crop_avatar.css?v=<?php echo rand();?>" rel="stylesheet">

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
                            Perfil
                        </div>
                        <div class="panel-body">
							
                        	<form action="perfil.php" method="post" id="registro-form">
								<div class="row">
									<div class="form-wrapper col-sm-3">
										<label>Nombre de usuario</label>
										<div class="form-group ">
											<input type="text" class="form-control" placeholder="Nombre de usuario" value="<?php echo $d['usuario'];?>" readonly>
										</div>
									</div>
									
									<div class="form-wrapper col-sm-3">
										<label>Tipo de usuario</label>
										<div class="form-group ">
											<input type="text" class="form-control" placeholder="Tipo de usuario" value="<?php echo $_SESSION['nombre'];?>" readonly>
										</div>
									</div>
									
									<div class="form-wrapper col-sm-3">
										<label>Equipo</label>
										<div class="form-group ">
											<input type="text" class="form-control" placeholder="Equipo" value="<?php echo $d1['nombre'];?>" readonly >
										</div>
									</div>
								
									<div class="form-wrapper col-sm-3">
										<label>Contraseña</label>
										<div class="form-group ">
											<input type="text" class="form-control" name="pass" placeholder="Contraseña" value="<?php echo $d['pass'];?>">
										</div>
									</div>
								</div>
								
                              	<div class="col-sm-12">
									<input type="hidden" name="editar" value="<?php echo $_SESSION['id_admin'];?>">
									<button type="submit" class="btn btn-success btn-lg btn-block">Guardar <i class="fa fa-save"></i></button>
                              	</div>
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

           <script>
			$( document ).ready(function() {
				$('#nombre').focus();
			});
		</script>
		
		<!--cropper-->
		<script src="plugins/cropper-master/dist/cropper.min.js"></script>
		<script src="js/crop_avatar.js"></script>
		
		
		<!-- Validate -->
		<script src="addons/jqueryvalidate/jquery.validate.js"></script>
		<script src="addons/jqueryvalidate/localization/messages_es.min.js" type="text/javascript"></script>
		<script>
			
			$( '#registro-form' ).validate( {
				errorElement: 'span', //default input error message container
				errorClass: 'mensaje-error', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				onfocusout: function ( element ) {
					this.element( element );
				}, //Validate on blur
				onkeyup: function ( element ) {
					this.element( element );
				}, //Validate on keyup
				focusCleanup: true, //If enabled, removes the errorClass from the invalid elements and hides all error messages whenever the element is focused
				ignore: "",
				rules: {
					//CAMBIAR POR LAS VARIABLES QUE SEAN OBLIGATORIAS O NECESITEN VALIDACIÓN
					nombre: {
						required: true
					},
					usuario: {
						required: true
					},
					usuario: {
						required: true
					},
					pass: {
						required: true
					},				
				},

				messages: { // custom messages for radio buttons and checkboxes

				},

				invalidHandler: function ( event, validator ) { //display error alert on form submit   

				},

				highlight: function ( element ) { // hightlight error inputs
					$( element ).closest( '.form-group' ).addClass( 'has-error has-feedback' ); // set error class to the control group
				},

				unhighlight: function ( element ) { // hightlight error inputs
					$( element ).closest( '.form-group' ).removeClass( 'has-error has-feedback' ); // set error class to the control group
				},

				success: function ( label ) {
					label.closest( '.form-group' ).removeClass( 'has-error has-feedback' );
					label.remove();
				},

				errorPlacement: function ( error, element ) {
					//Agregar mensajes debajo de los elementos
					if ( element.closest( '.form-group' ).size() === 1 ) {
						error.insertAfter( element.closest( '.form-group' ) );
					} else {
						error.insertAfter( element );
					}
				},

				submitHandler: function ( form ) {
					form.submit();
				}
			} );


		</script>
            
        </div>
		

    </div>

</body>

</html>