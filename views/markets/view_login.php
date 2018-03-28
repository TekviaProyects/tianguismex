<div class="row justify-content-md-center">
	<div class="col-xs-12 col-md-4">
		<div class="card bg-light">
			<div class="card-header text-center">
				<span style="font-size: 20px">Iniciar sesión</span>
			</div>
			<form  method="post" accept-charset="utf-8" id="form_login" onsubmit="event.preventDefault(); login()">
				<div class="card-body">
					<div class="form-group">
						<label for="mail">Correo</label>
						<input class="form-control" type="email" id="mail" required="required"/>
					</div>
					<div class="form-group">
						<label for="mail">Pass</label>
						<input class="form-control" type="password" id="pass" required="required"/>
					</div>
				</div>
				<div class="card-footer">
					<button id="btn_login" type="submit" class="btn btn-success btn-block" data-loading-text="Cargando...">
						Entrar
					</button>
				</div>
			</form>
			<div class="col-sm-12" align="center">
				<a href="#div_recovery" aling="center" data-toggle="collapse" data-target="#div_recovery">
					Olvide mi contraseña
				</a>
			</div>
			<div class="col-sm-12 collapse" id="div_recovery">
				<form id="form_recovery" onsubmit="event.preventDefault();  recovery()">
					<h4>Recuperar contraseña</h4>
					<div class="form-group">
						<label for="mail">Correo</label>
						<input class="form-control" id="mail_recovery" type="email" required="1" />
					</div>
					<div class="form-group">
						<label for="mail">Nueva contraseña</label>
						<input class="form-control" id="pass_recovery" type="password" required="1" />
					</div>
					<div class="form-group">
						<label for="mail">Repetir contraseña</label>
						<input class="form-control" id="pass_recovery2" type="password" required="1" />
					</div>
					<button id="btn_send_recovery" class="btn btn-primary btn-block" data-loading-text="Cargando...">
						Recuperar
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function login(){
		var data = {},
			$required = [],
			message = 'Debes llenar los siguientes campos:',
			error = 0,
			count = 0;
		
		$("#form_login").find(':input').each(function(key, value){
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
		console.log('==========> done DATA', data);

		$("#btn_send_recovery").button('loading');

		$.ajax({
			data : data,
			url : 'ajax.php?c=markets&f=login',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done recovery', resp);

			$("#btn_login").button('reset');

			if(resp.status === 1){
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
	
	function recovery () {
		var data = {},
			$required = [],
			message = 'Debes llenar los siguientes campos:',
			error = 0,
			count = 0;

		$("#form_recovery").find(':input').each(function(key, value){
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
		if(data.pass !== data.pass2){
			swal({
				title : 'Contraseña no valida',
				text : 'Las contraseñas no son iguales',
				timer : 5000,
				showConfirmButton : true,
				type : 'warning'
			});

			return;
		}
		
		data.mail = data.mail_recovery;
		
		console.log('==========> done DATA', data);

		$("#btn_send_recovery").button('loading');

		$.ajax({
			data : data,
			url : 'ajax.php?c=markets&f=send_recovery',
			type : 'post',
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done recovery', resp);

			$("#btn_send_recovery").button('reset');

			if(resp.status === 1){
				swal({
					title : 'Revisa tu correo',
					text : 'Te hemos enviado un correo con los pasos para recuperar tu cuenta',
					timer : 5000,
					showConfirmButton : true,
					type : 'success'
				});
			}else{
				swal({
					title : 'Datos no validos',
					text : 'Revisa que el correo sea correcto',
					timer : 5000,
					showConfirmButton : true,
					type : 'warning'
				});
			}
		}).fail(function(resp) {
			console.log('==========> fail !!! save', resp);

			$("#btn_send_recovery").button('reset');

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