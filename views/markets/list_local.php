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
?>
<style>
	.available:hover {
	    background-color: #58BC80;
	}
</style>
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
						$disabled = ' disabled';
						$class = 'secondary';
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
						$value['cost'] = $objet['cost'];
						$value['des_cat'] = $objet['des_cat'];
						$value['date'] = $objet['date'].'-01';
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
			} ?>
			</tr>
		</table>	
	</div>
</div>
<div class="row" style="padding-top: 20px">
	<div class="col-sm-12 col-md-2"><?php
		if (empty($_SESSION['user'])) { ?>
			<button
				onclick="window.location.replace('cliente/login/')"
			 	class="btn btn-info btn-block">
				Iniciar sesión
			</button><?php
		}else{ ?>
			<button
				onclick="local.rent_local()"
				id="btn_pay"
				data-loading-text="Cargando..."
				class="btn btn-primary btn-block">
				Finalizar
			</button><?php
		} ?>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_pay">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Pagar</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" id="div_resumen" align="center"> </div>
				</div>
				<div class="row" id="div_pays_methods">
					<div class="col-sm-12 col-md-6" align="center" id="div_card">
						<button 
							class="btn btn-primary" 
							style="font-size: 40px" 
							onclick="$('#div_card_pay').show()">
							<i class="fa fa-credit-card"></i> Tarjeta
						</button>
					</div>
					<div class="col-sm-12 col-md-6" align="center">
						<button id="btn_pay_store" onclick="local.pay_store()" class="btn btn-info" style="font-size: 40px">
							<i class="fa fa-barcode"></i> Tienda
						</button>
					</div>
				</div>
				<div class="row" style="padding-top: 20px; display: none" id="div_card_pay">
					<div class="col-sm-12">
						<div class="bkng-tb-cntnt">
							<div class="pymnts">
								<form action="#" method="POST" id="payment-form">
									<input type="hidden" name="token_id" id="token_id">
									<div class="pymnt-itm card active">
										<div class="pymnt-cntnt">
											<div class="sctn-row">
												<div class="sctn-col l">
													<label>Nombre del titular</label><br />
													<input type="text" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name" class="form-control">
												</div>
												<div class="sctn-col">
													<label>Número de tarjeta</label><br />
													<input type="text" autocomplete="off" data-openpay-card="card_number" class="form-control">
												</div>
											</div>
											<div class="sctn-row">
												<div class="sctn-col l">
													<label>Fecha de expiración</label><br />
													<div class="sctn-col half l">
														<input type="text" placeholder="Mes" data-openpay-card="expiration_month" class="form-control">
													</div>
													<div class="sctn-col half l">
														<input type="text" placeholder="Año" data-openpay-card="expiration_year" class="form-control">
													</div>
												</div>
												<div class="sctn-col cvv">
													<label>Código de seguridad</label><br />
													<div class="sctn-col half l">
														<input type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2" class="form-control">
													</div>
												</div>
											</div><br /><br />
											<div class="sctn-row">
												<button class="btn btn-primary btn-block" id="pay-button">Pagar</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
</script>