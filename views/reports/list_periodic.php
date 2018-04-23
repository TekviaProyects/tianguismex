<?php
	session_start();
// Validate the orders
	if (empty($data)) {?>
		<div align="center">
			<h3>
				<span class="label label-default">
					* Sin resultados *
				</span>
			</h3>
			<button 
				onclick="reports.view_periodic({
					tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>,
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
				<h3 class="form-title"><i class="fa fa-calendar"></i> Ordenes</h3>
			</div>
			<div class="form-body" style="padding: 30px">
				<div class="d-sm-none d-none d-md-block">
					<table 
						style="font-size: 1rem" 
						class="table table-striped table-bordered" 
						cellspacing="0" 
						width="100%" 
						id="orders_table">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Correo</th>
								<th>Pagadas</th>
								<th>Caducadas</th>
								<th>Pendientes</th>
							</tr>
						</thead>
						<tbody><?php
							foreach ($data as $key => $value) { ?>
								<tr class="">
									<td><?php echo $value['name'] ?></td>
									<td><?php echo $value['mail'] ?></td>
									<td align="center"><?php echo $value[1] ?></td>
									<td align="center"><?php echo $value[2] ?></td>
									<td align="center"><?php echo $value[0] ?></td>
								</tr><?php
							} ?>
						</tbody>
					</table>
				</div>
				<div class="d-lg-none d-md-none"><?php
					foreach ($data as $key => $value) { ?>
						<div class="card text-center" style="margin-bottom: 15px">
							<div class="card-header">
								Cliente: <?php echo $value['name'] ?>
							</div>
							<div class="card-body">
								<p class="card-text"><?php echo $value['mail'] ?></p>
								<p class="card-text"><?php echo $value[1] ?></p>
								<p class="card-text"><?php echo $value[2] ?></p>
								<p class="card-text">$<?php echo $value[0] ?></p>
							</div>
							<div class="card-footer text-muted">
								
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
				title: 'Ordenes',
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
		            // columns: '0, 1, 2, 3'
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
</script>