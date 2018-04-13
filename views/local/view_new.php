<?php session_start() ?>
<div class="row">
	<div class="col-sm-12">
		<h3>Ubicacion</h3>
		Selecciona tu ubicación.
        <select class="selectpicker" id="state">
            <option value="">Todo México</option>
            <option value="1">Aguascalientes</option>
            <option value="2">Baja California</option>
            <option value="3">Baja California Sur</option>
            <option value="4">Campeche</option>
            <option value="5">Coahuila de Zaragoza</option>
            <option value="6">Colima</option>
            <option value="7">Chiapas</option>
            <option value="8">Chihuahua</option>
            <option value="9">CDMX</option>
            <option value="10">Durango</option>
            <option value="11">Guanajuato</option>
            <option value="12">Guerrero</option>
            <option value="13">Hidalgo</option>
            <option value="14">Jalisco</option>
            <option value="15">México</option>
            <option value="16">Michoacán de Ocampo</option>
            <option value="17">Morelos</option>
            <option value="18">Nayarit</option>
            <option value="19">Nuevo León</option>
            <option value="20">Oaxaca</option>
            <option value="21">Puebla</option>
            <option value="22">Querétaro</option>
            <option value="23">Quintana Roo</option>
            <option value="24">San Luis Potosí</option>
            <option value="25">Sinaloa</option>
            <option value="26">Sonora</option>
            <option value="27">Tabasco</option>
            <option value="28">Tamaulipas</option>
            <option value="29">Tlaxcala</option>
            <option value="30">Veracruz de Ignacio de la Llave</option>
            <option value="31">Yucatán</option>
            <option value="32">Zacatecas</option>
        </select><br /><br />
        <button 
        	onclick="markets.list_markets({
        		div: 'contenedor',
        		state: $('#state').val(),
        		client_id: '<?php echo $_SESSION['user']['id'] ?>'
        	});"
        	class="btn btn-primary">
        	Siguiente
        </button>
	</div>
</div>
<script>
	$("#state").select2({
		theme: "bootstrap4"
	});
</script>