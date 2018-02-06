<?php
	session_start();
	
	if (empty($_SESSION['user'])) {
		// echo "<script>location.href='index.php'</script>";
	}

?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
	<!-- fullcalendar -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

	<!-- font-awesome -->
		<link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
	<!-- dataTables  -->
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/datatables.min.css"/>
	<!-- Animate -->
		<link href="plugins/animate.css" rel="stylesheet" />
	<!-- bootstrap-datetimepicker -->
		<link rel="stylesheet" href="plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
	<!-- sweetalert -->
		<link rel="stylesheet" href="plugins/sweetalert-master/dist/sweetalert.css" />
	<!-- Loader -->
		<link rel="stylesheet" href="plugins/css3-preloader-transition-start/css/normalize.css">
		<link rel="stylesheet" href="plugins/css3-preloader-transition-start/css/main.css">

		<style>
			.vuela{
				position: sticky;
			    right: 0px;
			    top: 0px;
			    z-index: 6;
			    width: 100%;
			}
			#wrapper {
				padding-left: 0;
				-webkit-transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				transition: all 0.5s ease;
			}
			#wrapper.toggled {
				padding-left: 250px;
			}
			#sidebar-wrapper {
				z-index: 1000;
				position: fixed;
				left: 250px;
				width: 0;
				height: 100%;
				margin-left: -250px;
				/*overflow-y: scroll;*/
				overflow-x: hidden;
				background: #000;
				-webkit-transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				transition: all 0.5s ease;
			}
			#wrapper.toggled #sidebar-wrapper {
				width: 250px;
			}
			#contenedor {
				width: 100%;
				position: absolute;
				padding: 15px;
			}
			#wrapper.toggled #contenedor {
				position: absolute;
				margin-right: -250px;
			}
			/* Sidebar Styles */
			.sidebar-nav {
				/*position: absolute;*/
				top: 0;
				width: 250px;
				margin: 0;
				padding: 0;
				list-style: none;
			}
			.sidebar-nav li {
				text-indent: 5px;
				line-height: 40px;
			}
			.sidebar-nav li a {
				line-height: 200%;
				display: block;
				text-decoration: none;
				color: #999999;
			}
			.sidebar-nav li a:hover {
				text-decoration: none;
				color: #fff;
				background: rgba(255, 255, 255, 0.2);
			}
			.sidebar-nav li a:active, .sidebar-nav li a:focus {
				text-decoration: none;
			}
			.sidebar-nav > .sidebar-brand {
				height: 65px;
				font-size: 1px;
				line-height: 60px;
			}
			.sidebar-nav > .sidebar-brand a {
				color: #999999;
			}
			.sidebar-nav > .sidebar-brand a:hover {
				color: #fff;
				background: none;
			}
			@media (min-width: 768px) {
				#wrapper {
					padding-left: 250px;
				}
				#wrapper.toggled {
					padding-left: 0;
				}
				#sidebar-wrapper {
					width: 250px;
				}
				#wrapper.toggled #sidebar-wrapper {
					width: 0;
				}
				#contenedor {
					padding: 20px;
					position: relative;
				}
				#wrapper.toggled #contenedor {
					position: relative;
					margin-right: 0;
				}
			}
			.footer {
				position: relative;
				right: 0;
				bottom: 0;
				text-align: right;
			}
			.notoy{
				display: none !important;
			}
		/*Loader*/
		</style>
	</head>
	<body>
		<div id="wrapper">
			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<div

					onclick="location.reload()"
					align="center"
					style="background-color: #ffbc49; cursor: pointer">
					<img src="images/logo.png" style="max-width: 150px" />
				</div>
				<ul class="sidebar-nav">
					<li>
						<a
							href="#contenedor"
							onclick="requests.new_request({
								div: 'contenedor',
								from_user: 1
							})">
							<i class="fa fa-plus" aria-hidden="true"></i> Nueva solicitud
						</a>
					</li>
					<li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block"
							onclick="requests.list_requests({
								div: 'contenedor',
								view: 'list_user_requests',
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								from_user: 1
							})">
							<i class="fa fa-address-card" aria-hidden="true"></i>
							<span>Estado de solicitudes</span>
						</a>
					</li>
					<li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block"
							onclick="requests.list_requests({
								div: 'contenedor',
								status: 1,
								view: 'list_active_permits',
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								from_user: 1
							})">
							<i class="fa fa-check" aria-hidden="true"></i>
							<span>Permisos activos</span>
						</a>
					</li>
					<li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block"
							onclick="help_desk.view_dating({
								div: 'contenedor',
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								user_id: '<?php echo $_SESSION['user']['id'] ?>',
								from_user: 1
							})">
							<i class="fa fa-calendar-o"></i>
							<span>Citas en dependencia</span>
						</a>
					</li>
					<li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block"
							onclick="help_desk.view_user_main({
								div: 'contenedor',
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								from_user: 1
							})">
							<i class="fa fa-info-circle"></i>
							<span>Atención a quejas</span>
						</a>
					</li>
					<li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block"
							onclick="requests.list_requests({
								div: 'contenedor',
								status: 1,
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								view: 'list_transfer_rights',
								from_user: 1
							})">
							<i class="fa fa-archive" aria-hidden="true"></i> <span>Cesión de derechos</span>
						</a>
					</li>
					<li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block"
							href="#contenedor"
							onclick="users.view_gafette({
								div: 'contenedor',
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								from_user: 1
							})">
							<i class="fa fa-address-card" aria-hidden="true"></i>
							<span>Gafete electronico</span>
						</a>
					</li>
					<li>
						<a 
							onclick="requests.list_requests({
								div: 'contenedor',
								status: 1,
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								view: 'view_permits',
								from_user: 1
							})"
							href="#contenedor"
						 	class="btn-orange btn-block" >
							<i class="fa fa-lock" aria-hidden="true"></i>
							<span>Permiso por ausencia y Suplencias</span>
						</a>
					</li>
					<li>
						<a
							onclick="dependencies.view_documets({
								div: 'contenedor',
								from_user: 1
							})"
							class="btn-orange btn-block"
							href="#contenedor">
							<i class="fa fa-book"></i>
							<span>Manuales</span>
						</a>
					</li>
					<li>
						<a
							onclick="users.view_insurance_policy({
								div: 'contenedor',
								mail: '<?php echo $_SESSION['user']['correo'] ?>',
								from_user: 1
							})"
							href="#contenedor"
						 	class="btn-orange btn-block" >
							<i class="fa fa-shield" aria-hidden="true"></i>
							<span>Póliza de seguro</span>
						</a>
					</li>
					<!-- <li>
						<a
							href="#contenedor"
						 	class="btn-orange btn-block" >
							<i class="fa fa-cutlery" aria-hidden="true"></i>
							<span>Constancia de manejo de alimentos</span>
						</a>
					</li> -->
				</ul>
			</div>
			<!-- /#sidebar-wrapper -->
			<!-- Contenedor -->
			<div>
				<nav class="navbar navbar-expand-lg navbar-light bg-light vuela">
					<button class="btn btn-default" id="menu-toggle" style="margin-right: 10px">
						<i class="fa fa-bars"></i>
					</button>
					<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
						<form class="form-inline my-2 my-lg-0" onsubmit="event.preventDefault()">
							<input
								class="form-control mr-sm-2"
								type="search"
								placeholder="Buscar.."
								onchange="requests.search({
									search: $(this).val(),
									mail: '<?php echo $_SESSION['user']['correo'] ?>'
								})"
								id="search_expedients"
								name="keyword">
							<button
								onclick="requests.search({
									search: $('#search_expedients').val(),
									mail: '<?php echo $_SESSION['user']['correo'] ?>'
								})"
								class="btn btn-outline-success my-2 my-sm-0"
								type="button"
								style="margin-right: 10px">
								Buscar
							</button>
						</form>
						<ul class="navbar-nav mr-auto mt- mt-lg-0">

						</ul>
						<div style="margin-right: 3%;">
							<button 
								class="btn btn-info"
								data-toggle="collapse" 
								href="#div_notifications" 
								role="button" 
								aria-expanded="false" 
								aria-controls="div_notifications"
								onclick="notifications.actualizar({
									user_id: '<?php echo $_SESSION['user']['id'] ?>',
									div: 'num_notifications'
								})">
								<i class="fa fa-bell"></i>
								<span class="badge badge-light" id="num_notifications">
								</span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
						</div>
						<ul class="navbar-nav">
							<li class="nav-item">
								<button
									class="btn btn-default"
									 data-toggle="collapse"
									 href="#collapseExample"
									 role="button"
									 aria-expanded="false"
									 aria-controls="collapseExample">
									 <img
									 	style="max-width: 30px"
									 	src="users_files/<?php echo $_SESSION['user']['id'] ?>/perfil.png"
										onerror="this.src='images/photos/loggeduser.png';"
										class="profile-image img-circle">
									 <?php echo $_SESSION['user']['nombre'] ?></h4>
								</button>
								</a>
								<div class="collapse" id="collapseExample">
									<a
										class="dropdown-item"
										onclick="users.view_profile({
											div: 'contenedor',
											mail: '<?php echo $_SESSION['user']['correo'] ?>',
											from_user: 1
										})"
										href="#contenedor">
										<i class="fa fa-user"></i> Editar Perfil
									</a>
									<a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Configuración</a>
									<a
										class="dropdown-item"
										onclick="help_desk.view_user_main({
											div: 'contenedor',
											mail: '<?php echo $_SESSION['user']['correo'] ?>',
											from_user: 1
										})"
										href="#contenedor">
										<i class="fa fa-info"></i> Ayuda
									</a>
									<a class="dropdown-item" href="index.php"><i class="fa fa-sign-out"></i> Salir</a>
								</div>
							</li>
						</ul>
					</div>
					<button
						class="navbar-toggler"
						type="button"
						data-toggle="collapse"
						data-target="#navbarTogglerDemo01"
						aria-controls="navbarTogglerDemo01"
						aria-expanded="false"
						aria-label="Toggle navigation">
						<i class="fa fa-exchange fa-rotate-90" aria-hidden="true"></i>
					</button>
				</nav>
				<div class="collapse" id="div_notifications" align="right"> </div>
				<div id="div_search_results"></div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12" id="contenedor">
							<div class="row" style="display: none">
								<div class="col-sm-6 col-md-3">
									<div
										class="card text-white bg-success mb-3"
										onclick="requests.list_requests({
											div: 'contenedor',
											status: 1,
											mail: '<?php echo $_SESSION['user']['correo'] ?>',
											view: 'list_user_requests',
											from_user: 1
										})"
										style="cursor: pointer">
										<div class="card-header">
											Solicitudes Aceptadas
										</div>
										<div class="card-body">
											<i class="fa fa-check fa-3x"></i> <h1 id="sum_aceppted">0</h1>
										</div>
									</div>
								</div><!-- col-sm-6 -->
								<div class="col-sm-6 col-md-3">
									<div
										class="card text-white bg-danger mb-3"
										onclick="requests.list_requests({
											div: 'contenedor',
											status: 2,
											mail: '<?php echo $_SESSION['user']['correo'] ?>',
											view: 'list_user_requests',
											from_user: 1
										})"
										style="cursor: pointer">
										<div class="card-header">
											Solicitudes Rechazada
										</div>
										<div class="card-body">
											<i class="fa fa-times fa-3x"></i> <h1 id="sum_aceppted">0</h1>
										</div>
									</div>
								</div><!-- col-sm-6 -->
								<div class="col-sm-6 col-md-3">
									<div
										class="card text-white bg-primary mb-3"
										onclick="requests.list_requests({
											div: 'contenedor',
											mail: '<?php echo $_SESSION['user']['correo'] ?>',
											view: 'list_user_requests',
											from_user: 1
										})"
										style="cursor: pointer">
										<div class="card-header">
											Solicitudes Pendientes
										</div>
										<div class="card-body">
											<i class="fa fa-user fa-3x"></i> <h1 id="sum_aceppted">0</h1>
										</div>
									</div>
								</div><!-- col-sm-6 -->
							</div><!-- row <--></-->
						</div>
					</div>
				</div>
			</div>
			<!-- END Contenedor -->
		</div>
		<div id="loader-wrapper">
			<div id="loader"></div>
		</div>

