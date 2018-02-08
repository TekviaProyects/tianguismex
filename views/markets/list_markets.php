<?php
	if (empty($markets)) { ?>
		<div class="row">
			<div class="col-sm-12" align="center">
				<label>* No hay tianguis disponibles *</label><br /><br />
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
	foreach ($markets as $key => $value) { ?>
		<div class="col-xs-12 col-md-4" style="padding-top: 20px">
			<div 
				onclick="markets.list_cats({
					tianguis_id: <?php echo $value['id_tianguis'] ?>,
					div: 'contenedor',
					status: 1
				})"
				class="card text-white text-center bg-secondary">
				<div class="card-header">
					<?php echo $value['nombre_tianguis'] ?>
				</div>
				<div class="card-body" style="height: 310px; overflow: hidden">
					<img 
						style="max-height: 100px"
						src="data_tianguis/<?php echo $value['id_tianguis'].'/'.$value['directorio_tianguis'] ?>" />
					<p class="card-text text-white truncate"><?php echo $value['descripcion_tianguis'] ?></p>
				</div>
				<div class="card-footer">
					<?php echo "De ".$value['horario_apertura']." a ".$value['horario_cierre'] ?>
				</div>
			</div>
		</div><?php
	} ?>
</div>