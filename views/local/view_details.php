<?php
	date_default_timezone_set('America/Mexico_City');
	// setlocale(LC_ALL, "es_MX.UTF-8", "Spanish");
	
	$date = date('Y-m-d H:i:s');
	
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
	
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
	$creation_date = $dias[date('w',strtotime($data['creation_date']))]." ".
					date('d', strtotime($data['creation_date']))." de ".
					$meses[date('n', strtotime($data['creation_date']))-1]. " del ".
					date('Y',strtotime($data['creation_date']));
	$end_date = $dias[date('w',strtotime($data['end_date']))]." ".
					date('d', strtotime($data['end_date']))." de ".
					$meses[date('n', strtotime($data['end_date']))-1]. " del ".
					date('Y',strtotime($data['end_date']));
	$select_date = $dias[date('w',strtotime($data['select_date']))]." ".
					date('d', strtotime($data['select_date']))." de ".
					$meses[date('n', strtotime($data['select_date']))-1]. " del ".
					date('Y',strtotime($data['select_date']));
	$due_date = $dias[date('w',strtotime($data['due_date']))]." ".
					date('d', strtotime($data['due_date']))." de ".
					$meses[date('n', strtotime($data['due_date']))-1]. " del ".
					date('Y',strtotime($data['due_date']));
?>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
<h2>Detalles</h2>
<div class="row">
	<div class="col-sm-12 col-md-6">
		<label><b>Folio</b>: <?php echo $data['id'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Nombre</b>: <?php echo $data['client_name'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Correo</b>: <?php echo $data['client_mail'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Costo</b>: $<?php echo $data['cost'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de creacion</b>: <?php 
			echo utf8_encode(ucfirst($creation_date).','.
			date('H:i:s', strtotime($data['creation_date']))) ?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de inicio</b>: <?php 
			echo utf8_encode(ucfirst($select_date).', '.
			date('H:i:s', strtotime($data['select_date']))) ?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha final</b>: <?php 
			echo utf8_encode(ucfirst($end_date).', '.
			date('H:i:s', strtotime($data['end_date']))) ?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label>
			<b>Fecha de caducidad</b>:  <?php 
			echo utf8_encode(ucfirst($due_date).', '.
			date('H:i:s', strtotime($data['due_date']))) ?>
		</label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Descripción</b>: <?php echo $data['description'] ?></label>
	</div>
	<div class="col-sm-12 col-md-6">
		<label><b>Estado</b>: <?php echo $status ?></label>
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
				
				if (($data['end_date'] >= $date) && (empty($data['status_renew']))) { ?>
					<button
						data-toggle="modal"
						data-target="#modal_pay"
						class="btn btn-success btn-block"
						id="btn_pay_<?php echo $data['id'] ?>"
						data-loading-text="Cargando..."
						onclick="
							$('#btn_pay_store').attr('order_id', <?php echo $data['id'] ?>);
							$('#btn_pay_store').attr('end_date', '<?php echo $data['end_date'] ?>');
							$('#btn_pay_store').attr('client_id', <?php echo $data['client_id'] ?>);
							$('#btn_pay_store').attr('client_o_id', '<?php echo $data['client_o_id'] ?>');
							$('#btn_pay_store').attr('client_mail', '<?php echo $data['client_mail'] ?>');
							$('#btn_pay_store').attr('tianguis_id', <?php echo $data['tianguis_id'] ?>);
						">
						Renovar
					</button><?php
				}
				
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
			} 
			
			if (($data['end_date'] >= $date) && $data['status'] == 1) { ?>
				<button
					class="btn btn-primary btn-block"
					data-dismiss="modal"
					onclick="setTimeout(function(){
						markets.modify_order({
							tianguis_id: <?php echo $data['tianguis_id'] ?>,
							end_date: '<?php echo $data['end_date'] ?>',
							order_id: <?php echo $data['id'] ?>,
							cat: <?php echo $data['cat_id'] ?>,
							view: 'change_locals',
							div: 'contenedor'
						})
					}, 500)">
					Cambio
				</button><?php
			} ?> 
		</div>
		<div class="col-sm-12 col-md-6">
			<button
				data-toggle="modal"
				data-target="#modal_free"
				class="btn btn-danger btn-block"
				onclick="$('#btn_free').attr('order_id', <?php echo $data['id'] ?>)">
				Liberar
			</button>
			<button 
				data-dismiss="modal"
				onclick="
					setTimeout(function(){
						markets.modify_order({
							tianguis_id: <?php echo $data['tianguis_id'] ?>,
							end_date: '<?php echo $data['end_date'] ?>',
							order_id: <?php echo $data['id'] ?>,
							cat: <?php echo $data['cat_id'] ?>,
							div: 'contenedor'
						})
					}, 500)"
				class="btn btn-primary btn-block">
				Modificar
			</button><?php
		} ?>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_pay" data-backdrop="static">
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
				<div class="col-sm-12">
					Esta a punto de renovar su local, en caso de que la ficha no sea pagada a tiempo se liberara 
					este local para alguien más.
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
							client_o_id=""
							client_mail=""
							id="btn_pay_store" 
							onclick="local.renew_store({
								order_id: $(this).attr('order_id'),
								end_date: $(this).attr('end_date'),
								client_id: $(this).attr('client_id'),
								tianguis_id: $(this).attr('tianguis_id'),
								client_o_id: $(this).attr('client_o_id'),
								client_mail: $(this).attr('client_mail')
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
													<input 
														type="text" 
														placeholder="Como aparece en la tarjeta" 
														autocomplete="off" 
														data-openpay-card="holder_name" 
														class="form-control">
												</div>
												<div class="sctn-col">
													<label>Número de tarjeta</label><br />
													<input 
														type="text" 
														autocomplete="off" 
														data-openpay-card="card_number" 
														class="form-control">
												</div>
											</div>
											<div class="sctn-row">
												<div class="sctn-col l">
													<label>Fecha de expiración</label><br />
													<div class="sctn-col half l">
														<input 
															type="text" 
															placeholder="Mes" 
															data-openpay-card="expiration_month" 
															class="form-control">
													</div>
													<div class="sctn-col half l">
														<input 
															type="text" 
															placeholder="Año" 
															data-openpay-card="expiration_year" 
															class="form-control">
													</div>
												</div>
												<div class="sctn-col cvv">
													<label>Código de seguridad</label><br />
													<div class="sctn-col half l">
														<input 
															type="text" 
															placeholder="3 dígitos" 
															autocomplete="off" 
															data-openpay-card="cvv2" 
															class="form-control">
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal_free" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Liberar</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" align="center">
						Está seguro de liberar estos locales, el cambio es irreversible y no hay devoluciones de renta
					</div>
				</div><br />
				<div class="row" id="div_pays_methods">
					<div class="col-sm-12" align="center">
						<button 
							id="btn_free"
							order_id=""
							class="btn btn-danger btn-block" 
							onclick="local.free({
								order_id: $(this).attr('order_id'),
								creation_date: '<?php echo $data['creation_date']  ?>'
							})">
							Liberar
						</button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
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
		data.client_o_id = $("#btn_pay_store").attr('client_o_id');
		data.tianguis_id = $("#btn_pay_store").attr('tianguis_id');
		data.client_mail = $("#btn_pay_store").attr('client_mail');
		
		local.renew_card(data);
	};
	
	var error_callbak = function(response) {
		var desc = response.data.description != undefined ? response.data.description : response.message;
		alert("Datos no validos");
		$("#pay-button").prop("disabled", false);
		$("#pay-button").html("Pagar");
	};
</script>