<?php
	setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
	
	switch ($data['status']) {
		case 1:
			$status = 'Pagada';
			break;
		case 2:
			$status = 'Cancelada';
			break;
		default:
			$status = 'Pendiente';
			break;
	}
?>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<h2>Detalles</h2>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label><b>Costo</b>: $<?php echo $data['cost'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de creacion</b>: <?php 
			echo ucfirst(strftime("%A, %B %d %Y",strtotime($data['creation_date'])).','.
			date('H:i:s', strtotime($data['creation_date']))) ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de inicio</b>: <?php 
			echo ucfirst(strftime("%A, %B %d %Y",strtotime($data['select_date'])).','.
			date('H:i:s', strtotime($data['select_date']))) ?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha final</b>: <?php echo ucfirst(strftime("%A, %B %d %Y",strtotime($data['end_date'])).', 23:59:59') ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de caducidad</b>: <?php echo ucfirst(strftime("%A, %B %d %Y",strtotime($data['due_date'])).', 23:59:59') ?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Descripción</b>: <?php echo $data['description'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Estado:</b>: <?php echo $status ?></label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6"><?php
		switch ($data['status']) {
			case 1: ?>
				<button
					data-toggle="modal"
					data-target="#modal_authorize"
					class="btn btn-success btn-block"
					onclick="local.view_voucher({
						id: <?php echo $data['id'] ?>,
						div: 'div_modal_authorize'
					})">
					Ver comprobante
				</button><?php
				break;
			case 2: ?>
				<button class="btn btn-danger btn-block" disabled>
					Cancelada
				</button><?php
				break;
			default: ?>
				<button
					id="btn_<?php echo $data['id'] ?>"
					class="btn btn-info btn-block"
					onclick="local.download_pay({
						id: <?php echo $data['id'] ?>,
						json: 1
					})">
					Descargar ficha
				</button><?php
				break;
		} 
		
		if(!empty($_REQUEST['from_tianguis'])){ 
			if (empty($data['status'])) { ?>
				<button
					class="btn btn-success btn-block"
					onclick="local.download_pay({
						id: <?php echo $data['id'] ?>,
						json: 1
					})">
					Pagar
				</button><?php
			} ?> 
			<button
				class="btn btn-primary btn-block"
				onclick="local.download_pay({
					id: <?php echo $data['id'] ?>,
					json: 1
				})">
				Renovar
			</button>
		</div>
		<div class="col-sm-12 col-md-6">
			<button
				class="btn btn-primary btn-block"
				onclick="local.download_pay({
					id: <?php echo $data['id'] ?>,
					json: 1
				})">
				Cambio
			</button>
			<button
				class="btn btn-primary btn-block"
				onclick="local.download_pay({
					id: <?php echo $data['id'] ?>,
					json: 1
				})">
				Liberar
			</button><?php
		}
		
		?>
	</div>
</div>