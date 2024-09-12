

<?php
$usuario_logueado = session('login_das_salud');
$usuario_actual = session('usuario_actual');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
	<title>DAS</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="resource-type" content="document" />
	<meta name="Revisit" content="7 days" />
	<meta name="revisit-after" content="7 days" />
	<meta name="rating" content="general" />
	<meta name="expires" http-equiv="expires" content="0" />
	<meta name="pragma" http-equiv="pragma" content="no-cache" />
	<meta name="distribution" http-equiv="distribution" content="Global" />
	<meta name="rating" http-equiv="rating" content="general" />
	<meta name="language" content="Spanish" />
	<meta name="DC.Language" content="ES_ar" scheme="RFC1766" />
	<meta name="description" content="DAS Salud es un nuevo sitio web DAS dedicado exclusivamente a la atenci&oacute;n de sus afiliados. Donde podr&aacute;n solicitar turnos para el Centro M&eacute;dico DAS, buscar prestadores de la cartilla y mucho m&aacute;s.">

		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900&display=swap" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" media="all" href="http://salud.das.gob.ar/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="http://salud.das.gob.ar/css/swiper.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="http://salud.das.gob.ar/css/style.css?1" />
	<link rel="stylesheet" type="text/css" media="all" href="http://salud.das.gob.ar/css/media.css" />
	<link rel="stylesheet" type="text/css" media="all" href="http://salud.das.gob.ar/css/animate.css" />
	<link rel="stylesheet" type="text/css" media="all" href="http://salud.das.gob.ar/css/lightgallery.min.css" />

	<link rel="stylesheet" href="http://salud.das.gob.ar/font-awesome/css/font-awesome.min.css"/>

	<style>
		.psh-none{
			display: none;
		}
	</style>


	<!--[if lt IE 9]>
		<script src="js/html5-3.6-respond-1.1.0.min.js"></script>
	<![endif]-->

	<meta name="theme-color" content="#009290">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<!-- Javascript ================================================== -->
	<script rel="preload" src="https://kit.fontawesome.com/ff1c19d5e6.js" crossorigin="anonymous" ></script>
	<script src="http://salud.das.gob.ar/js/jquery.min.js"></script>
	<script src="http://salud.das.gob.ar/js/modernizr.min.js" type="text/javascript"></script>
	<script src="http://salud.das.gob.ar/js/bootstrap.min.js?3"></script>
	<script src="http://salud.das.gob.ar/js/swiper.min.js"></script>
	<script src="http://salud.das.gob.ar/js/animate-plus.min.js"></script>
	<script src="http://salud.das.gob.ar/js/lightgallery-all.min.js"></script>
	<script src="http://salud.das.gob.ar/js/acciones.js?pp"></script>
</head>
<body>
<header class="align-baseline">
	<nav class="navbar navbar-expand-lg align-items-end navbar-light c-bg-white">
		<div class="container relative align-items-end">
			<a class="navbar-brand" href="{{ route('portal') }}" rel="home">
				<img src="http://salud.das.gob.ar/images/logo.png" class="logo-desktop" alt="" />
			</a>
			<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Menú">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="menuPrincipal">

				<div class="d-block w-100 text-left text-lg-right">
					<div class="topbar text-left text-lg-right" id="box-account">
                        @if($usuario_logueado)
							<a href="javascript:" onclick="ver_cuenta()" alt="Editar Datos de Contacto" title="Editar Datos de Contacto" class="c-dark"><i class="fas fa-user-circle"></i> {{ session('usuario_actual')['nombre'] }}</a> <a href="javascript:" onclick="cerrar_sesion()" class="btn btn-lg btn-secondary c-bg-teal3"><i class="fas fa-sign-out-alt"></i> Salir</a>
						@else
							<a class="btn btn-md btn-info" id="btn-login" onclick="login_open()" data-target="#login">Iniciar Sesión</a>
							<a class="btn btn-md btn-link" id="btn-register" onclick="register_open()" data-target="#registro" style="color:white">Registrate</a>
                        @endif
                    </div>
					<div class="navbar-nav justify-content-end">
						<ul class="list-unstyled navbar-nav bd-navbar-nav flex-row">
							<li class="nav-item"><a href="{{ route('portal.capacitaciones') }}">Capacitaciones</a></li>
							<li class="nav-item"><a href="{{ route('portal.ayuda') }}">Ayuda</a></li>
							<li>
								<!--<form method="post" enctype="multipart/form-data" action="#">
									<div class="input-group margin-bottom-sm">
										<input type="submit" value="Buscar" class="input-group-addon searchform">
										<input class="form-control" type="text" placeholder="Prestador / Farmacia / Etc">
									</div>
								</form>-->
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>

