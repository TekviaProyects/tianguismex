<?php
	setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
?>
<div class="row">
	<div class="col-sm-12">
		<div class="card bg-light" style="width: 100%">
			<div class="card-header">
				<b>Comisiones del periodo</b>
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
				<b>Comisiones por día</b>
			</div>
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Comisión</th>
							<th>IVA</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody><?php
						foreach ($data['new_orders'] as $key => $value) { ?>
							<tr 
								onclick="markets.account_status({
									range: '<?php echo $value['pay_date'].' - '.$value['pay_date'] ?>',
									div: 'div_info_commissions',
									view: 'list_commissions_day',
									tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>
								})">
								<td><?php echo strftime("%d %b %y",strtotime($value['pay_date'])) ?></td>
								<td>$<?php echo number_format($value['expenses_iva_off'], 2, '.', ',') ?></td>
								<td>$<?php echo number_format($value['iva'], 2, '.', ',') ?></td>
								<td>$<?php echo number_format($value['expenses'], 2, '.', ',') ?></td>
							</tr><?php
						} ?>
					</tbody>
					<tfoot>
						<tr style="font-weight: bold">
							<td>Totales</td>
							<td>$<?php echo number_format($data['expenses_iva_off'], 2, '.', ',') ?></td>
							<td>$<?php echo number_format($data['iva'], 2, '.', ',') ?></td>
							<td>$<?php echo number_format($data['expenses'], 2, '.', ',') ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>