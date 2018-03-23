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
	
	$date = substr($objet['end_date'], 0, 8).'01';
	
	// echo "<pre>", print_r($local_selected), "</pre>";
?>
<style>
	.available:hover {
	    background-color: #58BC80;
	}
</style>
<h1 id="">hoalasdlja k ase</h1>
<div class="row">
	<div class="col-sm-12 col-md-4">
		<button class="btn btn-info">Disponible</button>
		<button class="btn btn-secondary" disabled="disabled">Ocupado</button>
	</div>
</div>
<div class="row">
	<div class="col-sm-12" style="overflow-x: scroll; width: 100%; padding: 15px;">
		<table><?php
			$row = 0;
			$init = 1;
			
			foreach ($local as $key => $value) {
				$disabled = '';
				$class = '';
				
				if ($value['cat_id'] != $objet['cat']) {
					$disabled = ' disabled';
					$class = 'default';
				} else {
					if($value['status'] == 2){
						$unblock = 0;
						foreach ($local_selected as $k => $v) {
							if ($v['id'] == $value['id']) {
								$unblock = 1;
							}
						}
						
						if ($unblock == 1) {
							$disabled = '';
							$class = 'info available';
						} else {
							$disabled = ' disabled';
							$class = 'secondary';
						}
					}else{
						$disabled = '';
						$class = 'info available';
					}
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
						$value['date'] = $date;
						$local = json_encode($value);
						$local = str_replace('"', "'", $local); ?>
						
						<td 
							id="tr_<?php echo $value['id'] ?>"
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
					} else { ?>
						<td 
							style="min-width: 20px" 
							colspan="<?php echo $value['col'] ?>"
							x="<?php echo $value['x'] ?>"
							y="<?php echo $value['y'] ?>"></td><?php
					}
				}
				
				foreach ($local_selected as $k => $v) {
					if ($v['id'] == $value['id']) {
						$value['date'] = $date;
						$local = json_encode($value);
						$local = str_replace('"', "'", $local); ?>
						
						<script>
							setTimeout(function(){
								local.select_local(<?php echo $local ?>);
							}, 500)
						</script><?php
					}
				}
			} ?>
			</tr>
		</table>	
	</div>
</div>
<div class="row" style="padding-top: 20px">
	<div class="col-sm-12 col-md-2">
		<button
			onclick="local.change({
				order_id: <?php echo $_REQUEST['order_id'] ?>
			})"
			id="btn_pay"
			data-loading-text="Cargando..."
			class="btn btn-primary btn-block">
			Finalizar
		</button>
	</div>
</div>
<script>
	OpenPay.setId('mngsvcdrvfxhfkedj98m');
	OpenPay.setApiKey('pk_778e93fd95eb4206a7db26db9389efbc');
	OpenPay.setSandboxMode(true);
//Se genera el id de dispositivo
	var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

	$('#pay-button').on('click', function(event) {
		event.preventDefault();
		$("#pay-button").prop("disabled", true);
		$("#pay-button").html("Cargando...");
		OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
	});
	
	var sucess_callbak = function(response) {
		console.log("================> sucess_callbak", response);
		
		var token_id = response.data.id,
			data = {};
		
		$("#payment-form").find(':input').each(function(key, value){
			var id = this.id;
			
			if(id){
				data[id] = $(this).val();
			}
		});
		
		data.token_id = token_id;
		
		local.new_card_pay(data);
	};

	var error_callbak = function(response) {
		var desc = response.data.description != undefined ? response.data.description : response.message;
		alert("Datos no validos");
		$("#pay-button").prop("disabled", false);
		$("#pay-button").html("Pagar");
	};
	
	local.total = parseInt(<?php echo $total_selected ?>, 10);
</script>