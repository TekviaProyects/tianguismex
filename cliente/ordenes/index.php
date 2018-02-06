<?php
include('../php/conexion.php');
session_start();
if(empty($_SESSION['ide'])){
  header('Location: ../');
}
$sentencia = "SELECT * FROM (cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local) left JOIN ordenes_pago ON cliente_locales.id_orden = ordenes_pago.id_orden WHERE id_cliente = ".$_SESSION['ide']." ORDER BY estado_pago";
$resultado = $conexionDb->personalizada($sentencia);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#CD5F31">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tianguis Mexico</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/anime-master/anime.min.js"></script>
    <script type="text/javascript" src="../assets/js/animacionesEntrada.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/semantic/semantic.min.css">

    <link rel="stylesheet" href="../assets/semantic-ui-calendar/dist/calendar.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
    <link rel="stylesheet" href="../assets/css/ordenesEstilos.css">
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
        <a href="../panel/"><img src="../resources/mercadito.png" alt=""> </a>
      </div>
      <ul id="opciones">
        <li><a href="../panel/">Inicio</a></li>
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Vencimientos</a></li>
        <li><a class="activo" href="../ordenes/">Ordenes de pago</a></li>
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
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Vencimientos</a></li>
        <li><a class="activoMovil" href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../php/matar.php">Cerrar sesión</a></li>
      </ul>
    </aside>
    <main>
        <div class="tablaWrapp">
          <table class="ui orange padded table" id="tablaOrdenes">
            <thead>
              <tr><th>No. orden</th>
              <th>Local</th>
              <th>Precio</th>
              <th>Link</th>
              <th>Estado</th>
            </tr></thead>
            <tbody>
              <?php
              $contador = 1;
              while($fila = mysqli_fetch_assoc($resultado)){

              ?>
              <tr>
                <td><?php echo $contador ?></td>
                <td><?php echo $fila['nombre_local']?></td>
                <td><?php if($fila['tipo_pago']==1){ echo "$50.00"; }elseif($fila['tipo_pago']==2){ echo "$100.00"; }elseif($fila['tipo_pago']==3){ echo "$900.00"; }?></td>
                <td>
                  <?php
                    if($fila['openpay_url']==''){
                      echo "-";
                    }else{
                      echo "<a href='".$fila['openpay_url']."' target='_blank'>".$fila['openpay_url']."</a>";
                    }
                  ?>

                </td>
                <td class="<?php if($fila['estado_pago']==0){ echo "negative";}else{echo "positive";} ?>"><?php if($fila['estado_pago']==0){ echo "Sin pago";}else{echo "Pagado";} ?></td>
              </tr>
              <?php
              $contador++;
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

    <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
    <script src="../assets/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="../assets/semantic-ui-calendar/dist/calendar.min.js"></script>
    <script type="text/javascript" src="../assets/js/menuJs.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.semanticui.min.js"></script>
    <script type="text/javascript" src="../assets/js/ordenesJs.js"></script>
    <script type="text/javascript" src="//mercaditopuertadelsol.com/livechat/php/app.php?widget-init.js"></script>

</html>
