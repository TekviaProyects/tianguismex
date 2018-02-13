<?php 
	session_start();
	
	$url = 'users_files/'.$user['id'].'/perfil.png';

	switch ($user['state']) {
		case 1: $state = 'Aguascalientes'; break;
		case 2: $state = 'Baja California'; break;
		case 3: $state = 'Baja California Sur'; break;
		case 4: $state = 'Campeche'; break;
		case 5: $state = 'Coahuila de Zaragoza'; break;
		case 6: $state = 'Colima'; break;
		case 7: $state = 'Chiapas'; break;
		case 8: $state = 'Chihuahua'; break;
		case 9: $state = 'Distrito Federal'; break;
		case 10: $state = 'Durango'; break;
		case 11: $state = 'Guanajuato'; break;
		case 12: $state = 'Guerrero'; break;
		case 13: $state = 'Hidalgo'; break;
		case 14: $state = 'Jalisco'; break;
		case 15: $state = 'México'; break;
		case 16: $state = 'Michoacán de Ocampo'; break;
		case 17: $state = 'Morelos'; break;
		case 18: $state = 'Nayarit'; break;
		case 19: $state = 'Nuevo León'; break;
		case 20: $state = 'Oaxaca'; break;
		case 21: $state = 'Puebla'; break;
		case 22: $state = 'Querétaro'; break;
		case 23: $state = 'Quintana Roo'; break;
		case 24: $state = 'San Luis Potosí'; break;
		case 25: $state = 'Sinaloa'; break;
		case 26: $state = 'Sonora'; break;
		case 27: $state = 'Tabasco'; break;
		case 28: $state = 'Tamaulipas'; break;
		case 29: $state = 'Tlaxcala'; break;
		case 30: $state = 'Veracruz de Ignacio de la Llave'; break;
		case 31: $state = 'Yucatán'; break;
		case 32: $state = 'Zacatecas'; break;
		default: $state = ''; break;
	}
?>
<div class="row">
	<div class="col-sm-12">
		<button 
			onclick="users.view_profile({
				div: 'contenedor',
				mail: '<?php echo $_SESSION['user']['correo'] ?>',
				from_user: 1
			})"
			class="btn btn-info">
			Editar perfil
		</button>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<img 
			src="<?php echo $url ?>" 
			alt="images/uploadfile.png" 
			onerror="this.src='images/photos/loggeduser.png';" 
			style="max-height: 260px">
	</div>
	<div class="col-sm-12 col-md-6">
		<div id="qrcode"></div>
	</div>
</div>
<div class="row" style="padding-top: 20px">
	<div class="col-sm-12 col-md-6">
		<label class="control-label">Nombre: <?php echo $user['name'] ?></label><br />
		<label class="control-label">CURP: <?php echo $user['curp'] ?></label><br />
		<label class="control-label">Apellido paterno: <?php echo $user['last_name'] ?></label><br />
		<label class="control-label">Apellido materno: <?php echo $user['last_name2'] ?></label><br />
		<label class="control-label">Correo: <?php echo $user['mail'] ?></label><br />
		<label class="control-label">Codigo postal: <?php echo $user['cp'] ?></label><br />
	</div>
	<div class="col-sm-12 col-md-6">
		<label class="control-label">Estado: <?php echo $state ?></label><br />
		<label class="control-label">Municipio: <?php echo $user['municipality'] ?></label><br />
		<label class="control-label">Colonia: <?php echo $user['colony'] ?></label><br />
		<label class="control-label">Calle: <?php echo $user['addres'] ?></label><br />
		<label class="control-label">Num. Ext.: <?php echo $user['num'] ?></label><br />
		<label class="control-label">Num. Int.: <?php echo $user['num_int'] ?></label><br />
	</div>
</div>
<div id="div_map">
	<div class="row">
		<div class="col-sm-12">
			<div id="google_map" style="width: 100%; height: 60vh"> </div>
		</div>
	</div>
</div>
<script type="text/javascript" src="plugins/jquery-qrcode-master/jquery.qrcode.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsZOvqzL9c7_O7Fj7t3FDt77nejjwbZXw&libraries=places,geometry" async defer></script>
<?php 
// URL
	$host = $_SERVER["HTTP_HOST"];
	$url = $_SERVER["REQUEST_URI"];
	$url = "http://" . $host . $url;
	$url =  str_replace(basename($url), '', $url);
	$url = $url.'info_user.php?mail='.$user['mail'];
	
	$places = json_encode($places);
	$places = str_replace('"', "'", $places)
?>
<script>
	$('#qrcode').qrcode('<?php echo $url ?>');
	
///////////////// ******** -------						init						------ ************ //////////////////
//////// Load a Google map
	// The parameters can receive:
	
	var coordenates = {
		lat : 20.6739383,
		lng : -103.405454
	},
	zoom = 15;
	
	function init() {
		var myLatlng = {
			lat : coordenates.lat,
			lng : coordenates.lng
		};
		
		var map = new google.maps.Map(document.getElementById('google_map'), {
			zoom : zoom,
			center : myLatlng
		});
		
		$.each(<?php echo $places ?>, function(index, value) {
			var coo = {
				lat : parseFloat(value.lat),
				lng : parseFloat(value.lng)
			}
			
			var marker = new google.maps.Marker({
				position : coo,
				map : map
			});
			
			var infowindow = new google.maps.InfoWindow({
				content: value.domicilio
			});

			infowindow.open(map, marker);
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});
			
			map.setCenter(coo);
		});
	}
	
	init();
///////////////// ******** -------					END init						------ ************ //////////////////

</script>