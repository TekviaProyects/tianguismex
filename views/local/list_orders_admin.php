<?php
// Validate the orders
	if (empty($orders)) {?>
		<div align="center">
			<h3>
				<span class="label label-default">
					* Sin resultados *
				</span>
			</h3>
		</div><?php

		return;
	}

	session_start();
?>
<div class="row">
	<div class="col-sm-12">
		<div class="signup-form-container">
			<div class="form-header">
				<h3 class="form-title"><i class="fa fa-calendar"></i> Movimientos</h3>
			</div>
			<div class="form-body" style="padding: 30px">
				<div class="row" style="padding-bottom: 10px">
					<div class="col-sm-12">
						<button 
							onclick="local.list_orders({
								tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
								div: 'contenedor',
								status: ' 0',
								view: 'list_orders_admin'
							})"
							class="btn btn-info">
							Pendiente
						</button>
						<button 
							onclick="local.list_orders({
								tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
								div: 'contenedor',
								status: 1,
								view: 'list_orders_admin'
							})" 
							class="btn btn-success">
							Aprovada
						</button>
						<button 
							onclick="local.list_orders({
								tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
								div: 'contenedor',
								status: 2,
								view: 'list_orders_admin'
							})" 
							class="btn btn-danger">
							Cancelada
						</button>
					</div>
				</div>
				<div class="d-sm-none d-none d-md-block">
					<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="orders_table">
						<thead>
							<tr>
								<th>#</th>
								<th>Total</th>
								<th>Fecha de ingreso</th>
								<th>Fecha de caducidad</th>
								<th>Detalles</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody><?php
							foreach ($orders as $key => $value) { ?>
								<tr class="">
									<td><?php echo $value['id'] ?></td>
									<td>$<?php echo $value['cost'] ?></td>
									<td><?php echo $value['creation_date'] ?></td>
									<td><?php echo $value['due_date'] ?></td>
									<td align="center">
										<button
											data-toggle="modal"
											data-target="#modal_details"
											class="btn btn-primary btn-block"
											onclick="local.view_details({
												id: <?php echo $value['id'] ?>,
												div: 'div_modal_details'
											})">
											<i class="fa fa-list fa-lg"></i>
										</button>
									</td>
									<td align="center"><?php
										switch ($value['status']) {
											case 1: ?>
												<button
													data-toggle="modal"
													data-target="#modal_authorize"
													class="btn btn-success btn-block"
													onclick="local.view_voucher({
														id: <?php echo $value['id'] ?>,
														div: 'div_modal_authorize'
													})">
													Ver comprobante
												</button><?php
												break;
											
											case 2: ?>
												<button class="btn btn-danger btn-block" disabled>
													Cancelada
												</button><?php
												break;
											
											default: ?>
												<button
													id="btn_<?php echo $value['id'] ?>"
													class="btn btn-info btn-block"
													onclick="local.download_pay({
														id: <?php echo $value['id'] ?>,
														json: 1
													})">
													Descargar ficha
												</button><?php
												break;
										} ?>
									</td>
								</tr><?php
							} ?>
						</tbody>
					</table>
				</div>
				<div class="d-lg-none d-md-none"><?php
					foreach ($orders as $key => $value) { ?>
						<div class="card text-center" style="margin-bottom: 15px">
							<div class="card-header">
								SOLICITUD # <?php echo $value['id'] ?>
							</div>
							<div class="card-body">
								<p class="card-text"><?php echo $value['nombre'] ?></p>
								<p class="card-text"><?php echo $value['correo'] ?></p>
								<p class="card-text"><?php echo $value['date'] ?></p>
								<p class="card-text"><?php echo $value['cost_request'] ?></p>
							</div>
							<div class="card-footer text-muted">
								<button
									data-toggle="modal"
									data-target="#modal_details"
									class="btn btn-primary btn-block"
									onclick="local.view_details({
										id: <?php echo $value['id'] ?>,
										div: 'div_modal_details'
									})">
									<i class="fa fa-list fa-lg"></i>
								</button><?php
								
								switch ($value['status']) {
									case 1: ?>
										<button
											data-toggle="modal"
											data-target="#modal_authorize"
											class="btn btn-success btn-block"
											onclick="local.view_voucher({
												id: <?php echo $value['id'] ?>,
												div: 'div_modal_authorize'
											})">
											Ver comprobante
										</button><?php
										break;
									
									case 2: ?>
										<button class="btn btn-danger btn-block">
											Cancelada
										</button><?php
										break;
									
									default: ?>
										<button
											id="btn_<?php echo $value['id'] ?>"
											class="btn btn-info btn-block"
											onclick="local.download_pay({
												id: <?php echo $value['id'] ?>,
												json: 1
											})">
											Descargar ficha
										</button><?php
										break;
								} ?>
							</div>
						</div><?php
					} ?>
				</div>
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
<script>
	$('#orders_table').DataTable({
	    fixedHeader: {
	        header: true,
	        footer: true
	    },
	    scrollX: true,
		language : {
			destroy: true,
			search : "<i class=\"fa fa-search\"></i>",
			lengthMenu : "_MENU_ por pagina",
			zeroRecords : "No hay datos.",
			infoEmpty : "No hay datos para mostrar.",
			info : " ",
			infoFiltered : " -> <strong> _TOTAL_ </strong> resultados encontrados",
			paginate : {
				first : "Primero",
				previous : "<<",
				next : ">>",
				last : "Último"
			}
		}
	});
</script>