<?php
  session_start();
  if(!isset($_SESSION['activo'])){
    echo "<script>window.location.href = 'login';</script>";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../cliente/assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../cliente/assets/semantic-ui-calendar/dist/calendar.min.css">
    <link rel="stylesheet" href="../cliente/assets/c3-master/c3.min.css">
    <link rel="stylesheet" href="assets/css/master.css">
  </head>
  <body>
    <div class="cargador">
      <div class="capa1">

      </div>
      <div class="capa2">

      </div>
    </div>

    <header>
      <div class="linea">

      </div>
      <div class="menu">
        <div class="logo">
          <img src="../cliente/resources/mercadito.png" alt="">
        </div>
        <nav>
          <ul>
            <li><a id="opcLocales" class="seleccionado" href="#">Locales</a></li>
            <li><a id="opcUsuarios" href="#">Usuarios</a></li>
            <li><a id="opcCroquis" href="#">Croquis</a></li>
            <?php
              if($_SESSION['tipo'] == '1'){
            ?>
            <li><a id="opcReporte" href="#">Reporte</a></li>
            <?php
              }
            ?>
            <li><a id="opcControl" href="#">Control</a></li>
            <li><a id="opcConfiguracion" href="#">Configuracion</a></li>
          </ul>
          <a href="php/close.php"><button type="button" name="button">Cerrar sesion</button></a>
        </nav>
        <div class="botonMovil">
          <div class="lineaM n1">
          </div>
          <div class="lineaM n2">
          </div>
          <div class="lineaM n3">
          </div>
        </div>
      </div>

    </header>
    <aside class="menuLateral cerrado">
      <div class="animacion">

      </div>
      <div class="menu movil">
          <ul class="irse irseBien">
            <li><a id="opcLocalesM" class="seleccionado" href="#">Locales</a></li>
            <li><a id="opcUsuariosM" href="#">Usuarios</a></li>
            <li><a id="opcCroquisM" href="#">Croquis</a></li>
            <?php
              if($_SESSION['tipo'] == '1'){
            ?>
            <li><a id="opcReporteM" href="#">Reporte</a></li>
            <?php
              }
            ?>
            <li><a id="opcControlM" href="#">Control</a></li>
            <li><a id="opcConfiguracionM" href="#">Configuracion</a></li>
            <li><a id="Cerras sesion" href="php/close.php">Cerrar Sesión</a></li>
          </ul>
      </div>
    </aside>
    <main>
      <div class="wrapper">


      </div>
    </main>
    <footer>

    </footer>
  </body>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="../cliente/assets/semantic/semantic.min.js"></script>
  <script type="text/javascript" src="../cliente/assets/semantic-ui-calendar/dist/calendar.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" charset="utf-8"></script>
  <script src="https://d3js.org/d3.v3.min.js"></script>
  <script src="../cliente/assets/c3-master/c3.min.js"></script>
  <script src="assets/js/animaciones.js" charset="utf-8"></script>
  <script src="assets/js/paginador.js" charset="utf-8"></script>


</html>
