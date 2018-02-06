<div class="contenidoLocales">
  <div class="corriente">
    <h2>Locales corriente</h2>
    <div class="buscadorCorriente busqueda" id="busquedaCorriente">
      <div class="ui calendar" id="fechaCorriente">
        <div class="ui input left icon" id="cosa">
          <i class="calendar icon"></i>
          <input class="animacionInputFail" type="text" placeholder="Fecha">
        </div>
      </div>
      <div class="ui selection dropdown" id="selectorCorriente">
        <input type="hidden" name="gender">
        <i class="dropdown icon"></i>
        <div class="default text">Tipo</div>
        <div class="menu">
          <div class="item" data-value="1">Normal</div>
          <div class="item" data-value="2">Class</div>
          <div class="item" data-value="3">Ultra</div>
          <div class="item" data-value="4">Super-ultra</div>
          <div class="item" data-value="5">Master</div>
        </div>
      </div>


      <button type="button" name="button" id="btnCorriente">Buscar</button>
      <i class="info circle icon infoLocales" data-content="Selecciona una fecha de inicio para un periodo y un tipo de cobro para ver los locales al corriente." data-variation="mini"></i>
    </div>
    <table class="ui very basic table" id="tablaCorriente">
      <thead>
        <tr>
          <th>Numero local</th>
          <th>Locatario</th>
          <th>Telefono</th>
          <th>Tipo de local</th>
          <th>Fecha de inicio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="deuda">
    <h2>Locales Deuda</h2>
    <div class="buscadorDeuda busqueda" id="busquedaDeuda">
      <div class="ui calendar" id="fechaDeuda">
        <div class="ui input left icon" id="cosa1">
          <i class="calendar icon"></i>
          <input type="text" placeholder="Fecha">
        </div>
      </div>
      <div class="ui selection dropdown" id="selectorDeuda">
        <input type="hidden" name="gender">
        <i class="dropdown icon"></i>
        <div class="default text">Tipo</div>
        <div class="menu">
          <div class="item" data-value="1">Normal</div>
          <div class="item" data-value="2">Class</div>
          <div class="item" data-value="3">Ultra</div>
          <div class="item" data-value="4">Super-ultra</div>
          <div class="item" data-value="5">Master</div>
        </div>
      </div>


      <button type="button" name="button" id="btnDeuda">Buscar</button>
      <i class="info circle icon infoLocales" data-content="Selecciona una fecha de inicio para un periodo y un tipo de cobro para ver los locales con deudas." data-variation="mini"></i>
    </div>
    <table class="ui very basic table" id="tablaDeudas">
      <thead>
        <tr>
          <th>Numero local</th>
          <th>Locatario</th>
          <th>Telefono</th>
          <th>Tipo de local</th>
          <th>Fecha de inicio</th>
          <th>Fecha limite de pago</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="ui modal" id="modalCliente">
    <i class="close icon"></i>
    <div class="header" id="nombreCliente">
      Informacion del cliente
    </div>
    <div class="image content" >
      <div class="ui medium image" id="fotoCliente">
        <img src="" alt="">
      </div>
      <div class="description">
        <span><h4>Nombre</h4><span id="nombre">Juancho lopez</span></span>
        <span><h4>Telefono</h4><span id="telefono">878956458</span></span>
        <span><h4>Correo</h4><span id="correo">jeje@gmail.com</span></span>
        <span><h4>Domicilio</h4><span id="domicilio">domicilio fregon</span></span>
      </div>
    </div>
  </div>
  <div class="ui modal" id="modalMensaje">
    <div class="ui inverted dimmer" id="loaderMensaje">
      <div class="ui text loader">Loading</div>
    </div>
    <div class="header">
      Envio de mensaje
    </div>
    <div class="content">
      <h3>Escribe un mensaje</h3>
      <span id="numeroDestino">123</span>
      <input type="hidden" name="" id="numero" value="">
      <textarea name="name" rows="8" cols="80" maxlength="160" id="textoMensaje"></textarea>
    </div>
    <div class="actions">
      <button type="button" name="button" id="btnCerrar">Cerrar</button>
      <button type="button" name="button" id="btnEnviar">Enviar</button>
    </div>
  </div>

</div>

<script src="assets/js/funcionesLocales.js" charset="utf-8"></script>
