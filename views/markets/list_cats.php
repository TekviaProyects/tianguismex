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

<div class="row"><?php
	foreach ($cats as $key => $value) { ?>
		<div class="col-xs-12 col-md-4" style="padding-top: 20px">
			<div 
				onclick="markets.list_cats({
					tianguis_id: <?php echo $value['id_tianguis'] ?>,
					div: 'contenedor'
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