<!-- /////////////////// ===================				JS						=================== /////////////////// -->

		<script src="plugins/jquery-1.11.2.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<!-- dataTables  -->
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/datatables.min.js"></script>
	<!-- sweetalert -->
		<script type="text/javascript" src="plugins/sweetalert-master/dist/sweetalert.min.js"></script>
	<!-- validate -->
		<script src="plugins/jquery.validate.min.js"></script>
		<script src="plugins/register.js"></script>
	<!-- Date-time Peaker -->
		<script type="text/javascript" src="plugins/moment/moment.js"></script>
		<script type="text/javascript" src="plugins/transition.js"></script>
		<script type="text/javascript" src="plugins/collapse.js"></script>
		<script type="text/javascript" src="plugins/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
	<!-- Include Date Range Picker -->
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	<!-- html2canvas -->
		<script type="text/javascript" src="plugins/html2canvas.min.js"></script>
	<!-- jsPDF -->
		<script type="text/javascript" src="plugins/jsPDF-1.3.2/dist/jspdf.min.js"></script>
	<!-- notify -->
		<script type="text/javascript" src="plugins/notify.js"></script>
	<!-- PDFJs -->
		<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
	<!-- responsivevoice -->
		<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
	<!-- fullcalendar -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
		<script src='plugins/fullCalendarLang.js'></script>
	<!-- Loader -->
		<script src="plugins/css3-preloader-transition-start/js/vendor/modernizr-2.6.2.min.js"></script>
		<script src="plugins/css3-preloader-transition-start/js/main.js"></script>
	<!-- openpay -->
		<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
		<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
	<!-- daterangepicker -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
		
	<!-- System -->
		<script src="js_system/requests.js"></script>
		<script src="js_system/help_desk.js"></script>
		<script src="js_system/users.js"></script>
		<script src="js_system/dependencies.js"></script>
		<script src="js_system/notifications.js"></script>

<!-- /////////////////// ===================			END JS						=================== /////////////////// -->

	</body>
	<div class="footer">
		<a href="terminos.html" style="color: grey !important;">Términos y condiciones</a> /
		<a href="aviso.html" style="color: grey !important;">Aviso de privacidad</a>
	</div>
</html>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	
	$(document).ready(function () {
        $('#loader-wrapper').hide();
    });
    $(document).ajaxStart(function() {
		$('#loader-wrapper').show();
		
		setTimeout(function(){
			$('#loader-wrapper').hide();
		}, 5000);
	});
    $(document).ajaxStop(function() {
		$('#loader-wrapper').hide();
	});
    $(document).ajaxError(function() {
		$('#loader-wrapper').hide();
	});
</script>