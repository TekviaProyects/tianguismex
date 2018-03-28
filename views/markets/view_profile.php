<?php session_start(); ?>
<label style="font-weight: bold">Completa todas las pestañas antes de guardar</label><br />
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos fiscales</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bancos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Logo</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="t4" data-toggle="tab" href="#tab4" role="tab" aria-controls="contact" aria-selected="false">Preferencias</a>
	</li>
</ul>
<form 
	id="form_info" 
	onsubmit="event.preventDefault(); update_info()" 
	method="post" 
	enctype="multipart/form-data">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br />
			<label style="font-weight: bold">Empresa:</label><br />
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="name">* Nombre o razon social</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['nombre'] ?>"  
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
							value="<?php echo $_SESSION['tianguis']['rfc'] ?>"  
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
							value="<?php echo $_SESSION['tianguis']['comercial_name'] ?>"  
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
							value="<?php echo $_SESSION['tianguis']['curp'] ?>"  
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
							value="<?php echo $_SESSION['tianguis']['street'] ?>"  
							class="form-control" 
							type="text" 
							id="street"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="num_int">Num. Int.</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['num_int'] ?>"  
							class="form-control" 
							type="number" 
							id="num_int"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="num_ext">Num. Ext.</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['num_ext'] ?>"  
							class="form-control" 
							type="number" 
							id="num_ext"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="colony">Colonia</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['colony'] ?>"  
							class="form-control" 
							type="text" 
							id="colony"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="municipality">Municipio</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['municipality'] ?>"  
							class="form-control" 
							type="text" 
							id="municipality"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="city">Ciudad</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['city'] ?>"  
							class="form-control" 
							type="text" 
							id="city"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="country">Pais</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['country'] ?>"  
							class="form-control" 
							type="text" 
							id="country"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="state">Estado</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['state'] ?>"  
							class="form-control" 
							type="text" 
							id="state"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="mail">* CP</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['cp'] ?>"  
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
							value="<?php echo $_SESSION['tianguis']['reference'] ?>"  
							class="form-control" 
							type="text" 
							id="reference" 
							required="required"/>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<label style="font-weight: bold">Cuentas bancarias registradas para deposito:</label><br />
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="bank">* Banco</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['bank'] ?>"  
							class="form-control" 
							type="text" 
							id="bank" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="bank_name">* Nombre del banco</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['bank_name'] ?>"  
							class="form-control" 
							type="text" 
							id="bank_name" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="key">* Clave interbancaria</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['key'] ?>"  
							class="form-control" 
							type="number" 
							id="key" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="alias">* Alias</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['alias'] ?>"  
							class="form-control" 
							type="text" 
							id="alias" 
							required="required"/>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
			<label style="font-weight: bold">Logotipo:</label><br />
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="bank">Formatos recomendados: JPG, JPEG, GIF, PNG, BMP</label>
						<input 
							class="form-control" 
							type="file" 
							name="logo" 
							id="logo"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<img 
						class="img-thumbnail" 
						src="<?php echo $_SESSION['tianguis']['logo'] ?>" 
						onError="this.onerror=null;this.src='images/logo.png';" />
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="tab4" role="t4" aria-labelledby="contact-tab">
			<label style="font-weight: bold">Preferencias de la cuenta:</label><br />
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="mail_notifications">* Correo de notificaciones</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['mail_notification'] ?>"  
							class="form-control" 
							type="email" 
							id="mail_notification" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="person_type">* Tipo de persona</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['person_type'] ?>"  
							class="form-control" 
							type="text" 
							id="person_type" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="support_mail">* Correo de soporte</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['support_mail'] ?>"  
							class="form-control" 
							type="email" 
							id="support_mail" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="contact_tel">* Telefono de contacto</label>
						<input 
							value="<?php echo $_SESSION['tianguis']['contact_tel'] ?>"  
							class="form-control" 
							type="tel" 
							id="contact_tel" 
							required="required"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="reset_pass">Cambiar contraseña</label>
						<input class="form-control" type="password" id="reset_pass"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label for="reset_pass2">Confirmar contraseña</label>
						<input class="form-control" type="password" id="reset_pass2"/>
					</div>
				</div>
			</div>
		</div>
	</div><br />
	<button class="btn btn-success" type="submit">Guardar</button>
</form>
<script>
	function update_info(){
		var data = {},
			$required = [],
			message = 'Debes llenar los siguientes campos:',
			error = 0,
			count = 0,
			form = $('#form_info')[0];
		var formData = new FormData(form);
		
		$("#form_info").find(':input').each(function(key, value){
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
				message += '-->' + this + ' -- ';
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
		
		if(data.reset_pass != "" || data.reset_pass2 != ""){
			if(data.reset_pass != data.reset_pass2){
				swal({
					title : 'Contraseña no valida',
					text : 'Las contraseñas deben de ser iguales',
					timer : 5000,
					showConfirmButton : true,
					type : 'warning'
				});
	
				return;
			}
			
			data.pass = data.reset_pass;
			formData.append("pass", data.reset_pass);
		}
		
		console.log('==========> done DATA', data);

		$("#btn_login").button('loading');
		
		$.ajax({
			type : "POST",
			enctype : 'multipart/form-data',
			url : 'ajax.php?c=markets&f=update',
			data : formData,
			processData : false,
			contentType : false,
			cache : false,
			timeout : 600000,
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done recovery', resp);

			$("#btn_login").button('reset');

			if(resp.status === 1){
				swal({
					title : 'Datos Actualizados',
					text : 'Tus datos han sido actualizados con exito',
					timer : 5000,
					showConfirmButton : true,
					type : 'success'
				});
				
				location.reload();
			}else{
				swal({
					title : 'Datos no validos',
					text : 'Revisa que los datos sean correctos',
					timer : 5000,
					showConfirmButton : true,
					type : 'warning'
				});
			}
		}).fail(function(resp) {
			console.log('==========> fail !!! save', resp);

			$("#btn_login").button('reset');

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