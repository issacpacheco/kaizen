<!DOCTYPE html>
<html>
<head>
	<title>Panel de administración</title>

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
	<link rel="stylesheet" href="styles/theme-dark.css" class="theme"/>
	<!-- End of Styling -->

	<!--Swwetalert-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.min.css">
</head>

<body>
	<!-- Main content-->
	<div class="content" id="login-page">
		<div class="container-fluid">
			<div class="panel" id="login-panel">
				<div class="panel-heading">
					<i class="fa fa-unlock-alt vcentered"></i>
					<div class="vcentered">
						<h3> Bienvenido </h3>
						<h5> Por favor, identifícate:</h5>
					</div>
				</div>
				<div class="panel-body">
					<form class="row" method="post" action="login" id="LoginForm">
						<div class="form-wrapper col-sm-6">
							<label for="Login">Usuario</label>
							<div class="form-group">
								<input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario">
							</div>
						</div>

						<div class="form-wrapper col-sm-6">
							<label for="Password">Contraseña</label>
							<div class="form-group">
								<input type="password" class="form-control" name="pass" placeholder="Contraseña">
							</div>
						</div>

						<button type="button" class="btn btn-lg btn-info btn-block" style="margin-top: 30px" id="boton_enviar_login" onClick="Login()"><i class="fa fa-sign-in"></i> Entrar</button>
					</form>
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
		<script>
			//login
			function Login() {
				$( '#boton_enviar_login' ).empty();
				$( '#boton_enviar_login' ).append( '<i class="fa fa-spinner fa-spin"></i> Enviando...' );
				// Enviamos el formulario usando AJAX
				$.ajax( {
					type: 'POST',
					url: "ajax/login.php",
					data: $( '#LoginForm' ).serialize(),
					// Mostramos un mensaje con la respuesta de PHP
					success: function ( data ) {
						$( '#mensaje_login' ).empty();
						console.log( data );
						switch ( data ) {
							case "-1":
								{
									//Error
									Swal.fire( {
										icon: 'error',
										title: 'Oops...',
										text: 'Correo o contraseña incorrecta.',
										showConfirmButton: true,
									} );
									break;
								}
							case "1":
								{
									window.location.href = "./";
									break;
								}
						}
						$( '#boton_enviar_login' ).empty();
						$( '#boton_enviar_login' ).append( '<i class="fa fa-sign-in"></i> Entrar' );
					}
				} )
				return false;
			}
		</script>
	</div>

</body>

</html>