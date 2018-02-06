<!DOCTYPE html>
<?php
     include("../php/conection.php");
     session_start();
     if(empty($_SESSION['ide'])){
     echo "<script>window.location.href = '../index.php';</script>";
     }
     $id = $_SESSION['ide'];


     $insertar0 = "select * from clientes where id_cliente='$id'";
     $consulta=mysqli_query($conexion,$insertar0);
     while ($row=mysqli_fetch_array($consulta)){

     $ife=$row['identificacion_cliente'];
     }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#CD5F31">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tianguis Mexico</title>
    <script type="text/javascript" src="../assets/anime-master/anime.min.js"></script>
    <script type="text/javascript" src="../assets/js/animacionesEntrada.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
    <link rel="stylesheet" href="../assets/css/activosEstilos.css">
    <link rel="stylesheet" href="../assets/css/estiloForm.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
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
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a class="activo" href="../rentaActiva/">Vencimientos</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
      </ul>
      <a href="../php/matar.php" id="botonCerrar" class="ui orange inverted button" ontouchend="this.onclick=fix">Cerrar sesion</a>
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
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a class="activoMovil" href="../rentaActiva/">Vencimientos</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../php/matar.php">Cerrar sesion</a></li>
      </ul>
    </aside>
    <main>

      <div class="contenedor_tabla">
      <table class="ui orange padded table dataTable no-footer" id="tablaVencimientos">
        <thead>
          <tr>
            <th>Local</th>
            <th>Fecha inicio</th>
            <th>Fecha final</th>
            <th>Estado</th>
          </tr></thead>
          <tbody>
            <?php
              include("conection.php");
                $Activos="SELECT nombre_local, fecha_inicio, fecha_pago, estado_pago FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago,fecha_inicio,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE clientes.id_cliente = $id ORDER BY estado_pago";

                $consulta=mysqli_query($conexion,$Activos);
                while ($row=mysqli_fetch_array($consulta)) {
                  $nombre_local=$row['nombre_local'];
                  $fecha_inicio=$row['fecha_inicio'];
                  $fecha_pago=$row['fecha_pago'];
                  $estado_pago=$row['estado_pago'];
                  echo "<tr>";
                  echo "<td> Local $nombre_local </td>";
                  echo "<td> <div class='fecha1'> $fecha_inicio </div> </td>";
                  echo "<td> <div class='fecha2'> $fecha_pago </div> </td>";
                  if ($estado_pago == 1) {
                    echo "<td class='positive'> Pago realizado </td>";
                  }
                  else {
                      echo " <td class='negative'>  Pago no realizado </td>";
                  }
                  echo "</tr>";
                }
             ?>
          </tbody>
        </table>
        </div>
        <div class="pieG">
          Servicio sujeto a <a href="../resources/TerminosyCondicionesMercadito.pdf" target="_blank">terminos y condiciones</a>
        </div>
    </main>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102248014-1', 'auto');
  ga('send', 'pageview');

</script>
  </body>
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/js/menuJs.js"></script>
    <script src="../assets/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="//mercaditopuertadelsol.com/livechat/php/app.php?widget-init.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.semanticui.min.js" charset="utf-8"></script>
    <script src="../assets/js/vencimientos.js" charset="utf-8"></script>
</html>
