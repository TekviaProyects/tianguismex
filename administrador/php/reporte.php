<div class="contenidoReporte">
  <h2>REPORTE</h2>
  <div class="ui form">
    <div class="two fields">
      <div class="field">
        <label>Fecha inicial</label>
        <div class="ui calendar" id="rangestart">
          <div class="ui input left icon">
            <i class="calendar icon"></i>
            <input type="text" placeholder="Inicio" id="fechaInicial">
          </div>
        </div>
      </div>
      <div class="field">
        <label>Fecha final</label>
        <div class="ui calendar" id="rangeend">
          <div class="ui input left icon">
            <i class="calendar icon"></i>
            <input type="text" placeholder="Fin" id="fechaFinal">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ui vertical segment">
    <p><h1>Total generado por este periodo de tiempo:</h1><span id="total">$00.00</span></p>
  </div>
  <h2>GRAFICA POR AÑO</h2>
  <div class="ui calendar" id="example8">
    <div class="ui input left icon">
      <i class="time icon"></i>
      <input type="text" placeholder="Año">
    </div>
  </div>
  <h3 class="anioActual" id="anioActual"><?php echo date('Y'); ?></h3>
  <div class="ui vertical segment">
    <div id="chart">

    </div>
  </div>
  <h2>GRAFICA POR AÑO (Ingresos mensuales)</h2>
  <div class="ui calendar" id="selectAnio">
    <div class="ui input left icon">
      <i class="time icon"></i>
      <input type="text" placeholder="Año">
    </div>
  </div>
  <h3 class="anioActual" id="anioActual2"><?php echo date('Y'); ?></h3>
  <div class="ui vertical segment">
    <div id="chart2">

    </div>
  </div>
</div>
<script src="assets/js/funcionesReporte.js" charset="utf-8"></script>
