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
						<button class="btn btn-info">Pendiente</button>
						<button class="btn btn-success">Aprovada</button>
						<button class="btn btn-danger" disabled>Cancelada</button>
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
								<tr>
									<td><?php echo $value['id'] ?></td>
									<td>$<?php echo $value['cost'] ?></td>
									<td><?php echo $value['creation_date'] ?></td>
									<td><?php echo $value['due_date'] ?></td>
									<td align="center">
										<button
											data-toggle="modal"
											data-target="#modal_details"
											class="btn btn-primary btn-block"
											onclick="orders.load_info_buttons({
												id: '<?php echo $value['id'] ?>',
												formato: '<?php echo $value['comprobante'] ?>',
												identificacion: '<?php echo $value['identificacion'] ?>',
												c_salubridad: '<?php echo $value['sanidad'] ?>',
												croquis: '<?php echo $value['fotografia1'] ?>',
												f1: '<?php echo $value['fotografia1'] ?>',
												f2: '<?php echo $value['fotografia2'] ?>',
												f3: '<?php echo $value['fotografia3'] ?>',
												f4: '<?php echo $value['fotografia4'] ?>',
												c_delegado: '<?php echo $value['cartadelegado'] ?>',
												c_aceptacion: '<?php echo $value['cartaaceptacion'] ?>',
												lat: '<?php echo $value['lat'] ?>',
												lng: '<?php echo $value['lng'] ?>',
												coment: '<?php echo $value['comentario'] ?>'
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
													onclick="orders.authorize({
														id: <?php echo $value['id'] ?>,
														user_id: <?php echo $value['user_id'] ?>,
														estadomx: '<?php echo $value['estadomx'] ?>',
														municipiomx: '<?php echo $value['municipiomx'] ?>',
														status: 1
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
														order_id: <?php echo $value['id'] ?>
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
									onclick="orders.load_info_buttons({
										
									})">
									<i class="fa fa-list fa-lg"></i>
								</button><?php
								
								switch ($value['status']) {
									case 1: ?>
										<button
											data-toggle="modal"
											data-target="#modal_authorize"
											class="btn btn-success btn-block"
											onclick="orders.authorize({
												id: <?php echo $value['id'] ?>,
												user_id: <?php echo $value['user_id'] ?>,
												estadomx: '<?php echo $value['estadomx'] ?>',
												municipiomx: '<?php echo $value['municipiomx'] ?>',
												status: 1
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
												order_id: <?php echo $value['id'] ?>
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
			<div class="modal-header">
				<h2 class="modal-title">Detalles</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="div_modal_details">
				Especifica la razon por al cual se autoriza o se denega la solicitud:<br />
				<textarea class="form-control" rows="3" id="coment"></textarea>
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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modal_authorizeLabel">Escribe un comentario</h4>
			</div>
			<div class="modal-body" id="div_modal_authorize">
				Especifica la razon por al cual se autoriza o se denega la solicitud:<br />
				<textarea class="form-control" rows="3" id="coment"></textarea>
			</div>
			<div class="modal-footer">
				<button
					id="btn_authorize"
					status=""
					request_id=""
					user_id=""
					estadomx=""
					municipiomx=""
					type="button"
					class="btn btn-info"
					onclick="orders.update_authorize({
						status: $(this).attr('status'),
						request_id: $(this).attr('request_id'),
						user_id: $(this).attr('user_id'),
						estadomx: $(this).attr('estadomx'),
						coment: $('#coment').val(),
						state: '<?php echo $_SESSION['dependencie']['estadodep'] ?>',
						municipality: '<?php echo $_SESSION['dependencie']['municipiodep'] ?>'
					})">
					<i class="fa fa-check"></i> Guardar
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