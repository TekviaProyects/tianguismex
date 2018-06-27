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
	<div class="col-sm-12">
		<button class="btn btn-info" disabled="disabled">Disponible</button>
		<button class="btn btn-success" disabled="disabled">Seleccionado</button>
		<button class="btn btn-secondary" disabled="disabled">Ocupado</button>
	</div>
</div>
<div class="row">
	<div class="col-sm-12" style="overflow-x: scroll; width: 100%; padding: 15px;">
		<table>
			<tr><?php
			foreach ($local as $key => $value) {
				if ($value['disabled'] == 1) {
					$disabled = ' disabled';
					$class = 'default';
				} else {
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
				}
				
				$show = ($value['show'] == 1) ? '' : ' display: none;';
				
				if($column > $x){
					$column = 1; ?>
					</tr>
					<tr id="tr_'<?php echo $value['id'] ?>"><?php
				} 
				
				$value['cost'] = $objet['cost'];
				$value['des_cat'] = $objet['des_cat'];
				$value['date'] = $objet['date'].'-01';
				$local = json_encode($value);
				$local = str_replace('"', "'", $local); ?>
				
				<td 
					id="tr_<?php echo $value['id'] ?>"
					style="border: 1px solid; border-color: white; width: 45px; height: 32px" 
					align="center"
					x="<?php echo $value['x'] ?>"
					y="<?php echo $value['y'] ?>">
					<button 
						class="btn btn-block btn-<?php echo $class ?> btn-sm"
						onclick="local.select_local(<?php echo $local ?>)"
						id="btn_<?php echo $value['id'] ?>"
						style="<?php echo $show ?>"
						<?php echo $disabled ?> >
						<?php echo $value['description'] ?>
					</button>
				</td><?php
				
				$column++;
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
				<div class="row">
					<div class="col-sm-12" align="center" style="height: 300px; overflow-y: scroll; margin-bottom: 20px"> 
					CONTRATO DE ARRENDAMIENTO
QUE CELEBRAN POR UNA PARTE TIANGUISMEX, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ COMO “EL ARRENDADOR"; Y POR
OTRA PARTE COMPARECE (COLOCAR NOMBRE DE ARRENDATARIO) DE NACIONALIDAD MEXICANA, MAYOR DE EDAD, CON
DOMICILIO UBICADO EN ROSITA #159 FRACC REYNOSA QUIEN MANIFIESTA BAJO PROTESTA DE DECIR VERDAD DEDICARSE A UNA
ACTIVIDAD LICITA, Y A QUIEN EN LO SUCESIVO SE LE DENOMINARA "EL LOCATARIO";Y A TODOS LOS ANTERIORES EN SU
CONJUNTO, SE LES DENOMINARÀ COMO “LAS PARTES” EN EL CURSO DEL PRESENTE CONTRATO, EL CUAL SE SUJETA DE
CONFORMIDAD CON LAS SIGUIENTES:
C L A U S U L A S:
PRIMERA.- "EL ARRENDADOR" entrega a "EL LOCATARIO", y éste recibe de conformidad y en calidad de ARRENDAMIENTO para
dedicarlo única y exclusivamente para FINES COMERCIALES, el Inmueble identificado como Local No. (PONER NÚMERO DE LOCAL) del
Tianguis denominado “MERCADITO PUERTA DEL SOL”, ubicado en Av. Puerta del Sol s/n entre las calles Puerto Madero y Puerto
Vallarta, de la Colonias Puerta del Sol, en la ciudad de Reynosa, Tamaulipas, de # mts. de frente por # mts. de fondo, mismo que reúne con
todas las condiciones necesarias de higiene y salubridad, dándose “EL LOCATARIO” por recibido de ella a su entera satisfacción y en
condiciones de servir para el uso que se destina.
SEGUNDA.- "EL LOCATARIO" pagará a “EL ARRENDADOR" en efectivo por concepto de renta la cantidad de PRECIO DE CADA
PAQUETE,cantidad que deberá ser liquidada sin excepción los días 01 primero de cada mes, UNICA Y EXCLUSIVAMENTE mediante
ficha de pago emitida por el sistema PAYNET, emitido por la plataforma Openpay, en caso contrario se procederá a la rescisión automática
del presente contrato por así haberlo pactado entre “LAS PARTES".
Obligándose “EL LOCATARIO” a NO realizar el pago a terceras personas, ya que en caso de hacerlo se procederá a la rescisión automática del
presente contrato independientemente de las RESPONSABILIDADES DE TIPO PENAL que se le puedan imputar.
MANIFESTANDO “EL LOCATARIO” BAJO PROTESTA DE DECIR VERDAD QUE EL DINERO CON EL CUAL PAGARÁ LA RENTA,
CONFORME A LAS LINEAS ANTERIORES, PROVIENEN DE UNA ACTIVIDAD Y RECURSOS LÍCITOS.
TERCERA.- El término del arrendamiento será 30 treinta días naturales, susceptible de ser renovado por periodos continuos de 30 días
naturales SIEMPRE Y CUANDO SE CUMPLA CON EL PAGO PUNTUAL DE LA RENTA, en el entendido de que UNICA Y EXCLUSIVAMENTE
podrá disponer “EL LOCATARIO” del inmueble los días JUEVES, VIERNES, SABADO y DOMINGO de cada semana. Vencido el Plazo de
arrendamiento, no se entenderá prorrogado sino mediante contrato expreso y por escrito autorizado previamente por “EL ARRENDADOR”, en
consecuencia, renuncia "EL LOCATARIO" al derecho de Prórrogay DERECHO AL TANTO a que hacen alusión los Artículos1762, 1763, 1768,
1811, 1813, y demás relativos del Código Civil del Estado de Tamaulipas.
CUARTA.- Así mismo queda prohibido a "ELLOCATARIO", subarrendar, traspasar o ceder en cualquier forma el uso del bien
arrendado o los derechos del presente contrato. Los subarrendamientos, traspasos o cesiones concertadas en contravención de lo estipulado en
esta cláusula, además de ser nulos, e inoperantes respecto a "EL ARRENDADOR", darán lugar a la inmediata rescisión del presente contrato de
arrendamiento
 QUINTA.- Queda expresamente estipulado por “LAS PARTES”, que para la interpretación y cumplimiento del presente contrato se
someterán a los jueces y tribunales del 1º Distrito Judicial del Estado de Tamaulipas, renunciando al fuero de cualquier otro domicilio presente o
futuro. Y señalan como domicilio convencional para todos los efectos del mismo, el inmueble arrendado.“EL LOCATARIO" declara conocer todas
las normas legales citadas en el presente contrato y en especial aquellas a cuyos beneficios renuncia expresamente.
SEXTA.- "EL ARRENDADOR" no se hace responsable bajo ninguna circunstancia de robos, accidentes, incendios o cualquier otro
acontecimiento de otra naturaleza, que llegue a causar daños y/o perjuicios a "EL LOCATARIO" o a sus dependientes.
SEPTIMA.- Queda estrictamente prohibido a “EL LOCATARIO” destinar el inmueble arrendado para ocultar o mezclar bienes producto
de algún delito, así como el almacenaje, producción, comercialización, o cualquier otra actividad relacionada con sustancias toxicas, inflamables,
enervantes, estupefacientes o cualquier otro material, armamento o equipo prohibido por la ley, así como permitir que un tercero o terceros
utilicen el inmueble para la comisión de delitos de cualquier índole. La violación de esta cláusula será motivo de rescisión inmediata del presente
contrato, obligándose “EL LOCATARIO” a dejar a salvo, respecto de sus derechos, garantías, y patrimonio, a “EL ARRENDADOR” y/o al
propietario del Inmueble materia de este contrato, respecto de sus derechos, garantías, y patrimonio, de acuerdo a la LEY FEDERAL DE
EXTINCIÓN DE DOMINIO. Además de las obligaciones anteriores “EL LOCATARIO” se compromete a indemnizar a “EL ARRENDADOR” hasta
por el valor total comercial del inmueble arrendado, para el caso de que por virtud de la LEY FEDERAL DE EXTINCIÓN DE DOMINIO se prive
de la propiedad al titular del inmueble arrendado en el presente contrato
					</div>
				</div>
				<div class="row" id="div_confirm">
					<div class="col-sm-12 col-md-6" align="center">
						<button 
							class="btn btn-danger" 
							data-dismiss="modal"
							style="font-size: 20px" >
							<i class="fa fa-band"></i> Cancelar
						</button>
					</div>
					<div class="col-sm-12 col-md-6" align="center">
						<button 
							onclick="$('#div_pays_methods').show(); $('#div_confirm').hide()"
							class="btn btn-success" 
							style="font-size: 20px">
							<i class="fa fa-check"></i> Aceptar
						</button>
					</div>
				</div>
				<div class="row" id="div_pays_methods" style="display: none">
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