<?php
	setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
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
			echo strftime("%A, %B %d %Y",strtotime($data['creation_date'])).','.
			date('H:i:s', strtotime($data['creation_date'])) ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de inicio</b>: <?php 
			echo strftime("%A, %B %d %Y",strtotime($data['select_date'])).','.
			date('H:i:s', strtotime($data['select_date']))?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Fecha final</b>: <?php echo strftime("%A, %B %d %Y",strtotime($data['end_date'])).', 23:59:59' ?></label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label><b>Fecha de caducidad</b>: <?php echo $data['due_date'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Descripción</b>: <?php echo $data['description'] ?></label>
	</div>
</div>