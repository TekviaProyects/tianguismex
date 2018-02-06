<?php
  session_start();
  if(isset($_SESSION['activo'])){
    echo "<script>window.location.href = '../';</script>";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../cliente/assets/semantic/semantic.min.css">
    <title>Login</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="linea absolute top full-width">

      </div>
      <div class="contenedorLogin relative">
        <div class="imagen">
          <img src="../resources/images/logo.png" alt="">
        </div>
        <div class="formulario">
          <div class="ui input">
            <input type="text" placeholder="Cuenta" id="cuenta">
          </div>
          <div class="ui input">
            <input type="password" placeholder="Contraseña" id="contrasenia">
          </div>
          <button type="button" name="button" id="btnEntrar">Entrar</button>
        </div>
        <span class="absolute left"><a href="#">Terminos y condiciones</a></span>
      </div>
    </div>
    <div class="nota fixed full-width left">
      <span>Su correo o contraseña son incorrectos</span>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../assets/js/funcionesLogin.js" charset="utf-8"></script>
  </body>
</html>
