<?php
	session_start();
// Validate the orders
	if (empty($orders)) { ?>
		<div align="center">
			<h3>
				<span class="label label-default">
					* Sin resultados *
				</span>
			</h3>
			<button 
				onclick="local.list_orders({
					client_id: <?php echo $_SESSION['user']['id'] ?>,
					div: 'contenedor'
				})"
				class="btn btn-info">
				Regresar
			</button>
		</div><?php

		return;
	}
?>
<div class="row"><?php  
	foreach ($orders as $key => $value) {
		switch ($value['status_renew']) {
			case 1:
				$class = 'bg-success text-white'; 
				$hide = 'display: none';
				break;
			case 2:
				$class = 'bg-warning text-white'; 
				$hide = '';
				break;
			
			default:
				$class = ''; 
				$hide = '';
				break;
		} ?>
		
		<div class="col-sm-12 col-md-4">
			<div class="card text-center <?php echo $class ?>" style="margin-bottom: 15px;">
				<div class="card-header">
					Folio: <?php echo $value['id'] ?>
				</div>
				<div class="card-body <?php echo $class ?>" style="height: 190px; overflow-y: auto">
					$<?php echo $value['cost'] ?><br />
					<?php echo $value['creation_date'] ?><br />
					<?php echo $value['end_date'] ?><br />
					<?php echo $value['description'] ?><br />
				</div>
				<div class="card-footer text-muted" style="<?php echo $hide ?>">
					<button
						data-toggle="modal"
						data-target="#modal_pay"
						class="btn btn-success btn-block"
						id="btn_pay_<?php echo $value['id'] ?>"
						data-loading-text="Cargando..."
						onclick="
							$('#btn_pay_store').attr('order_id', <?php echo $value['id'] ?>);
							$('#btn_pay_store').attr('end_date', '<?php echo $value['end_date'] ?>');
							$('#btn_pay_store').attr('client_id', <?php echo $value['client_id'] ?>);
							$('#btn_pay_store').attr('tianguis_id', <?php echo $value['tianguis_id'] ?>);
						">
						Renovar
					</button>
					<button 
						onclick="markets.modify_order({
							tianguis_id: <?php echo $value['tianguis_id'] ?>,
							end_date: '<?php echo $value['end_date'] ?>',
							order_id: <?php echo $value['id'] ?>,
							cat: <?php echo $value['cat_id'] ?>,
							div: 'contenedor'
						})"
						class="btn btn-primary btn-block">
						Modificar
					</button>
				</div>
			</div>
		</div><?php
	} ?>
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
						<button 
							order_id=""
							end_date=""
							client_id=""
							tianguis_id=""
							id="btn_pay_store" 
							onclick="local.renew_store({
								order_id: $(this).attr('order_id'),
								end_date: $(this).attr('end_date'),
								client_id: $(this).attr('client_id'),
								tianguis_id: $(this).attr('tianguis_id')
							})" 
							class="btn btn-info" 
							style="font-size: 40px">
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
		data.order_id = $("#btn_pay_store").attr('order_id');
		data.end_date = $("#btn_pay_store").attr('end_date');
		data.client_id = $("#btn_pay_store").attr('client_id');
		data.tianguis_id = $("#btn_pay_store").attr('tianguis_id');
		
		local.renew_card(data);
	};

	var error_callbak = function(response) {
		var desc = response.data.description != undefined ? response.data.description : response.message;
		alert("Datos no validos");
		$("#pay-button").prop("disabled", false);
		$("#pay-button").html("Pagar");
	};
</script>