<?php
	session_start();
// Validate the orders
	if (empty($orders)) {?>
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
<div class="row">
	<div class="col-sm-12">
		<div class="signup-form-container">
			<div class="form-header">
				<h3 class="form-title"><i class="fa fa-calendar"></i> Movimientos</h3>
			</div>
			<div class="form-body" style="padding: 30px">
				<div class="row" style="padding-bottom: 10px; padding-left: 15px">
					<div class="col-sm-12 col-md-4">
						<select 
							id="status_select"
							onchange="local.list_orders({
								status: $(this).val(),
								client_id: <?php echo $_REQUEST['client_id'] ?>,
								div: 'contenedor',
							})"
							class="custom-select">
							<option value="">Todas</option>
							<option value=" 0">Pendientes</option>
							<option value="1">Pagadas</option>
							<option value="2">Canceladas</option>
						</select>
					</div>
				</div><br />
				<div class="d-sm-none d-none d-md-block">
					<table 
						style="font-size: 1rem" 
						class="table table-striped table-bordered" 
						cellspacing="0" 
						width="100%" 
						id="orders_table">
						<thead>
							<tr>
								<th>Creación</th>
								<th>Descripción</th>
								<th>Telefono</th>
								<th>Monto</th>
								<th>Detalles</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody><?php
							foreach ($orders as $key => $value) { ?>
								<tr class="">
									<td align="center"><?php echo $value['creation_date'] ?></td>
									<td><?php echo $value['description'] ?></td>
									<td><?php echo $value['tel'] ?></td>
									<td>$<?php echo $value['cost'] ?></td>
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
								Folio: <?php echo $value['id'] ?>
							</div>
							<div class="card-body">
								<p class="card-text"><?php echo $value['creation_date'] ?></p>
								<p class="card-text"><?php echo $value['description'] ?></p>
								<p class="card-text"><?php echo $value['tel'] ?></p>
								<p class="card-text">$<?php echo $value['cost'] ?></p>
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
        dom: 'Bfrtip',
	    buttons: [
			{
				title: 'Movimientos',
				className: 'btn btn-secundary',
				text: 'Imprimir',
		        extend: 'print',
		        exportOptions: {
		            columns: '0, 1, 2, 3'
		        }
	       },
	       {
				title: 'Movimientos',
				className: 'btn btn-success',
				text: 'Excel',
		        extend: 'excel',
		        exportOptions: {
		            columns: '0, 1, 2, 3'
		        }
	       },
	       {
				title: 'Movimientos',
				className: 'btn btn-danger',
				text: 'PDF',
		        extend: 'pdf',
		        exportOptions: {
		            columns: '0, 1, 2, 3'
		        }
	       }
	    ],
	    order: [[ 0, "desc"]],
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
	
	$("#status_select").val('<?php echo $_REQUEST['status'] ?>');
</script>