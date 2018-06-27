<form onsubmit="event.preventDefault(); users.signin({form: 'form_login'})" id="form_login">
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
	</div>
	<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Entrar</button>
</form>