<section class="full-width contacto grid">
	<div class="container">
		<div class="row">
            @yield('contenido')
		</div>
	</div>
</section>
<script>

</script>
<!-- FOOTER -->
<footer class="full-width">
			<div class="container-fluid text-center align-items-start">

			<div class="row justify-content-center align-items-center">
				<div class="col-text-center">
					<p class="foo mb-3 mb-md-0 text-left d-inline-block">Dirección de Ayuda Social para el Personal del ¨Congreso de la Nación.<br />Alsina 1825 - Ciudad Autónoma de Buenos Aries - tel: 0810-222-0317</p>

				</div>
			</div>
		</div>
	</footer>
<a href="javascript:void(0);" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
<div class="modal modal-registro" tabindex="-1" role="dialog" id="registro">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close mr-1 ml-auto" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
    	    </button>
			<form method="post" id="form_registro" onsubmit="return registrar()">
			<input type="hidden" name="tipo" value="registro">
			<input type="hidden" name="action" value="add">
				<div class="modal-body text-left">
					<h1 class="fs32 fw300 c-dark3 text-uppercase">Registrate</h1>
					<h5 class="fs22 fw300 c-dark3" style="color:red" id="register_error"></h5>
					<p class="fs20 fw300 c-dark3 psh-none" id="nombre_data">Hola <b id="nombre"></b></p>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<label class="col-6">Nro Afiliado *</label>
								<input type="text" class="form-control col-4" name="afiliado" id="afiliado" onkeyUp="validar_afiliado()" required autocomplete="off" maxlength="5">
								<input type="text" class="form-control col-2 ml-auto mr-0 special" name="afiliado_barra" id="afiliado_barra" onkeyUp="validar_afiliado()" required autocomplete="off" maxlength="2">
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<label class="col-6 col-md-4">DNI *</label>
								<input type="text" class="form-control col-6 col-md-8" name="dni" id="dni" onkeyUp="validar_afiliado()" required  autocomplete="off" maxlength="11">
							</div>
						</div>

						<div class="col-md-6">
							<div class="row">
								<label class="col-6">Email *</label>
								<input type="email" class="form-control col-6" name="email" required  autocomplete="off" maxlength="45">
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<label class="col-6 col-md-4">Teléfono *</label>
								<input type="tel" class="form-control col-6 col-md-8" name="telefono" required  autocomplete="off" maxlength="19">
							</div>
						</div>


						<div class="col-md-6">
							<div class="row">
								<label class="col-6">Contraseña *</label>
								<input type="password" class="form-control col-6" name="clave" required maxlength="15">
							</div>
						</div>
						<div class="col-md-6">&nbsp;</div>

						<div class="col-md-6">
							<div class="row">
								<label class="col-6">Repite la Contraseña *</label>
								<input type="password" class="form-control col-6" name="reclave" required maxlength="15">
							</div>
						</div>
						<div class="col-md-6">
							<label><span class="fs12">* Datos Obligatorios</span></label>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button type="submit" class="btn btn-secondary text-uppercase c-bg-teal2 mx-auto" id="btn-registro-confirmar">Confirmar</button> <!-- data-dismiss="modal"-->
				</div>
			</form>
		</div>
	</div>
