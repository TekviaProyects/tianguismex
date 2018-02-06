<div class="contenidoUsuarios">
  <h2>Clientes</h2>
  <button type="button" name="button" id="btnClientes">Cargar clientes</button>
  <table class="ui very basic table" id="tablaClientes">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Domicilio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  <h2>Clientes sin local</h2>
  <table class="ui very basic table" id="tablaClientes2">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Domicilio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  <h2>Estos clientes han dejado de rentar</h2>
  <table class="ui very basic table" id="tablaClientes3">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Domicilio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
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
<script src="assets/js/funcionesUsuarios.js" charset="utf-8"></script>
