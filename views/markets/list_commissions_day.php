<?php
	setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
?>
<div class="row">
	<div class="col-sm-12">
		<div class="card bg-light" style="width: 100%">
			<div class="card-header">
				<b>Comisiones del día <?php echo $date[0] ?></b>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr style="font-weight: bold">
							<td>Tipo de operación</td>
							<td align="center">Transacciones</td>
							<td>%</td>
							<td>$</td>
							<td align="right">Total</td>
							<td align="right">Comisión</td>
							<td align="right">IVA</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tarjeta</td>
							<td align="center"><?php echo number_format($data['card']['num']) ?></td>
							<td><?php echo number_format($data['card']['porcent']) ?>%</td>
							<td>$<?php echo number_format($data['card']['commission'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['card']['revenues'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['card']['expenses'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['card']['iva'], 2, '.', ',') ?></td>
						</tr>
						<tr>
							<td>Tienda</td>
							<td align="center"><?php echo number_format($data['store']['num']) ?></td>
							<td><?php echo number_format($data['store']['porcent']) ?>%</td>
							<td>$<?php echo number_format($data['store']['commission'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['store']['revenues'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['store']['expenses'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['store']['iva'], 2, '.', ',') ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr style="font-weight: bold">
							<td>Totales</td>
							<td align="center"><?php echo number_format($data['num']) ?></td>
							<td><?php echo number_format($data['porcent']) ?>%</td>
							<td>$<?php echo number_format($data['commission'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['revenues'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['expenses_iva_off'], 2, '.', ',') ?></td>
							<td align="right">$<?php echo number_format($data['iva'], 2, '.', ',') ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div><br />
<div class="row">
	<div class="col-sm-12">
		<div class="card bg-light" style="width: 100%">
			<div class="card-header">
				<b>Movimientos del día <?php echo $date[0] ?></b>
			</div>
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Hora</th>
							<th>Monto</th>
							<th>Comisión</th>
							<th>IVA</th>
						</tr>
					</thead>
					<tbody><?php
						foreach ($orders as $key => $value) { ?>
							<tr 
								onclick="local.view_details({
									id: <?php echo $value['id'] ?>,
									div: 'div_modal_details'
								})"
								data-toggle="modal"
								data-target="#modal_details">
								<td><?php echo date("H:i:s",strtotime($value['creation_date'])) ?></td>
								<td>$<?php echo $value['cost'] ?></td>
								<td>$<?php echo $value['expenses_iva_off'] ?></td>
								<td>$<?php echo $value['iva'] ?></td>
							</tr><?php
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_details" tabindex="-1" role="dialog" aria-labelledby="modal_detailsLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body" id="div_modal_details">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cerrar
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_authorize" tabindex="-1" role="dialog" aria-labelledby="modal_authorizeLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body" id="div_modal_authorize">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" onclick="printDiv('div_print')">
					Imprimir
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cerrar
				</button>
			</div>
		</div>
	</div>
</div>