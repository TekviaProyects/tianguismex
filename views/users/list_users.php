<?php
// Validate the orders
	if (empty($clients)) {?>
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
				<h3 class="form-title"><i class="fa fa-users"></i> Clientes</h3>
			</div>
			<div class="form-body" style="padding: 30px">
				<div class="d-sm-none d-none d-md-block">
					<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="users_table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Correo</th>
								<th>Telefono</th>
								<th>Saldo</th>
								<th>Actividad</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody><?php
							foreach ($clients as $key => $value) { 
								if ($value['permit'] == 2) {
									$class = 'success';
									$text = 'Activar';
									$status = 1;
								} else {
									$class = 'danger';
									$text = 'Bloquear';
									$status = 2;
								} ?>
								
								<tr>
									<td><?php echo $value['id_cliente'] ?></td>
									<td><?php echo $value['nombre_cliente'] ?></td>
									<td><?php echo $value['correo_cliente'] ?></td>
									<td><?php echo $value['celular_cliente'] ?></td>
									<td>$<?php echo number_format($value['balance']) ?></td>
									<td align="center">
										<button
											class="btn btn-primary btn-block"
											onclick="local.list_orders({
												client_id: <?php echo $value['id_cliente'] ?>,
												tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
												div: 'contenedor',
												view: 'list_orders_admin'
											})">
											Actividad
										</button>
									</td>
									<td align="center">
										<button
											class="btn btn-<?php echo $class ?> btn-block"
											onclick="users.update_x_tianguis({
												client_id: <?php echo $value['id_cliente'] ?>,
												tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
												status: <?php echo $status ?>
											})">
											<?php echo $text ?>
										</button>
									</td>
								</tr><?php
							} ?>
						</tbody>
					</table>
				</div>
				<div class="d-lg-none d-md-none"><?php
					foreach ($clients as $key => $value) {
						if ($value['permit'] == 2) {
							$class = 'success';
							$text = 'Activar';
							$status = 1;
						} else {
							$class = 'danger';
							$text = 'Bloquear';
							$status = 2;
						} ?>
								
						<div class="card text-center" style="margin-bottom: 15px">
							<div class="card-header">
								# <?php echo $value['id_cliente'] ?>
							</div>
							<div class="card-body">
								<p class="card-text"><?php echo $value['nombre_cliente'] ?></p>
								<p class="card-text"><?php echo $value['correo_cliente'] ?></p>
								<p class="card-text"><?php echo $value['celular_cliente'] ?></p>
								<p class="card-text">$<?php echo number_format($value['balance']) ?></p>
							</div>
							<div class="card-footer text-muted">
								<button
									class="btn btn-"<?php echo $class ?> btn-block"
									onclick="users.update_x_tianguis({
										client_id: <?php echo $value['id_cliente'] ?>,
										tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
										status: <?php echo $status ?>
									})">
									<?php echo $text ?>
								</button>
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
	$('#users_table').DataTable({
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