<form onsubmit="event.preventDefault(); users.save({form: 'form_save_user'})" id="form_save_user">
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" class="form-control" id="name" placeholder="Nombre" required="1">
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label for="address">Dirección</label>
				<input type="text" class="form-control" id="address" placeholder="Dirección" required="1">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label for="mail">Correo</label>
				<input type="email" class="form-control" id="mail" placeholder="juan@juan.com" required="1">
			</div>
		</div>
		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label for="tel">Telefono</label>
				<input type="tel" class="form-control" id="tel" placeholder="0000000000" required="1">
			</div>
		</div>
		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label for="ine_front">INE frente</label>
				<input type="file" class="form-control" name="ine_front" id="ine_front" placeholder="INE frente" required="1">
			</div>
		</div>
		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label for="image">INE reverso</label>
				<input type="file" class="form-control" name="ine_back" id="ine_back" placeholder="INE reverso" required="1">
			</div>
		</div>
		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label for="c_address">Comprobante de domicilio</label>
				<input type="file" class="form-control" name="c_address" id="c_address" placeholder="Comprobante" required="1">
			</div>
		</div>
	</div>
	<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Guardar</button>
</form>