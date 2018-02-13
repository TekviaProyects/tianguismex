<?php session_start();
if (!empty($_SESSION['ide'])) {
	header('Location: ../panel');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#CD5F31">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title></title>
		<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
		<link rel="stylesheet" href="../assets/css/menuEstilos.css">
		<link rel="stylesheet" href="../assets/css/registro.css">
		<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
		<!-- Loader -->
		<link rel="stylesheet" href="../../plugins/css3-preloader-transition-start/css/main.css">
	</head>
	<body>
		<div class="linea"></div>
		<main>
			<div class="contenedorPrincipal">
				<div
					align="center"
					style="background-color: #ffbc49; cursor: pointer">
					<img src="../../images/logo.png" style="max-width: 280px" />
				</div>
				<div class="inputs">
					<form id="formularioRegistro" method="post" enctype="multipart/form-data">
						<input id="inputNombre" type="text" maxlength="30" name="nombre" value="" placeholder="Nombre completo">
						<input id="inputCorreo" type="email" maxlength="50" name="correo" value="" placeholder="Correo" id="correo">
						<input id="inputTelefono" type="tel" maxlength="10" name="telefono" value="" placeholder="Telefono" id="telefono">
						<input id="inputDomicilio" maxlength="500" type="text" name="domicilio" value="" placeholder="Domicilio">
						<label id="labelArchivo" for="archivo" class="btnSubir" >Click para subir tu idenfiticación</label>
						<input id="archivo" type="file" name="archivo" value="" placeholder="Identificacion" accept="image/*">
						<button type="button" name="button" id="btnRegistrar">
							Registrar
						</button>
					</form>
				</div>
				<div class="recuperacion">
					<a href="../login">Ya tengo cuenta</a>
					<a href="#">Ayuda</a>
				</div>
			</div>
			<div class="pie">
				<span>Copyright © Tekvia 2018 Todos los Derechos Reservados.
					<br>
					Para obtener más información, consulte nuestras <a href="../../terminosycondiciones.pdf" target="_blank">Condiciones de uso</a> y la <a href="../../avisodeprivacidad.pdf" target="_blank">Política de privacidad.</a></span>
			</div>
		</main>

		<div id="loader-wrapper">
			<div id="loader"></div>
		</div>
		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-102248014-1', 'auto');
			ga('send', 'pageview');

			$(document).ready(function() {
				$('#loader-wrapper').hide();
			});
		</script>
	</body>

	<script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
	<script src="../assets/semantic/semantic.min.js"></script>
	<script type="text/javascript" src="../assets/anime-master/anime.min.js"></script>
	<script type="text/javascript" src="../assets/js/registroJs.js"></script>
	<script type="text/javascript" src="//mercaditopuertadelsol.com/livechat/php/app.php?widget-init.js"></script>
	<!-- Loader -->
	<script src="../../plugins/css3-preloader-transition-start/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="../../plugins/css3-preloader-transition-start/js/main.js"></script>
</html>