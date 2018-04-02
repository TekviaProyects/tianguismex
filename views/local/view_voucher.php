<?php
	date_default_timezone_set('America/Mexico_City');
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
	
	$creation_date = $dias[date('w',strtotime($data['creation_date']))]." ".
					date('d', strtotime($data['creation_date']))." de ".
					$meses[date('n', strtotime($data['creation_date']))-1]. " del ".
					date('Y',strtotime($data['creation_date']));
	$end_date = $dias[date('w',strtotime($data['end_date']))]." ".
					date('d', strtotime($data['end_date']))." de ".
					$meses[date('n', strtotime($data['end_date']))-1]. " del ".
					date('Y',strtotime($data['end_date']));
?>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<div id="div_print">
	<h2 class="text-success">Comprobante de pago</h2>
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<label><b>ID</b>: <?php echo $data['openpay_id'] ?></label>
		</div>
		<div class="col-sm-12 col-md-6">
			<label><b>Monto</b>: $<?php echo $data['cost'] ?></label>
		</div>
		<div class="col-sm-12 col-md-6">
			<label><b>Folio</b>: <?php echo $data['id'] ?></label>
		</div>
		<div class="col-sm-12 col-md-6">
			<label><b>Nombre</b>: <?php echo $data['client_name'] ?></label>
		</div>
		<div class="col-sm-12 col-md-6">
			<label><b>Correo</b>: <?php echo $data['client_mail'] ?></label>
		</div>
		<div class="col-sm-12 col-md-6">
			<label>
				<b>Fecha de creacion</b>: <?php 
				echo utf8_encode(ucfirst($creation_date).', '.
				date('H:i:s', strtotime($data['creation_date']))) ?>
			</label>
		</div>
		<div class="col-sm-12 col-md-6">
			<label>
				<b>Fecha final</b>: <?php 
				echo utf8_encode(ucfirst($end_date).', '.
				date('H:i:s', strtotime($data['end_date']))) ?>
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<label><b>Descripción</b>: <?php echo $data['description'] ?></label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<label><b>Autorización / Referencia</b>: <?php echo $data['reference'] ?></label>
		</div>
	</div>
</div>
<script>
	function printDiv(id) {
		var divToPrint = document.getElementById(id),
			newWin = window.open('', 'Print-Window');
		
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
		newWin.document.close();
		
		setTimeout(function() {
			newWin.close();
		}, 10);
	}
</script>