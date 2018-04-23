<?php session_start(); ?>
<div class="row">
	<div class="col-sm-12">
		<div class="signup-form-container">
			<div class="form-header">
				<h3 class="form-title"><i class="fa fa-list"></i> Reporte periodico</h3>
			</div>
			<div class="form-body" style="padding: 30px">
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label>Rango</label>
						<input type="text" name="daterange" class="form-control" id="range" />
					</div>
					<div class="col-sm-12 col-md-2" style="padding-top: 30px">
						<button
							onclick="reports.list_periodic({
								range: $('#range').val(),
								div: 'div_info_periodic',
								tianguis_id: <?php echo $_SESSION['tianguis']['id'] ?>
							})" 
							class="btn btn-info btn-block">
							Buscar
						</button>
					</div>
				</div><br />
				<div class="row">
					<div class="col-sm-12" id="div_info_periodic">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('input[name="daterange"]').daterangepicker({
		locale: {
	      	format: 'YYYY-MM-DD',
	        separator: " - ",
	        applyLabel: "Aplicar",
	        cancelLabel: "Cancelar",
	        fromLabel: "De",
	        toLabel: "A",
	        customRangeLabel: "Personalizado",
	        daysOfWeek: [
	            "Do",
	            "Lu",
	            "Ma",
	            "Mi",
	            "Ju",
	            "Vi",
	            "Sa"
	        ],
	        monthNames: [
	            "Enero",
	            "Febrero",
	            "Marzo",
	            "Abril",
	            "Mayo",
	            "Junio",
	            "Julio",
	            "Agosto",
	            "Septiember",
	            "Octubre",
	            "Noviembre",
	            "Diciember"
	        ],
	        firstDay: 1
	    }
	});
</script>