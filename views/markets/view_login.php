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

		$("#btn_login").button('loading');

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
</script>