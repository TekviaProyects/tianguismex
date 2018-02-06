<?php
session_start();
if(empty($_SESSION['ide'])){
  header('Location: ../');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#CD5F31">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tianguis Mexico</title>
    <script type="text/javascript" src="../assets/anime-master/anime.min.js"></script>
    <script type="text/javascript" src="../assets/js/animacionesEntrada.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/semantic-ui-calendar/dist/calendar.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
    <link rel="stylesheet" href="../assets/css/rentarEstadoEstilos.css">
  </head>
  <body>
    <div class="animacion show" id="animacionA">
      <svg version="1.1" id="animacion" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="259.9px" height="170px" viewBox="0 0 250 130" enable-background="new 0 0 250 130" xml:space="preserve">
        <g class="superior">
        		<path id="uno" fill="#F8C300" d="M73.4,50.2h128.2c4.6,0,8.3-3.7,8.3-8.2c0-4.5-3.7-8.2-8.3-8.2H73.4c-4.6,0-8.3,3.7-8.3,8.2C65.1,46.6,68.8,50.2,73.4,50.2z"/>
        		<path id="dos" fill="#DC0209" d="M99.4,99.4h84c4.6,0,8.3-3.7,8.3-8.2s-3.7-8.2-8.3-8.2h-84c-4.6,0-8.3,3.7-8.3,8.2S94.8,99.4,99.4,99.4z"/>
        		<path id="tres" fill="#EE9400" d="M87.4,74.1h105.3c4.6,0,8.3-3.7,8.3-8.2c0-4.5-3.7-8.2-8.3-8.2H87.4c-4.6,0-8.3,3.7-8.3,8.2C79.2,70.5,82.9,74.1,87.4,74.1z"/>
        		<path id="cuatro" fill="#FAD100" d="M72,50.1l119.7,23.8c4.5,0.8,8.8-2.2,9.6-6.7c0.8-4.5-2.3-8.7-6.8-9.5L74.8,34c-4.5-0.8-8.8,2.2-9.6,6.7C64.4,45.1,67.5,49.3,72,50.1z"/>
        		<path id="cinco" fill="#EE9400" d="M86.1,74l96.4,25.2c4.5,0.8,8.8-2.2,9.6-6.7c0.8-4.5-2.3-8.7-6.8-9.5L88.9,57.9c-4.5-0.8-8.8,2.2-9.6,6.7C78.5,69,81.6,73.2,86.1,74z"/>
        		<path id="seis" fill="#1E120D" d="M8.3,16.4H61c4.6,0,8.3-3.7,8.3-8.2C69.2,3.7,65.5,0,61,0H8.3C3.7,0,0,3.7,0,8.2C0,12.7,3.7,16.4,8.3,16.4z"/>
        		<path id="siete" fill="#1E120D" d="M55.5,13.6L65.4,25c3,3.4,8.2,3.8,11.7,0.8c3.4-3,3.8-8.2,0.8-11.6L67.9,2.8C64.9-0.6,59.7-1,56.2,2C52.8,5,52.5,10.2,55.5,13.6z"/>
        </g>

            <ellipse class="llanta1" fill="#1E120D" cx="119.1" cy="116.9" rx="13.2" ry="13.1"/>

            <ellipse class="llanta2" fill="#1E120D" cx="165.1" cy="116.9" rx="13.2" ry="13.1"/>
      </svg>
    </div>
    <div class="linea">
    </div>
    <nav>
      <div class="logo">
        <a href="../panel/"><img src="../resources/mercadito.png" alt=""></a>

      </div>
      <ul id="opciones">
        <li><a href="../panel/">Inicio</a></li>
        <li><a class="activo" href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Vencimientos</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
      </ul>
      <a href="../php/matar.php" id="botonCerrar" class="ui orange inverted button" ontouchend="this.onclick=fix">Cerrar sesión</a>
      <div class="botonMenu" id="botonMenu">
        <div class="linea1">
        </div>
        <div class="linea2">
        </div>
        <div class="linea3">
        </div>
      </div>
    </nav>
    <aside class="cerrado">
      <ul>
        <li><a href="../panel/">Inicio</a></li>
        <li><a class="activoMovil" href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Vencimientos</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../php/matar.php">Cerrar sesión</a></li>
      </ul>
    </aside>
    <main>

      <div class="ui icon message">
        <i class="marker icon"></i>
        <div class="content">
          <div class="header">
            Ahora selecciona tu ubicación.
          </div>
          <p>Despues solo selecciona el tianguis de tu prefecencia.</p>
        </div>
      </div>
      <div class="ui segment" id="contenido">
        <h3>Ubicacion</h3>
        <select class="ui fluid normal dropdown" id="estadoSelec">
            <option value="">Selecciona un estado</option>
            <option value="0">Todo México</option>
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
        </select>
      </div>
      <div class="ui link cards" id="seleccionTianguis">

      </div>
      <input type="hidden" id="id_tianguis" value="">
      <input type="hidden" id="estado_tianguis" value="">
      <div class="pieG">
        Servicio sujeto a <a href="../resources/TerminosyCondicionesMercadito.pdf" target="_blank">terminos y condiciones</a>
      </div>
    </main>
    <div id="btnSelec">
      Siguiente
    </div>
    <div id="btnAnterior">
      <
    </div>

    <div class="ui basic modal">
      <div class="ui icon header">
        <i class="refresh icon"></i>
        Tienes locales en renta que puedes renovar.
      </div>
      <div class="content centered">
        <p>¿Deseas renovar ahora alguno de estos locales?, seras direccionado a la seccion de renovaciones para que eligas que locales renovar.</p>
      </div>
      <div class="actions">
        <div class="ui red basic cancel inverted button">
          <i class="remove icon"></i>
          No
        </div>
        <div class="ui green ok inverted button">
          <i class="checkmark icon"></i>
          Si
        </div>
      </div>
    </div>




    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-102248014-1', 'auto');
      ga('send', 'pageview');

    </script>

  </body>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
    <script src="../assets/semantic/semantic.min.js"></script>
    <script src="lata.js" charset="utf-8"></script>
    <script type="text/javascript" src="../assets/semantic-ui-calendar/dist/calendar.min.js"></script>
    <script type="text/javascript" src="../assets/js/menuJs.js"></script>
    <script src="../assets/js/seleccionEstado.js" charset="utf-8"></script>

</html>
