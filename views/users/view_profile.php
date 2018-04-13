<?php 
	session_start();
	$url = 'users_files/'.$_SESSION['user']['id'].'/perfil.png';
	$url = (file_exists($url)) ? $url : 'users_files/'.$_SESSION['user']['id'].'/perfil.jpeg';
	$url = (file_exists($url)) ? $url : 'users_files/'.$_SESSION['user']['id'].'/perfil.jpg';
	$url = (file_exists($url)) ? $url : 'images/photos/loggeduser.png';
?>
<label style="font-weight: bold">Completa todas las pestañas antes de guardar</label><br />
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-selected="true">Preferencias</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="profile" aria-selected="false">Documentos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="contact" aria-selected="false">Datos fiscales</a>
	</li>
</ul>
<div class="row">
	<div class="col-sm-12">
		<form 
			method="post" 
			id="formulario" 
			onsubmit="event.preventDefault();  validate()"
			enctype="multipart/form-data" >
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab"><br />
					<div class="row">
						<div class="col-sm-12 col-md-6">
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
						</div>
						<div class="col-sm-12 col-md-6">
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
						</div>
					</div>
				</div>
				<div class="tab-pane fade show" id="tab2" role="tabpanel" aria-labelledby="profile-tab"><br />
					<label style="font-weight: bold">Credencial:</label><br />
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="ine">Formatos recomendados: JPG, JPEG, GIF, PNG, BMP</label>
								<input 
									class="form-control" 
									type="file" 
									name="ine" 
									id="ine"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<img 
								class="img-thumbnail" 
								src="<?php echo $user['ine'] ?>" 
								onError="this.onerror=null;this.src='images/logo.png';" />
						</div>
					</div>
					<label style="font-weight: bold">Licencia:</label><br />
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="licence">Formatos recomendados: JPG, JPEG, GIF, PNG, BMP</label>
								<input 
									class="form-control" 
									type="file" 
									name="licence" 
									id="licence"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<img 
								class="img-thumbnail" 
								src="<?php echo $user['licence'] ?>" 
								onError="this.onerror=null;this.src='images/logo.png';" />
						</div>
					</div>
				</div>
				<div class="tab-pane fade show" id="tab3" role="tabpanel" aria-labelledby="contact-tab"><br />
					<label style="font-weight: bold">Facturación:</label><br />
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="name">* Nombre o razon social</label>
								<input 
									value="<?php echo $user['name'] ?>"  
									class="form-control" 
									type="text" 
									id="name" 
									required="required"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="rfc">* RFC</label>
								<input 
									value="<?php echo $user['rfc'] ?>"  
									class="form-control" 
									type="text" 
									id="rfc" 
									required="required"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="comercial_name">Nombre comercial</label>
								<input 
									value="<?php echo $user['comercial_name'] ?>"  
									class="form-control" 
									type="text" 
									id="comercial_name" 
									required="required"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="curp">CURP</label>
								<input 
									value="<?php echo $user['curp'] ?>"  
									class="form-control" 
									type="text" 
									id="curp" 
									required="required"/>
							</div>
						</div>
					</div><br />
					<label style="font-weight: bold">Domicilio:</label><br />
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="street">Calle</label>
								<input 
									value="<?php echo $user['street'] ?>"  
									class="form-control" 
									type="text" 
									id="street"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="num_int">Num. Int.</label>
								<input 
									value="<?php echo $user['num_int'] ?>"  
									class="form-control" 
									type="number" 
									id="num_int"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="num_ext">Num. Ext.</label>
								<input 
									value="<?php echo $user['num_ext'] ?>"  
									class="form-control" 
									type="number" 
									id="num_ext"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="colony">Colonia</label>
								<input 
									value="<?php echo $user['colony'] ?>"  
									class="form-control" 
									type="text" 
									id="colony"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="municipality">Municipio</label>
								<input 
									value="<?php echo $user['municipality'] ?>"  
									class="form-control" 
									type="text" 
									id="municipality"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="city">Ciudad</label>
								<input 
									value="<?php echo $user['city'] ?>"  
									class="form-control" 
									type="text" 
									id="city"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="country">Pais</label>
								<input 
									value="<?php echo $user['country'] ?>"  
									class="form-control" 
									type="text" 
									id="country"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="state">Estado</label>
								<input 
									value="<?php echo $user['state'] ?>"  
									class="form-control" 
									type="text" 
									id="state"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="mail">* CP</label>
								<input 
									value="<?php echo $user['cp'] ?>"  
									class="form-control" 
									type="number" 
									id="cp" 
									required="required"/>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="reference">Referencia</label>
								<input 
									value="<?php echo $user['reference'] ?>"  
									class="form-control" 
									type="text" 
									id="reference" 
									required="required"/>
							</div>
						</div>
					</div>
				</div>
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
			$function  =  'update';
			form = $('#formulario')[0];
		var formData = new FormData(form);
		
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
				formData.append(id, $(this).val());
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
		
		data.id = <?php echo $user['id_cliente'] ?>;
		formData.append("id", <?php echo $user['id_cliente'] ?>);
		
		console.log('==========> done DATA', data);
		
		$("#btnEdit").prop('disabled', true);
		
		$.ajax({
			type : "POST",
			enctype : 'multipart/form-data',
			url : 'ajax.php?c=users&f='+$function,
			data : formData,
			processData : false,
			contentType : false,
			cache : false,
			timeout : 600000,
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
			
			location.reload();
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