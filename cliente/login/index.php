<?php session_start();
$_SESSION['user'] = '';
if (!empty($_SESSION['ide'])) {
	// header('Location: ../panel');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#CD5F31">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tianguis Mexico</title>
		<script type="text/javascript" src="../assets/anime-master/anime.min.js"></script>
		<script type="text/javascript" src="../assets/js/animacionesEntrada.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
		<link rel="stylesheet" href="../assets/css/menuEstilos.css">
		<link rel="stylesheet" href="../assets/css/login.css">
		<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
		<!-- Loader -->
		<link rel="stylesheet" href="../../plugins/css3-preloader-transition-start/css/main.css">
	</head>
	<body>
		<div class="animacion show" id="animacionA">
			<div id="loader-wrapper">
				<div id="loader"></div>
			</div>
		</div>
		<div class="linea"></div>
		<main>
			<div class="contenedorPrincipal">
				<div
					align="center"
					style="background-color: #ffbc49; cursor: pointer">
					<img src="../../images/logo.png" style="max-width: 280px" />
				</div>
				<div class="inputs">
					<input type="email"git name="" value="" placeholder="Correo" id="correo">
					<input type="password" name="" value="" placeholder="Telefono" id="telefono">
					<button type="button" name="button" id="btnEntrar" disabled="1">
						Entrar
					</button>
					<button type="button" name="button" id="btnVolver">
						Volver a inicio
					</button>
				</div>
				<div style="padding: 10px 35px 10px 35px; font-size: 13px; text-align: center">
					<label>
						<input type="checkbox" id="check_confirm"> He leído y aceptado los términos y 
						condiciones de uso, así como el Aviso de privacidad
					</label>
				</div>
				<div align="center">
					<a href="../../terminos.html" style="font-size: 15px; color: #0288D1;  text-decoration: none">
						Términos y condiciones
					</a><br />
					<a href="../../aviso.html" style="font-size: 15px; color: #0288D1;  text-decoration: none">
						Aviso de privacidad
					</a>
				</div>
				<div class="recuperacion">
					<a href="#" id="recuperar">Olvide mi contraseña</a>
					<a href="../registro">Registrarme</a>
				</div>
			</div>
			<div class="pie">
				<span>Copyright © Tekvia 2018 Todos los Derechos Reservados.
					<br>
					Para obtener más información, consulte nuestras. 
					<a href="../../terminosycondiciones.pdf" target="_blank">
					Condiciones de uso</a> y la <a href="../../avisodeprivacidad.pdf" target="_blank">
						Política de privacidad.
					</a>
				</span>
			</div>
		</main>
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
		
		// Validate check
			enable_cb();
			$("#check_confirm").click(enable_cb);
			function enable_cb() {
				if (this.checked) {
					$("#btnEntrar").removeAttr("disabled");
				} else {
					$("#btnEntrar").attr("disabled", true);
				}
			}
			
			$( document ).ready(function() {
				swal({
				  title: 'Nueva version',
				  text: "Tenemos una nueva version la cual sera implimenta en maximo 2 meses te invitamos a provarla, "+
				  			"el uso de esta version es solamente para que comprendas la funcionalidad de la misma, "+
				  			"asi que ninguna renta tendra un valor verdadero",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Probar nueva version',
				  cancelButtonText: 'Cerrar'
				}).then((result) => {
					
				  	console.log("============> resp", result);
				  	
				  if (result) {
				  	console.log("============> esta baina si entra");
				    location.href = "../../new"
				  }
				})
			});
			location.href = "../../";
		</script>
	</body>
	<script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
	<script src="../assets/semantic/semantic.min.js"></script>
	<script type="text/javascript" src="../assets/js/loginJs.js"></script>
	<script type="text/javascript" src="../assets/anime-master/anime.min.js"></script>
	<script type="text/javascript" src="//mercaditopuertadelsol.com/livechat/php/app.php?widget-init.js"></script>
	<!-- Loader -->
	<script src="../../plugins/css3-preloader-transition-start/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="../../plugins/css3-preloader-transition-start/js/main.js"></script>
</html>