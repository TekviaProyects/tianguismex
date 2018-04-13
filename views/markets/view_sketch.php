<div class="col-sm-12">
	<div class="card" style="margin-bottom: 15px;">
		<div class="card-header">
			Croquis
		</div>
		<div class="card-body">
			<ol>
				<li style="padding-bottom: 5px">
					Introduce el numero de filas y columnas de tu tianguis. 
					Da click en <button class="btn btn-primary btn-sm">Nuevo</button>
				</li>
				<li style="padding-bottom: 5px">
					Da click en el nombre del local <button class="btn btn-default btn-sm">1</button> para seleccionarlo.
					<button class="btn btn-info btn-sm">1</button>
				</li>
				<li style="padding-bottom: 5px">
					Selecciona los espacio en blanco de tu tianguis. 
					Da click en <button class="btn btn-outline-secondary btn-sm">Espacio</button>
				</li>
				<li style="padding-bottom: 5px">
					Da click en <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button> para editar el nombre
					del local. (El boton <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button> no aparece
					en el croquis al usuario)
				</li>
				<li style="padding-bottom: 5px">
					Da click en <button class="btn btn-info btn-sm">Unir</button> para unir lo locales seleccionados.
				</li>
				<li>
					Da click en <button class="btn btn-success btn-sm">Guardar</button> para guardar tu croquis.
				</li>
			</ol>
		</div>
	</div>
	<div class="card" style="margin-bottom: 15px;">
		<div class="card-header">
			Dibujar 
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12 col-md-2">
					<div class="form-group">
						<label for="y">Filas</label>
						<input type="number" id="y" class="form-control" min="1"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-2">
					<div class="form-group">
						<label for="x">Columnas</label>
						<input type="number" id="x" class="form-control" min="1"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-2" style="padding-top: 30px">
					<button 
						onclick="markets.draw_sketch({
							cat_id: $('#select_cat_id').val(),
							div: 'div_draw_sketch',
							x: $('#x').val(),
							y: $('#y').val()
						})"
						class="btn btn-primary btn-block">
						Nuevo
					</button>
				</div>
				<div class="col-sm-12 col-md-2" style="padding-top: 30px">
					<button 
						onclick="$('.btn_edit').toggle()"
						id="btn_pre_view"
						class="btn btn-primary btn-block">
						<i class="fa fa-pencil"></i>
					</button>
				</div>
				<div class="col-sm-12 col-md-2" style="padding-top: 30px">
					<button 
						onclick="markets.free_spaces()"
						class="btn btn-outline-secondary btn-block">
						Espacio
					</button>
				</div>
				<div class="col-sm-12 col-md-2" style="padding-top: 30px">
					<button 
						onclick="markets.join_local()"
						class="btn btn-info btn-block">
						Unir
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="input-group">
						<input id="num_rows" class="form-control" placeholder="Numero de filas" type="number">
						<div class="input-group-append">
							<button 
								onclick="markets.add_rows({
									table: 'table_sketch',
									num: $('#num_rows').val()
								})"
								class="btn btn-primary" 
								type="button">
								Agregar filas
							</button>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="input-group">
						<input id="num_columns" class="form-control" placeholder="Columnas" type="number">
						<div class="input-group-append">
							<button 
								onclick="markets.add_columns({
									table: 'table_sketch',
									num: $('#num_columns').val()
								})"
								class="btn btn-primary" 
								type="button">
								Agregar columnas
							</button>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<button 
						data-toggle="modal"
						data-target="#modal_add_cat"
						class="btn btn-primary btn-block">
						Agregar categoria
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-2" style="padding-top: 30px">
					<button 
						id="btn_save_croquis"
						onclick="markets.save_sketch({
							btn: 'btn_save_croquis',
							status: ' 0'
						})"
						class="btn btn-success btn-block">
						Guardar
					</button>
					<button 
						style="display: none"
						id="btn_update_croquis"
						onclick="markets.update_sketch({
							btn: 'btn_update_croquis'
						})"
						class="btn btn-success btn-block">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-12" id="div_draw_sketch" style="min-height:200px; overflow-x: scroll; width: 100%; padding: 15px;">
	<table id="table_sketch">
		<tr><?php
		foreach ($local as $key => $value) {
			$disabled = ($value['disabled'] == 1) ? ' disabled' : '';
			$show = ($value['show'] == 1) ? '' : ' display: none;';
			
			if($column > $x){
				$column = 1; ?>
				</tr>
				<tr id="tr_'<?php echo $value['id'] ?>"><?php
			} ?>
			
			<td 
				colspan="1" 
				style="border: 1px solid; border-color: white; min-width: 25px;" 
				align="center" 
				id="td_<?php echo $value['id'] ?>" 
				local_id="<?php echo $value['id'] ?>" 
				cat_id="<?php echo $value['cat_id'] ?>"  
				x="<?php echo $value['x'] ?>" 
				y="<?php echo $value['y'] ?>">
				<button 
					<?php echo $disabled ?>
					style="<?php echo $show ?>"
					local_id="<?php echo $value['id'] ?>" 
					cat_id="<?php echo $value['cat_id'] ?>" 
					id="btn_<?php echo $value['id'] ?>" 
					x="<?php echo $value['x'] ?>" 
					y="<?php echo $value['y'] ?>"
					show="<?php echo $value['show'] ?>" 
					onclick="markets.select_local({ 
						id: <?php echo $value['id'] ?>, 
						y: <?php echo $value['y'] ?>, 
						x: <?php echo $value['x'] ?>, 
						text: '<?php echo $value['description'] ?>', 
						cat_id: <?php echo $value['cat_id'] ?>
					})" 
					class="btn btn-block btn-default btn-sm local"><?php echo $value['description'] ?></button> 
				<button 
					<?php echo $disabled ?>
					id="btn_edit_<?php echo $value['id'] ?>" 
					data-toggle="modal" 
					data-target="#modal_edit" 
					onclick="
						$('#btn_edit').attr('local_id', <?php echo $value['id'] ?>); 
						$('#select_cat_id').val($('#btn_<?php echo $value['id'] ?>').attr('cat_id')); 
						$('#edit_text').val($('#btn_<?php echo $value['id'] ?>').html()); 
					"
					class="btn btn-block btn-primary btn-sm btn_edit">
					<i class="fa fa-pencil"></i> 
				</button> 
			</td><?php
			
			$column++;
		} ?>
		</tr>
	</table>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Editar</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="edit_text">Nombre</label>
							<input type="text" class="form-control" id="edit_text">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="cat_id">Categoria</label>
							<select class="custom-select" id="select_cat_id"><?php
								foreach ($categories as $key => $value) { ?>
									<option value="<?php echo $value['id'] ?>" <?php echo $select ?>>
										<?php echo $value['title'].' - '.substr($value['description'], 0, 10); ?>
									</option><?php
								} ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button 
					onclick="markets.edit_local({
						id: $(this).attr('local_id'),
						text: $('#edit_text').val(),
						cat_id: $('#select_cat_id').val()
					})"
					class="btn btn-primary" 
					type="button" 
					id="btn_edit" 
					local_id="">
					Editar
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_add_cat">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Agregar categoría</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="cat_name">Nombre</label>
							<input type="text" class="form-control" id="cat_name">
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="cat_cost">Costo</label>
							<input type="number" class="form-control" id="cat_cost">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="cat_des">Descripción</label>
							<textarea class="form-control" id="cat_des"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button 
					onclick="markets.save_category({
						name: $('#cat_name').val(),
						cost: $('#cat_cost').val(),
						description: $('#cat_des').val()
					})"
					class="btn btn-primary" 
					type="button">
					Guardar
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
			</div>
		</div>
	</div>
</div><?php
if (!empty($local)) {
	foreach ($local as $key => $value) {
		if(!empty($value['joins'])){ ?>
			<script>
				var array = {};<?php
				
				foreach ($value['joins'] as $k => $v) { ?>
					var item = {
						id: '',
						old_id: '',
						original_text: ''
					};
					var id = $("[x=<?php echo $v['x'] ?>][y=<?php echo $v['y'] ?>]").attr('local_id');
					var original_text = <?php echo json_encode($v['original_text']) ?>;
					
					item.id = id;
					item.old_id = <?php echo $v['id'] ?>;
					item.x = <?php echo $v['x'] ?>;
					item.y = <?php echo $v['y'] ?>;
					item.original_text = original_text;
					
					array[id] = item;<?php
				} ?>
				
				markets.joins[<?php echo $value['id'] ?>] = array;
			</script><?php
		}
	} ?>
	
	<script>
		$('.btn_edit').hide();
		$("#btn_save_croquis").hide();
		$("#btn_update_croquis").show();
	</script><?php
} ?>

<script>
	$("#select_cat_id").val(<?php echo $categories[0]['id'] ?>);
</script>