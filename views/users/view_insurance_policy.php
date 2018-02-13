<?php 
	session_start();
	$url = 'users_files/'.$_SESSION['user']['id'].'/poliza.pdf' 
?>

<div class="row">
	<div class="col-sm-12 col-md-3" align="center">
		<form 
			method="post" 
			onsubmit="event.preventDefault();  validate()" 
			enctype="multipart/form-data" 
			id="up_form">
			<input name="poliza" id="poliza" class="form-control" type="file" required="1" accept="application/pdf"/><br />
			<button id="btnSubir" class="btn btn-success btn-block">Subir</button>
		</form>
	</div>
	<div class="col-sm-12 col-md-9" align="center" id="div_pdf" style="overflow: auto; max-height: 80vh;">
		En esta sección deberás subir tu Póliza de seguro vigente, oprime el botón de examinar y ubica el archivo PDF
		que la contiene, a continuación presiona subir.
	</div>
</div>
<script>
	$.ajax({
		data : {url: '<?php echo $url ?>'},
		url : 'pdfjs.php?url=<?php echo $url ?>',
		type : 'post',
		dataType : 'html'
	}).done(function(resp_html) {
		console.log('==========> done pdfjs', resp_html);
		
		$("#div_pdf").html(resp_html);
	}).fail(function(resp) {
		console.log('==========> fail !!! pdfjs', resp);
		
		swal({
			title : 'Error',
			text : 'No se puede cargar el formato',
			timer : 5000,
			showConfirmButton : true,
			type : 'error'
		});
	});
	
	function validate () {
		var form = $('#up_form')[0];
		var data = new FormData(form);
		$("#btnSubir").prop('disabled', true);
		
		console.log('==========> data', data);
		
		$.ajax({
			type : "POST",
			enctype : 'multipart/form-data',
			url : "up_files.php",
			data : data,
			processData : false,
			contentType : false,
			cache : false,
			timeout : 600000,
			dataType : 'json'
		}).done(function(resp) {
			console.log('==========> done save_user', resp);
			
			$("#btnSubir").prop('disabled', false);
			
			if(resp.status === 2){
				swal({
					title : 'Usuario existente',
					text : 'Este correo ya esta registrado, intenta iniciar sesion',
					timer : 7000,
					showConfirmButton : true,
					type : 'warning'
				});
				
				return;
			}
			
			swal({
				title : 'Datos guardados',
				text : 'Los datos se han guardado con exito',
				timer : 5000,
				showConfirmButton : true,
				type : 'success'
			});
			
			users.view_insurance_policy({
				div: 'contenedor',
				mail: '<?php echo $_SESSION['user']['mail'] ?>',
				from_user: 1
			})
		}).fail(function(resp) {
			console.log('==========> fail !!! save', resp);
			
			$("#btnSubir").prop('disabled', false);
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