</div><div class="modal modal-login" tabindex="-1" role="dialog" id="login">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close mr-1 ml-auto" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
    	    </button>
			<form method="post" class="" id="form_login" onsubmit="return login()">
				<div class="modal-body text-center psh-none" id="login_center"></div>
				<div class="modal-body text-left" id="form_data">
					<h1 class="fs32 fw300 c-dark3 text-uppercase">Iniciar Sesión</h1>

					<p class="fs20 fw300 c-dark3 psh-none" id="login_error_data" style="color:red"></p>
					<div class="row">
						<label class="col-6">Nro Afiliado *</label>
						<input type="hidden" value="" id="destino">
						<input type="text" class="form-control col-4" id="afi_numero" required autocomplete="off" maxlength="5">
						<input type="text" class="form-control col-2 ml-auto mr-0 special" id="afi_barra" required autocomplete="off" maxlength="2">
					</div>
					<div class="row">
						<label class="col-6">Clave</label>
						<input type="password" class="form-control col-6" id="pass" required maxlength="15">
					</div>
					<p class="fs12">Olvid&oacute; su clave <a href="#" class="c-teal1 fw400" data-toggle="modal" data-target="#forget" data-dismiss="modal">(Haga click aqui)</a></p>
				</div>
				<div class="modal-footer text-center">
					<button type="submit" id="btn-login-confirmar" class="btn btn-secondary text-uppercase c-bg-teal2 mx-auto">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div><div class="modal modal-forget" tabindex="-1" role="dialog" id="forget">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close mr-1 ml-auto" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
    	    </button>
			<form method="post" onsubmit="return recuperar_clave()" id="form-forget">
				<div class="modal-body text-left">
					<h1 class="fs32 fw300 c-dark3 text-uppercase">Recuperar contraseña</h1>
					<div class="row" id="recupero_head" style="color:red;margin:15px;"></div>
					<div class="row" id="recupero_data">
						<label class="col-6">Nro Afiliado *</label>
						<input type="text" class="form-control col-4" id="forget_afiliado" autocomplete="off" maxlength="5">
						<input type="text" class="form-control col-2 ml-auto mr-0 special" id="forget_afiliado_barra" autocomplete="off" maxlength="2">
					</div>
				</div>
				<div class="modal-footer text-center">
					<button type="submit" class="btn btn-secondary text-uppercase c-bg-teal2 mx-auto" id="btn-forget">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div><div class="modal modal-login" tabindex="-1" role="dialog" id="modal" >
	<div class="modal-dialog" role="document" style="max-width:800px;">
		<div class="modal-content" >
			<button type="button" class="close mr-1 ml-auto" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
    	    </button>
			<div class="modal-body text-center">
				<h1 class="fs32 fw300 c-dark3 text-uppercase" id="modal_title">Iniciar Sesión</h1>
				<div id="modal_data"></div>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-login" tabindex="-1" role="dialog" id="reclave">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close mr-1 ml-auto" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
    	    </button>
			<form method="post" class="" id="form_login" onsubmit="return login()">
				<div class="modal-body text-left" id="form_data">
					<h1 class="fs32 fw300 c-dark3 text-uppercase">Generar nueva clave</h1>

					<p class="fs20 fw300 c-dark3 psh-none" id="reclave_error_data" style="color:red"></p>
					<div class="row">
						<label class="col-6">Ingres&aacute; tu nueva clave</label>
						<input type="password" class="form-control col-6" id="nwpass" required maxlength="15">
					</div>
					<div class="row">
						<label class="col-6">Volv&eacute; a ingresar la nueva clave</label>
						<input type="password" class="form-control col-6" id="re-nwpass" required maxlength="15">
					</div>
				</div>
				<div class="modal-footer text-center">
					<button type="submit" id="btn-login-confirmar" class="btn btn-secondary text-uppercase c-bg-teal2 mx-auto">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div><div class="modal modal-login" tabindex="-1" role="dialog" id="turno-cancel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close mr-1 ml-auto" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
    	    </button>
				<div class="modal-body text-center psh-none" id="turno-cancel_center"></div>
				<div class="modal-body text-left" id="turno-cancel_data">
					<h1 class="fs32 fw300 c-dark3 text-uppercase" id="turno-cancel_titulo">Cancelaci&oacute;n de Turno</h1>
					<br />
					<p class="fs20 fw300 c-dark3 psh-none" id="turno-cancel_error_data" style="color:red"></p>
					<div id="turno-cancel_detalle">
						<div class="row">
							<input type="hidden" id="token" />
							<input type="hidden" id="turno_id" />
							<h5>Especialidad: <b id="cancela-especialidad"></b></h5>
						</div>
						<div class="row">
							<h5>Profesional: <b id="cancela-profesional"></b></h5>
						</div>
						<div class="row">
							<h5>Fecha: <b id="cancela-fecha"></b></h5>
						</div>
						<div class="row">
							<h5>Hora: <b id="cancela-hora"></b></h5>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button type="button" onclick="cancelar_turno()" id="btn-turno-cancel-confirmar" class="btn btn-secondary text-uppercase c-bg-teal2 mx-auto">Cancelar Turno</button>
				</div>
		</div>
	</div>
</div>
<script src="js/portal/base.js" ></script>
@yield('scripts')
</body>
</html>
