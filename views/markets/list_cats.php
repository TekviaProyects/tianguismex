<?php
	if (empty($cats)) { ?>
		<div class="row">
			<div class="col-sm-12" align="center">
				<label>* No hay categorias disponibles *</label><br /><br />
				<button 
					onclick="$('#menu_new_rent').click()"
					class="btn btn-info">
					Intentar de nuevo
				</button>
			</div>
		</div><?php
		
		return;
	}
?>

<div class="row" style="padding-bottom: 20px">
	<div class="col-sm-12">
		Selecciona la fecha en la que deseas rentar.
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-3">
		<input class="form-control" id="month" type="text" />
	</div>
</div>
<div class="row" style="padding-top: 20px">
	<div class="col-sm-12">
		Despues selecciona el tipo de local.
	</div>
</div>
<div class="row"><?php
	foreach ($cats as $key => $value) { ?>
		<div class="col-xs-12 col-md-4" style="padding-top: 20px">
			<div 
				onclick="markets.list_local({
					tianguis_id: <?php echo $value['tianguis_id'] ?>,
					cat: <?php echo $value['id'] ?>,
					div: 'contenedor',
					validate_date: 1,
					date: $('#month').val(),
					cost: <?php echo $value['cost'] ?>,
					des_cat: '<?php echo $value['title'].' - '.$value['description'] ?>'
				})"
				class="card text-white text-center bg-secondary">
				<div class="card-header">
					<?php echo $value['title'] ?>
				</div>
				<div class="card-body" style="height: 100px; overflow: hidden">
					<p class="card-text text-white truncate"><?php echo $value['description'] ?></p>
				</div>
				<div class="card-footer">
					<?php echo "$ ".$value['cost'] ?>
				</div>
			</div>
		</div><?php
	} ?>
</div>
<script>
	$("#month").datetimepicker({
		minDate: new Date(),
       	viewMode: "months",
        format: 'YYYY-MM',
        locale: 'es'
    });
    
    $('#month').focus();
</script>