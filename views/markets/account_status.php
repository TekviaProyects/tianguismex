<?php
	setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
?>
<div class="row">
	<div class="col-sm-12 col-md-8">
		<div class="card bg-light" style="width: 100%">
			<div class="card-header">
				<b>Movimientos</b>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Tipo de operación</th>
							<th>Transacciones</th>
							<th>Ingresos</th>
							<th>Egresos</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Cobros a tarjeta</td>
							<td align="center"><?php echo $data['card']['num'] ?></td>
							<td>$<?php echo number_format($data['card']['revenues'], 2, '.', ',') ?></td>
							<td>- $<?php echo number_format($data['card']['expenses'], 2, '.', ',') ?></td>
						</tr>
						<tr>
							<td>Tienda</td>
							<td align="center"><?php echo $data['store']['num'] ?></td>
							<td>$<?php echo number_format($data['store']['revenues'], 2, '.', ',') ?></td>
							<td>- $<?php echo number_format($data['store']['expenses'], 2, '.', ',') ?></td>
						</tr>
						<tr>
							<td>Pagos de IVA de comisiones</td>
							<td align="center"><?php echo $data['num'] ?></td>
							<td></td>
							<td>- $<?php echo number_format($data['iva'], 2, '.', ',') ?></td>
						</tr>
						<tr style="font-weight: bold">
							<td>Totales</td>
							<td align="center"><?php echo $data['num'] ?></td>
							<td>$<?php echo number_format($data['revenues'], 2, '.', ',') ?></td>
							<td>- $<?php echo number_format($data['expenses'], 2, '.', ',') ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class=" col-md-4">
		<div class="card bg-light" style="width: 100%">
			<div class="card-header">
				<b>Resumen</b>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						Ingresos
					</div>
					<div class="col-sm-12 col-md-6" align="right">
						$<?php echo number_format($data['revenues'], 2, '.', ',') ?>
					</div>
					<div class="col-sm-12 col-md-6">
						Egresos
					</div>
					<div class="col-sm-12 col-md-6" align="right">
						- $<?php echo number_format($data['expenses'], 2, '.', ',') ?>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<b>Saldo Final</b>
					</div>
					<div class="col-sm-12 col-md-6" align="right">
						<b>$<?php echo number_format($data['total'], 2, '.', ',') ?></b>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><br />
<div class="row">
	<div class="col-sm-12">
		<div class="card bg-light" style="width: 100%">
			<div class="card-header">
				<b>Estado de cuenta</b>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Saldo anterior</th>
							<th>Total de ingresos</th>
							<th>Total de egresos</th>
							<th>Saldo final</th>
						</tr>
					</thead>
					<tbody><?php
						foreach ($data['new_orders'] as $key => $value) { ?>
							<tr>
								<td><?php echo strftime("%d %b %y",strtotime($value['pay_date'])) ?></td>
								<td>$<?php echo number_format($value['last_balance'], 2, '.', ',') ?></td>
								<td>$<?php echo number_format($value['revenues'], 2, '.', ',') ?></td>
								<td>- $<?php echo number_format($value['expenses'], 2, '.', ',') ?></td>
								<td>$<?php echo number_format($value['balance'], 2, '.', ',') ?></td>
							</tr><?php
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>