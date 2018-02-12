<?php
	if (empty($local)) { ?>
		<div class="row">
			<div class="col-sm-12" align="center">
				<label>* No hay locales disponibles *</label><br /><br />
				<button 
					onclick="$('#menu_new_rent').click()"
					class="btn btn-info">
					Intentar de nuevo
				</button>
			</div>
		</div><?php
		
		return;
	}
	
	
	echo "<pre>", print_r($local[0]), "</pre>";
?>
<style>
	.available:hover {
	    background-color: #58BC80;
	}
</style>
<div class="row">
	<div class="col-sm-12" style="overflow-x: scroll; width: 100%; padding: 15px;">
		<table><?php
			$row = 0;
			$init = 1;
			
			foreach ($local as $key => $value) {
				if ($value['cat_id'] != $objet['cat']) {
					$disabled = ' disabled';
					$class = 'default';
				} else {
					$disabled = '';
					$class = 'info available';
				}
				
				if ($init == 1) {
					$init = 0; 
					$row = $value['y']; ?>
					
					<tr><?php
				} 
				
				if($row != $value['y']){ 
					$row = $value['y']; ?>
					</tr>
					<tr><?php
				} 
				
				if (!empty($value['col'])) {
					if (!empty($value['show'])) {
						$value['cost'] = $objet['cost']; 
						$local = json_encode($value);
						$local = str_replace('"', "'", $local); ?>
						
						<td 
							class="<?php echo $class ?>"
							style="border: 1px solid; border-color: white" 
							align="center"
							colspan="<?php echo $value['col'] ?>" 
							x="<?php echo $value['x'] ?>"
							y="<?php echo $value['y'] ?>">
							<button 
								id="btn_<?php echo $value['id'] ?>"
								onclick="local.select_local(<?php echo $local ?>)"
								<?php echo $disabled ?> 
								class="btn btn-block btn-<?php echo $class ?> btn-sm">
								<?php echo $value['description'] ?>
							</button>
						</td><?php
					} else {?>
						<td 
							style="min-width: 20px" 
							colspan="<?php echo $value['col'] ?>"
							x="<?php echo $value['x'] ?>"
							y="<?php echo $value['y'] ?>"></td><?php
					}
				}
			} ?>
			</tr>
		</table>	
	</div>
</div>
<div class="row" style="padding-top: 20px">
	<div class="col-sm-12 col-md-2"><?php
		if (empty($_SESSION['user'])) { ?>
			<button
				onclick="$('#btn_iniciar_sesion').click()"
			 	class="btn btn-info btn-block">
				Iniciar sesión
			</button><?php
		}else{ ?>
			<button 
				onclick="local.rent_local()"
				class="btn btn-success btn-block">
				Finalizar
			</button><?php
		} ?>
	</div>
</div>