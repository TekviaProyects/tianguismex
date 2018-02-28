<?php 
	session_start();
	$url = 'users_files/'.$_SESSION['user']['id'].'/perfil.png';
	$url = (file_exists($url)) ? $url : 'users_files/'.$_SESSION['user']['id'].'/perfil.jpeg';
	$url = (file_exists($url)) ? $url : 'users_files/'.$_SESSION['user']['id'].'/perfil.jpg';
	$url = (file_exists($url)) ? $url : 'images/photos/loggeduser.png';
?>
<link rel="stylesheet" href="plugins/cropper-master/dist/cropper.min.css">
<link rel="stylesheet" href="plugins/cropper-master/examples/crop-avatar/css/main.css">
<div class="row">
	<div class="col-sm-12">
<!-- =====================________________				crop-logo					________________===================== -->

		<div id="crop-perfil" align="center">
			<!-- Current avatar -->
			<div class="avatar-view" title="Cambiar imagen">
				<img 
					onerror="this.src='images/photos/loggeduser.png';"
					src="<?php echo $url.'?lastmod='.date('YmdHis') ?>" 
					alt="images/uploadfile.png">
			</div>
			<!-- Cropping modal -->
			<div 
				class="modal fade" 
				id="avatar-modal" 
				aria-hidden="true" 
				aria-labelledby="avatar-modal-label" 
				role="dialog" 
				tabindex="-1">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form class="avatar-form" action="crop_user.php" enctype="multipart/form-data" method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									&times;
								</button>
								<h4 class="modal-title" id="avatar-modal-label">Recortar imagen</h4>
							</div>
							<div class="modal-body">
								<div class="avatar-body">
	
									<!-- Upload image and data -->
									<div class="avatar-upload">
										<input type="hidden" class="avatar-src" name="avatar_src">
										<input type="hidden" class="avatar-data" name="avatar_data">
										<label for="avatarInput">Imagen</label>
										<input
										accept="image/*"
										capture="camera"
										type="file"
										class="avatar-input"
										id="avatarInput"
										name="avatar_file">
									</div>
	
									<!-- Crop and preview -->
									<div class="row">
										<div class="col-md-9">
											<div class="avatar-wrapper"></div>
										</div>
									</div>
	
									<div class="row avatar-btns">
										<div class="col-md-3">
											<button type="submit" class="btn btn-primary btn-block avatar-save">
												Guardar
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.modal -->
			<!-- Loading state -->
			<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
		</div>
	
<!-- =====================________________				END crop-logo 				________________===================== -->
		
		<form 
			method="post" 
			id="formulario" 
			onsubmit="event.preventDefault();  validate()"
			enctype="multipart/form-data" >
			<h3 class="nomargin">Datos de usuario</h3>
			<div class="mb10">
				<label class="control-label">Nombre</label>
				<input 
					value="<?php echo $user['nombre_cliente'] ?>" 
					required="1" 
					type="text" 
					class="form-control" 
					name="Nombre" 
					id="nombre_cliente"/>
				<label class="control-label">Telefono</label>
				<input 
					value="<?php echo $user['celular_cliente'] ?>" 
					required="1" 
					type="text" 
					class="form-control" 
					name="Telefono" 
					id="celular_cliente"/>
				<label class="control-label">Correo</label>
				<input 
					value="<?php echo $user['correo_cliente'] ?>" 
					required="1" 
					type="email" 
					class="form-control" 
					name="Correo" 
					id="correo_cliente"/>
				<label class="control-label">Domicilio</label>
				<input 
					value="<?php echo $user['domicilio_cliente'] ?>" 
					required="1" 
					type="text" 
					class="form-control" 
					name="Domicilio" 
					id="domicilio_cliente"/>
			</div><br /><br />
			<button class="btn btn-success" type="submit" id="btnSubir">
				Guardar
			</button>
		</form>
	</div>
</div>
<script src="plugins/cropper-master/examples/crop-avatar/js/main2.js"></script>
<script>
	function validate () {
		var data = {},
			$required = [],
			message = 'Debes llenar los siguientes campos: \n',
			error = 0, 
			count = 0,
			$function  =  'edit';
		
		$("#formulario").find(':input').each(function(key, value){
			var required = $(this).attr('required'),
				valor = $(this).val(),
				id = this.id;
			
		// Validate that the required input not are empty
			if (required === '1' && valor.length <= 0) {
				error = 1;

				$required.push(id);
			}
			
			if(id){
				data[id] = $(this).val();
			}
		});
		
	// Build the error message
		if ($required.length > 0) {
			$.each($required, function(index, value) {
				message += '-->' + this + ' \n';
			});
		}
		
	// Error
		if (error === 1) {
			swal({
				title : 'Campos no validos',
				text : message,
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});
			
			return;
		}
		
		data.id = <?php echo $user['id_cliente'] ?>
		
		console.log('==========> done DATA', data);
		
		$("#btnEdit").prop('disabled', true);
		
		
		$.ajax({
			data : data,
			url : 'ajax.php?c=users&f='+$function,
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done editar', resp);
			
			swal({
				title : 'Datos guardados',
				text : 'Los datos se han guardado con exito',
				timer : 5000,
				showConfirmButton : true,
				type : 'success'
			});
			
			location.reload()
		}).fail(function(resp) {
			console.log('==========> fail !!! editar', resp);
			
			$("#btnEdit").prop('disabled', false);
			swal({
				title : 'Error',
				text : 'A ocurrido un problema al guardar los datos',
				timer : 5000,
				showConfirmButton : true,
				type : 'error'
			});
		});
	}
</script>