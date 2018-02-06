<?php
include("../php/conection.php");
session_start();
if(empty($_SESSION['SUide'])){
echo "<script>window.location.href = 'index.php';</script>";
}
?>
<?php
            $insertarc1 = "SELECT * FROM cadenas WHERE id = '1'";
            $consulta1=mysqli_query($conexion,$insertarc1);
            while ($row=mysqli_fetch_array($consulta1)) {
            $cadena1=$row['cadena'];
          }
            $insertarc2 = "SELECT * FROM cadenas WHERE id = '2'";
            $consulta2=mysqli_query($conexion,$insertarc2);
            while ($row=mysqli_fetch_array($consulta2)) {
            $cadena2=$row['cadena'];
          }
                ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#CD5F31">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/semantic-ui-calendar/dist/calendar.min.css">
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
    <link rel="stylesheet" href="../assets/css/panelEstilos.css">
    <link rel="stylesheet" href="../assets/css/estiloForm.css">
    <link rel="stylesheet" href="../assets/css/superuserEstilos.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/c3-master/c3.min.css">

    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
      <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
      <script src="../assets/semantic/semantic.min.js"></script>
  </head>
  <body>
    <div class="linea">
    </div>
    <nav>
      <div class="logo">
        <img src="../resources/mercadito.png" alt="">
      </div>
      <ul id="opciones">
        <li><a href="#" id="btnLCSU">LOCALES CORRIENTE</a></li>
        <li><a href="#" id="btnLDSU">LOCALES DEUDA</a></li>
        <li><a href="#" id="btnLDISU">LOCALES DISPONIBLES</a></li>
        <li><a href="#" id="btnUSSU">USUARIOS</a></li>
        <li><a href="#" id="btnCRSU">CROQUIS</a></li>
        <li><a href="#" id="btnR">REPORTE</a></li>
        <li><a href="#" id="btnCNSU">CONFIGURACION</a></li>
      </ul>
      <a href="../php/matar.php"><button id="botonCerrar" class="ui orange inverted button">Cerrar sesion</button></a>
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
        <li><a href="#" id="btnLCSUm">LOCALES CORRIENTE</a></li>
        <li><a href="#" id="btnLDSUm">LOCALES DEUDA</a></li>
        <li><a href="#" id="btnLDISUm">LOCALES DISPONIBLES</a></li>
        <li><a href="#" id="btnUSSUm">USUARIOS</a></li>
        <li><a href="#" id="btnCRSUm">CROQUIS</a></li>
        <li><a href="#" id="btnRm">REPORTE</a></li>
        <li><a href="#" id="btnCNSUm">CONFIGURACION</a></li>
        <li><a href="../php/matar.php">Cerrar Sesión</a></li>
      </ul>
    </aside>
    <main class="maincillo">
      <section class="panelitox">
        <div class="localesCorriente" id="localesCorriente">
          <h2>LOCALES CORRIENTE</h2>
          <table class="ui orange table tablaSU">
  <thead>
    <tr>
      <th>LOCAL</th>
    <th>LOCATARIO</th>
    <th>TELEFONO</th>
    <th class="centroSU">ACCIONES</th>
  </tr>
</thead>

<tbody>
  <?php
              $fechahoy = date("Y-m-d");
			        $insertar9 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE estado_pago='1'";
              $consulta=mysqli_query($conexion,$insertar9);
              while ($row=mysqli_fetch_array($consulta)) {
              $id_local=$row['nombre_local'];
              $nombre_cliente=$row['nombre_cliente'];
              $celular_cliente=$row['celular_cliente'];
              $correo_cliente=$row['correo_cliente'];
              $domicilio_cliente=$row['domicilio_cliente'];
              $ife=$row['identificacion_cliente'];
                  echo "<tr><td>LOCAL $id_local</td>";
                  echo "<td>$nombre_cliente</td>";
                  echo "<td>$celular_cliente</td>";
                  echo "<td class='centroSU'>
                  <button type='submit' class='ui button' id='btn$id_local'><i class='fa fa-user naranja' aria-hidden='true'></i>
                  </button>
                  <script>
                  $(document).ready(function() {
                  $('#btn$id_local').click(function(){
                  $('#localito').html('LOCAL $id_local');
                  $('#nombrecito').html('$nombre_cliente');
                  $('#celularcito').html('$celular_cliente');
                  $('#correoito').html('$correo_cliente');
                  $('#direccioncita').html('$domicilio_cliente');
                  $('#imagencita').html('$cadena1$ife$cadena2');
                  $('#modalito')
                  .modal('show');
                  });
                  });
                  </script>
                  </td></tr>";
            }
                  ?>
  </tbody>
</table>
        </div>


        <div class="localesDeuda" id="localesDeuda">
          <h2>LOCALES DEUDA</h2>
          <table class="ui orange table tablaSU">
  <thead>
    <tr>
      <th>LOCAL</th>
    <th>LOCATARIO</th>
    <th>TELEFONO</th>
    <th class="centroSU">ACCIONES</th>
  </tr>
</thead>

<tbody>
  <?php
              $fechahoy = date("Y-m-d");
              $insertar2 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE estado_pago='0'";
              $consulta=mysqli_query($conexion,$insertar2);
              while ($row=mysqli_fetch_array($consulta)) {

              $id_local=$row['nombre_local'];
              $nombre_cliente=$row['nombre_cliente'];
              $celular_cliente=$row['celular_cliente'];
              $correo_cliente=$row['correo_cliente'];
              $domicilio_cliente=$row['domicilio_cliente'];
              $ife=$row['identificacion_cliente'];
              echo "<tr><td>LOCAL $id_local</td>";
              echo "<td>$nombre_cliente</td>";
              echo "<td>$celular_cliente</td>";
              echo "<td class='centroSU'>
              <button type='submit' class='ui button' id='btn$id_local'><i class='fa fa-user naranja' aria-hidden='true'></i>
              </button>
              <script>
              $(document).ready(function() {
              $('#btn$id_local').click(function(){
              $('#localito').html('LOCAL $id_local');
              $('#nombrecito').html('$nombre_cliente');
              $('#celularcito').html('$celular_cliente');
              $('#correoito').html('$correo_cliente');
              $('#direccioncita').html('$domicilio_cliente');
              $('#imagencita').html('$cadena1$ife$cadena2');
              console.log('$cadena1$ife$cadena2');
              $('#modalito')
              .modal('show');
              });
              });
              </script>
              <button type='submit' class='ui button' id='btn2$id_local'><i class='fa fa-envelope naranja' aria-hidden='true'></i>
              </button>
              <script>
              $(document).ready(function() {
              $('#btn2$id_local').click(function(){
              $('#nombrecitod').html('$nombre_cliente');
              $('#celPro1').val('$celular_cliente');
              $('#modalito4')
              .modal('show');
              });
              });
              </script></td></tr>";

            }
                  ?>
  </tbody>
</table>
        </div>


        <div class="localesDisponibles" id="localesDisponibles">
          <h2>LOCALES DISPONIBLES</h2>
          <table class="ui orange table tablaSU">
  <thead>
    <tr>
      <th>LOCAL</th>
    <th>ESTATUS</th>
    <th></th>
    <th>ACCIONES</th>
  </tr>
</thead>
<tbody>
  <?php
  $insertar3 = "SELECT * FROM locales LEFT JOIN cliente_locales ON locales.id_local = cliente_locales.id_local";
  $consulta=mysqli_query($conexion,$insertar3);
  while ($row=mysqli_fetch_array($consulta)) {
  $nombre_local=$row['nombre_local'];
  $id_orden=$row['id_orden'];

      if($id_orden == ''){
      echo "<tr><td>LOCAL $nombre_local</td>";
      echo "<td><label class='ui primary button'>DISPONIBLE</label></td>";
      echo "<td></td>";
      echo "<td class='centroSU'><button id='pro$nombre_local' class='ui orange button'>PROMOCIONAR</button>
      <script>
      $(document).ready(function() {
      $('#pro$nombre_local').click(function(){
      $('#celPro').val('');
      $('#txtPro').val('');
      $('#localprom').html('ENVIAR MENSAJE PARA PROMOCIONAR EL LOCAL $nombre_local');
      $('#modalito5')
      .modal('show');
      });
      });
      </script></td></tr>";

    }else {

    }
    }
      ?>
  </tbody>
</table>
        </div>

        <div class="usuarios" id="usuarios">
          <h2>USUARIOS</h2>
          <table class="ui orange table tablaSU">
  <thead>
    <tr>
      <th>NOMBRE</th>
    <th>CELULAR</th>
    <th>CORREO</th>
    <th>DOMICILIO</th>
    <th class='centroSU'>EDITAR</th>
  </tr>
</thead>

<tbody>
  <?php
       $insertar0 = "select * from clientes";
       $consulta=mysqli_query($conexion,$insertar0);
       while ($row=mysqli_fetch_array($consulta)){
       $id=$row['id_cliente'];
       $nombre=$row['nombre_cliente'];
       $celular=$row['celular_cliente'];
       $correo=$row['correo_cliente'];
       $domicilio=$row['domicilio_cliente'];
       $ife=$row['identificacion_cliente'];
       $archivo = substr("$ife", 22);
       echo "<tr><td>$nombre</td>";
       echo "<td>$celular</td>";
       echo "<td>$correo</td>";
       echo "<td>$domicilio</td>";
       echo "<td><button class='ui primary button' id='btnClientitos$id'>EDITAR</button>
       <script>
       $(document).ready(function() {
       $('#btnClientitos$id').click(function(){
       $('#nombre').val('$nombre');
       $('#celular').val('$celular');
       $('#correo').val('$correo');
       $('#domicilio').val('$domicilio');
       $('#ife1').val('$archivo');
       $('#ifecita').val('$ife');
       $('#id').val('$id');
       $('#modalito3')
       .modal('show')
       });
       });
       </script></td></tr>";
       }
  ?>
  </tbody>
</table>
        </div>

        <div class="croquis" id="croquis">
          <h2>CROQUIS</h2>
          <div class="croquis1">
            <svg id="svgCroquis"  viewBox="0 0 1160 260" >
              <g onClick="prueba(this)" id="271" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="0" width="20" height="20"></rect>
                <text x="129" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">271</text>
              </g>
              <g onClick="prueba(this)" id="272" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="0" width="20" height="20"></rect>
                <text x="149" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">272</text>
              </g>
              <g onClick="prueba(this)" id="273" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="0" width="20" height="20"></rect>
                <text x="169" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">273</text>
              </g>
              <g onClick="prueba(this)" id="274" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="0" width="20" height="20"></rect>
                <text x="189" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">274</text>
              </g>
              <g onClick="prueba(this)" id="275" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="0" width="20" height="20"></rect>
                <text x="209" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">275</text>
              </g>
              <g onClick="prueba(this)" id="276" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="0" width="20" height="20"></rect>
                <text x="229" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">276</text>
              </g>
              <g onClick="prueba(this)" id="277" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="0" width="20" height="20"></rect>
                <text x="249" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">277</text>
              </g>
              <g onClick="prueba(this)" id="278" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="0" width="20" height="20"></rect>
                <text x="269" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">278</text>
              </g>
              <g onClick="prueba(this)" id="279" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="0" width="20" height="20"></rect>
                <text x="289" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">279</text>
              </g>
              <g onClick="prueba(this)" id="280" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="0" width="20" height="20"></rect>
                <text x="309" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">280</text>
              </g>
              <g onClick="prueba(this)" id="281" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="0" width="20" height="20"></rect>
                <text x="329" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">281</text>
              </g>
              <g onClick="prueba(this)" id="282" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="0" width="20" height="20"></rect>
                <text x="349" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">282</text>
              </g>
              <g onClick="prueba(this)" id="283" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="0" width="20" height="20"></rect>
                <text x="369" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">283</text>
              </g>
              <g onClick="prueba(this)" id="286" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="80" y="20" width="20" height="20"></rect>
                <text x="89" y="32" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">286</text>
              </g>
              <g onClick="prueba(this)" id="285" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="100" y="20" width="20" height="20"></rect>
                <text x="109" y="32" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">285</text>
              </g>
              <g onClick="prueba(this)" id="284" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="20" width="20" height="20"></rect>
                <text x="129" y="32" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">284</text>
              </g>
              <g onClick="prueba(this)" id="289" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="60" y="40" width="20" height="20"></rect>
                <text x="69" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">289</text>
              </g>
              <g onClick="prueba(this)" id="288" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="40" y="40" width="20" height="20"></rect>
                <text x="49" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">288</text>
              </g>
              <g onClick="prueba(this)" id="287" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="20" y="40" width="20" height="20"></rect>
                <text x="29" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">287</text>
              </g>
              <g onClick="prueba(this)" id="290" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="40" width="20" height="20"></rect>
                <text x="169" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">290</text>
              </g>
              <g onClick="prueba(this)" id="291" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="40" width="20" height="20"></rect>
                <text x="189" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">291</text>
              </g>
              <g onClick="prueba(this)" id="292" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="40" width="20" height="20"></rect>
                <text x="209" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">292</text>
              </g>
              <g onClick="prueba(this)" id="293" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="40" width="20" height="20"></rect>
                <text x="229" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">293</text>
              </g>
              <g onClick="prueba(this)" id="294" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="40" width="20" height="20"></rect>
                <text x="249" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">294</text>
              </g>
              <g onClick="prueba(this)" id="295" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="40" width="20" height="20"></rect>
                <text x="269" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">295</text>
              </g>
              <g onClick="prueba(this)" id="296" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="40" width="20" height="20"></rect>
                <text x="289" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">296</text>
              </g>
              <g onClick="prueba(this)" id="297" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="40" width="20" height="20"></rect>
                <text x="309" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">297</text>
              </g>
              <g onClick="prueba(this)" id="298" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="40" width="20" height="20"></rect>
                <text x="329" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">298</text>
              </g>
              <g onClick="prueba(this)" id="299" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="40" width="20" height="20"></rect>
                <text x="349" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">299</text>
              </g>
              <g onClick="prueba(this)" id="300" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="40" width="20" height="20"></rect>
                <text x="369" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">300</text>
              </g>
              <g onClick="prueba(this)" id="314" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="60" width="20" height="20"></rect>
                <text x="9" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">314</text>
              </g>
              <g onClick="prueba(this)" id="313" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="60" width="20" height="20"></rect>
                <text x="129" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">313</text>
              </g>
              <g onClick="prueba(this)" id="312" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="60" width="20" height="20"></rect>
                <text x="149" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">312</text>
              </g>
              <g onClick="prueba(this)" id="311" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="60" width="20" height="20"></rect>
                <text x="169" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">311</text>
              </g>
              <g onClick="prueba(this)" id="310" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="60" width="20" height="20"></rect>
                <text x="189" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">310</text>
              </g>
              <g onClick="prueba(this)" id="309" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="60" width="20" height="20"></rect>
                <text x="209" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">309</text>
              </g>
              <g onClick="prueba(this)" id="308" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="60" width="20" height="20"></rect>
                <text x="229" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">308</text>
              </g>
              <g onClick="prueba(this)" id="307" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="60" width="20" height="20"></rect>
                <text x="249" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">307</text>
              </g>
              <g onClick="prueba(this)" id="306" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="60" width="20" height="20"></rect>
                <text x="269" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">306</text>
              </g>
              <g onClick="prueba(this)" id="305" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="60" width="20" height="20"></rect>
                <text x="289" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">305</text>
              </g>
              <g onClick="prueba(this)" id="304" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="60" width="20" height="20"></rect>
                <text x="309" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">304</text>
              </g>
              <g onClick="prueba(this)" id="303" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="60" width="20" height="20"></rect>
                <text x="329" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">303</text>
              </g>
              <g onClick="prueba(this)" id="302" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="60" width="20" height="20"></rect>
                <text x="349" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">302</text>
              </g>
              <g onClick="prueba(this)" id="301" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="60" width="20" height="20"></rect>
                <text x="369" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">301</text>
              </g>
              <g onClick="prueba(this)" id="315" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="80" width="20" height="20"></rect>
                <text x="9" y="92" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">315</text>
              </g>
              <g onClick="prueba(this)" id="316" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="100" width="20" height="20"></rect>
                <text x="9" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">316</text>
              </g>
              <g onClick="prueba(this)" id="333" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="40" y="100" width="20" height="20"></rect>
                <text x="49" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">333</text>
              </g>
              <g onClick="prueba(this)" id="332" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="60" y="100" width="20" height="20"></rect>
                <text x="69" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">332</text>
              </g>
              <g onClick="prueba(this)" id="331" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="80" y="100" width="20" height="20"></rect>
                <text x="89" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">331</text>
              </g>
              <g onClick="prueba(this)" id="330" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="100" y="100" width="20" height="20"></rect>
                <text x="109" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">330</text>
              </g>
              <g onClick="prueba(this)" id="329" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="100" width="20" height="20"></rect>
                <text x="129" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">329</text>
              </g>
              <g onClick="prueba(this)" id="328" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="100" width="20" height="20"></rect>
                <text x="149" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">328</text>
              </g>
              <g onClick="prueba(this)" id="327" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="100" width="20" height="20"></rect>
                <text x="169" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">327</text>
              </g>
              <g onClick="prueba(this)" id="326" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="100" width="20" height="20"></rect>
                <text x="189" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">326</text>
              </g>
              <g onClick="prueba(this)" id="325" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="100" width="20" height="20"></rect>
                <text x="209" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">325</text>
              </g>
              <g onClick="prueba(this)" id="324" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="100" width="20" height="20"></rect>
                <text x="229" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">324</text>
              </g>
              <g onClick="prueba(this)" id="323" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="100" width="20" height="20"></rect>
                <text x="249" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">323</text>
              </g>
              <g onClick="prueba(this)" id="322" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="100" width="20" height="20"></rect>
                <text x="269" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">322</text>
              </g>
              <g onClick="prueba(this)" id="321" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="100" width="20" height="20"></rect>
                <text x="289" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">321</text>
              </g>
              <g onClick="prueba(this)" id="320" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="100" width="20" height="20"></rect>
                <text x="309" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">320</text>
              </g>
              <g onClick="prueba(this)" id="319" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="100" width="20" height="20"></rect>
                <text x="329" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">319</text>
              </g>
              <g onClick="prueba(this)" id="318" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="100" width="20" height="20"></rect>
                <text x="349" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">318</text>
              </g>
              <g onClick="prueba(this)" id="317" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="100" width="20" height="20"></rect>
                <text x="369" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">317</text>
              </g>
              <g onClick="prueba(this)" id="334" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="120" width="20" height="20"></rect>
                <text x="9" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">334</text>
              </g>
              <g onClick="prueba(this)" id="335" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="40" y="120" width="20" height="20"></rect>
                <text x="49" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">335</text>
              </g>
              <g onClick="prueba(this)" id="336" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="60" y="120" width="20" height="20"></rect>
                <text x="69" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">336</text>
              </g>
              <g onClick="prueba(this)" id="337" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="80" y="120" width="20" height="20"></rect>
                <text x="89" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">337</text>
              </g>
              <g onClick="prueba(this)" id="338" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="100" y="120" width="20" height="20"></rect>
                <text x="109" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">338</text>
              </g>
              <g onClick="prueba(this)" id="339" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="120" width="20" height="20"></rect>
                <text x="129" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">339</text>
              </g>
              <g onClick="prueba(this)" id="340" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="120" width="20" height="20"></rect>
                <text x="149" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">340</text>
              </g>
              <g onClick="prueba(this)" id="341" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="120" width="20" height="20"></rect>
                <text x="169" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">341</text>
              </g>
              <g onClick="prueba(this)" id="342" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="120" width="20" height="20"></rect>
                <text x="189" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">342</text>
              </g>
              <g onClick="prueba(this)" id="343" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="120" width="20" height="20"></rect>
                <text x="209" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">343</text>
              </g>
              <g onClick="prueba(this)" id="344" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="120" width="20" height="20"></rect>
                <text x="229" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">344</text>
              </g>
              <g onClick="prueba(this)" id="345" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="120" width="20" height="20"></rect>
                <text x="249" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">345</text>
              </g>
              <g onClick="prueba(this)" id="346" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="120" width="20" height="20"></rect>
                <text x="269" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">346</text>
              </g>
              <g onClick="prueba(this)" id="347" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="120" width="20" height="20"></rect>
                <text x="289" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">347</text>
              </g>
              <g onClick="prueba(this)" id="348" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="120" width="20" height="20"></rect>
                <text x="309" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">348</text>
              </g>
              <g onClick="prueba(this)" id="349" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="120" width="20" height="20"></rect>
                <text x="329" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">349</text>
              </g>
              <g onClick="prueba(this)" id="350" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="120" width="20" height="20"></rect>
                <text x="349" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">350</text>
              </g>
              <g onClick="prueba(this)" id="351" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="120" width="20" height="20"></rect>
                <text x="369" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">351</text>
              </g>
              <g onClick="prueba(this)" id="352" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="140" width="20" height="20"></rect>
                <text x="9" y="152" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">352</text>
              </g>
              <g onClick="prueba(this)" id="370" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="160" width="20" height="20"></rect>
                <text x="9" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">370</text>
              </g>
              <g onClick="prueba(this)" id="369" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="40" y="160" width="20" height="20"></rect>
                <text x="49" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">369</text>
              </g>
              <g onClick="prueba(this)" id="368" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="60" y="160" width="20" height="20"></rect>
                <text x="69" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">368</text>
              </g>
              <g onClick="prueba(this)" id="367" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="80" y="160" width="20" height="20"></rect>
                <text x="89" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">367</text>
              </g>
              <g onClick="prueba(this)" id="366" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="100" y="160" width="20" height="20"></rect>
                <text x="109" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">366</text>
              </g>
              <g onClick="prueba(this)" id="365" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="160" width="20" height="20"></rect>
                <text x="129" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">365</text>
              </g>
              <g onClick="prueba(this)" id="364" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="160" width="20" height="20"></rect>
                <text x="149" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">364</text>
              </g>
              <g onClick="prueba(this)" id="363" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="160" width="20" height="20"></rect>
                <text x="169" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">363</text>
              </g>
              <g onClick="prueba(this)" id="362" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="160" width="20" height="20"></rect>
                <text x="189" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">362</text>
              </g>
              <g onClick="prueba(this)" id="361" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="160" width="20" height="20"></rect>
                <text x="209" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">361</text>
              </g>
              <g onClick="prueba(this)" id="360" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="160" width="20" height="20"></rect>
                <text x="229" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">360</text>
              </g>
              <g onClick="prueba(this)" id="359" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="160" width="20" height="20"></rect>
                <text x="249" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">359</text>
              </g>
              <g onClick="prueba(this)" id="358" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="160" width="20" height="20"></rect>
                <text x="269" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">358</text>
              </g>
              <g onClick="prueba(this)" id="357" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="160" width="20" height="20"></rect>
                <text x="289" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">357</text>
              </g>
              <g onClick="prueba(this)" id="356" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="160" width="20" height="20"></rect>
                <text x="309" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">356</text>
              </g>
              <g onClick="prueba(this)" id="355" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="160" width="20" height="20"></rect>
                <text x="329" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">355</text>
              </g>
              <g onClick="prueba(this)" id="354" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="160" width="20" height="20"></rect>
                <text x="349" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">354</text>
              </g>
              <g onClick="prueba(this)" id="353" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="160" width="20" height="20"></rect>
                <text x="369" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">353</text>
              </g>
              <g onClick="prueba(this)" id="371" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="180" width="20" height="20"></rect>
                <text x="9" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">371</text>
              </g>
              <g onClick="prueba(this)" id="372" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="40" y="180" width="20" height="20"></rect>
                <text x="49" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">372</text>
              </g>
              <g onClick="prueba(this)" id="373" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="60" y="180" width="20" height="20"></rect>
                <text x="69" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">373</text>
              </g>
              <g onClick="prueba(this)" id="374" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="80" y="180" width="20" height="20"></rect>
                <text x="89" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">374</text>
              </g>
              <g onClick="prueba(this)" id="375" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="100" y="180" width="20" height="20"></rect>
                <text x="109" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">375</text>
              </g>
              <g onClick="prueba(this)" id="376" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="180" width="20" height="20"></rect>
                <text x="129" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">376</text>
              </g>
              <g onClick="prueba(this)" id="377" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="180" width="20" height="20"></rect>
                <text x="149" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">377</text>
              </g>
              <g onClick="prueba(this)" id="378" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="180" width="20" height="20"></rect>
                <text x="169" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">378</text>
              </g>
              <g onClick="prueba(this)" id="379" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="180" width="20" height="20"></rect>
                <text x="189" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">379</text>
              </g>
              <g onClick="prueba(this)" id="380" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="180" width="20" height="20"></rect>
                <text x="209" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">380</text>
              </g>
              <g onClick="prueba(this)" id="381" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="180" width="20" height="20"></rect>
                <text x="229" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">381</text>
              </g>
              <g onClick="prueba(this)" id="382" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="180" width="20" height="20"></rect>
                <text x="249" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">382</text>
              </g>
              <g onClick="prueba(this)" id="383" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="180" width="20" height="20"></rect>
                <text x="269" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">383</text>
              </g>
              <g onClick="prueba(this)" id="384" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="180" width="20" height="20"></rect>
                <text x="289" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">384</text>
              </g>
              <g onClick="prueba(this)" id="385" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="180" width="20" height="20"></rect>
                <text x="309" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">385</text>
              </g>
              <g onClick="prueba(this)" id="386" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="180" width="20" height="20"></rect>
                <text x="329" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">386</text>
              </g>
              <g onClick="prueba(this)" id="387" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="180" width="20" height="20"></rect>
                <text x="349" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">387</text>
              </g>
              <g onClick="prueba(this)" id="388" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="180" width="20" height="20"></rect>
                <text x="369" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">388</text>
              </g>
              <g onClick="prueba(this)" id="389" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="360" y="220" width="20" height="20"></rect>
                <text x="369" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">389</text>
              </g>
              <g onClick="prueba(this)" id="390" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="340" y="220" width="20" height="20"></rect>
                <text x="349" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">390</text>
              </g>
              <g onClick="prueba(this)" id="391" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="320" y="220" width="20" height="20"></rect>
                <text x="329" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">391</text>
              </g>
              <g onClick="prueba(this)" id="392" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="300" y="220" width="20" height="20"></rect>
                <text x="309" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">392</text>
              </g>
              <g onClick="prueba(this)" id="393" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="280" y="220" width="20" height="20"></rect>
                <text x="289" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">393</text>
              </g>
              <g onClick="prueba(this)" id="394" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="260" y="220" width="20" height="20"></rect>
                <text x="269" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">394</text>
              </g>
              <g onClick="prueba(this)" id="395" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="240" y="220" width="20" height="20"></rect>
                <text x="249" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">395</text>
              </g>
              <g onClick="prueba(this)" id="396" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="220" y="220" width="20" height="20"></rect>
                <text x="229" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">396</text>
              </g>
              <g onClick="prueba(this)" id="397" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="200" y="220" width="20" height="20"></rect>
                <text x="209" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">397</text>
              </g>
              <g onClick="prueba(this)" id="398" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="180" y="220" width="20" height="20"></rect>
                <text x="189" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">398</text>
              </g>
              <g onClick="prueba(this)" id="399" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="160" y="220" width="20" height="20"></rect>
                <text x="169" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">399</text>
              </g>
              <g onClick="prueba(this)" id="400" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="140" y="220" width="20" height="20"></rect>
                <text x="149" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">400</text>
              </g>
              <g onClick="prueba(this)" id="401" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="120" y="220" width="20" height="20"></rect>
                <text x="129" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">401</text>
              </g>
              <g onClick="prueba(this)" id="402" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="100" y="220" width="20" height="20"></rect>
                <text x="109" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">402</text>
              </g>
              <g onClick="prueba(this)" id="403" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="80" y="220" width="20" height="20"></rect>
                <text x="89" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">403</text>
              </g>
              <g onClick="prueba(this)" id="404" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="60" y="220" width="20" height="20"></rect>
                <text x="69" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">404</text>
              </g>
              <g onClick="prueba(this)" id="405" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="0" y="220" width="20" height="20"></rect>
                <text x="9" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">405</text>
              </g>









              <g id="juegos" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="380" y="0" width="20" height="240"></rect>
                <text style="writing-mode: tb;" x="390" y="50%" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">Juegos171</text>
              </g>
              <g stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="0" width="20" height="20"></rect>
              </g>
              <g onClick="prueba(this)" id="71" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="40" width="20" height="20"></rect>
                <text x="409" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">71</text>
              </g>
              <g onClick="prueba(this)" id="72" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="60" width="20" height="20"></rect>
                <text x="409" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">72</text>
              </g>
              <g onClick="prueba(this)" id="141" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="100" width="20" height="20"></rect>
                <text x="409" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">141</text>
              </g>
              <g onClick="prueba(this)" id="142" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="120" width="20" height="20"></rect>
                <text x="409" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">142</text>
              </g>
              <g onClick="prueba(this)" id="206" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="160" width="20" height="20"></rect>
                <text x="409" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">206</text>
              </g>
              <g onClick="prueba(this)" id="207" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="180" width="20" height="20"></rect>
                <text x="409" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">207</text>
              </g>
              <g onClick="prueba(this)" id="208" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="200" width="20" height="20"></rect>
                <text x="409" y="212" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">208</text>
              </g>
              <g stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="400" y="220" width="40" height="20"></rect>
              </g>
              <g onClick="prueba(this)" id="1" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="420" y="0" width="20" height="20"></rect>
                <text x="429" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">1</text>
              </g>
              <g onClick="prueba(this)" id="140" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="420" y="100" width="20" height="20"></rect>
                <text x="429" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">140</text>
              </g>
              <g onClick="prueba(this)" id="143" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="420" y="120" width="20" height="20"></rect>
                <text x="429" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">143</text>
              </g>
              <g onClick="prueba(this)" id="2" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="0" width="20" height="20"></rect>
                <text x="449" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">2</text>
              </g>
              <g onClick="prueba(this)" id="3" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="460" y="0" width="20" height="20"></rect>
                <text x="469" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">3</text>
              </g>
              <g onClick="prueba(this)" id="4" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="480" y="0" width="20" height="20"></rect>
                <text x="489" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">4</text>
              </g>
              <g onClick="prueba(this)" id="5" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="500" y="0" width="20" height="20"></rect>
                <text x="509" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">5</text>
              </g>
              <g onClick="prueba(this)" id="6" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="520" y="0" width="20" height="20"></rect>
                <text x="529" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">6</text>
              </g>
              <g onClick="prueba(this)" id="7" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="0" width="20" height="20"></rect>
                <text x="549" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">7</text>
              </g>
              <g onClick="prueba(this)" id="8" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="560" y="0" width="20" height="20"></rect>
                <text x="569" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">8</text>
              </g>
              <g onClick="prueba(this)" id="9" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="580" y="0" width="20" height="20"></rect>
                <text x="589" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">9</text>
              </g>
              <g onClick="prueba(this)" id="10" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="600" y="0" width="20" height="20"></rect>
                <text x="609" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">10</text>
              </g>
              <g onClick="prueba(this)" id="11" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="620" y="0" width="20" height="20"></rect>
                <text x="629" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">11</text>
              </g>
              <g onClick="prueba(this)" id="12" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="0" width="20" height="20"></rect>
                <text x="649" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">12</text>
              </g>
              <g onClick="prueba(this)" id="13" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="0" width="20" height="20"></rect>
                <text x="669" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">13</text>
              </g>
              <g onClick="prueba(this)" id="14" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="0" width="20" height="20"></rect>
                <text x="689" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">14</text>
              </g>
              <g onClick="prueba(this)" id="15" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="0" width="20" height="20"></rect>
                <text x="709" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">15</text>
              </g>
              <g onClick="prueba(this)" id="16" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="0" width="20" height="20"></rect>
                <text x="729" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">16</text>
              </g>
              <g onClick="prueba(this)" id="17" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="740" y="0" width="20" height="20"></rect>
                <text x="749" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">17</text>
              </g>
              <g onClick="prueba(this)" id="18" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="780" y="0" width="20" height="20"></rect>
                <text x="789" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">18</text>
              </g>
              <g onClick="prueba(this)" id="19" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="0" width="20" height="20"></rect>
                <text x="809" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">19</text>
              </g>
              <g onClick="prueba(this)" id="20" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="0" width="20" height="20"></rect>
                <text x="829" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">20</text>
              </g>
              <g onClick="prueba(this)" id="21" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="0" width="20" height="20"></rect>
                <text x="849" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">21</text>
              </g>
              <g onClick="prueba(this)" id="22" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="0" width="20" height="20"></rect>
                <text x="869" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">22</text>
              </g>
              <g onClick="prueba(this)" id="23" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="0" width="20" height="20"></rect>
                <text x="889" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">23</text>
              </g>
              <g onClick="prueba(this)" id="24" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="0" width="20" height="20"></rect>
                <text x="909" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">24</text>
              </g>
              <g onClick="prueba(this)" id="25" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="920" y="0" width="20" height="20"></rect>
                <text x="929" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">25</text>
              </g>
              <g onClick="prueba(this)" id="26" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="940" y="0" width="20" height="20"></rect>
                <text x="949" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">26</text>
              </g>
              <g onClick="prueba(this)" id="27" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="960" y="0" width="20" height="20"></rect>
                <text x="969" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">27</text>
              </g>
              <g onClick="prueba(this)" id="28" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="980" y="0" width="20" height="20"></rect>
                <text x="989" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">28</text>
              </g>
              <g onClick="prueba(this)" id="29" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="0" width="20" height="20"></rect>
                <text x="1009" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">29</text>
              </g>
              <g onClick="prueba(this)" id="30" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="0" width="20" height="20"></rect>
                <text x="1029" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">30</text>
              </g>
              <g onClick="prueba(this)" id="31" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="0" width="20" height="20"></rect>
                <text x="1049" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">31</text>
              </g>
              <g onClick="prueba(this)" id="32" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="0" width="20" height="20"></rect>
                <text x="1069" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">32</text>
              </g>
              <g onClick="prueba(this)" id="33" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="0" width="20" height="20"></rect>
                <text x="1089" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">33</text>
              </g>
              <g onClick="prueba(this)" id="34" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="0" width="20" height="20"></rect>
                <text x="1109" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">34</text>
              </g>
              <g onClick="prueba(this)" id="35" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1120" y="0" width="20" height="20"></rect>
                <text x="1129" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">35</text>
              </g>
              <g onClick="prueba(this)" id="36" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="0" width="20" height="20"></rect>
                <text x="1149" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">36</text>
              </g>

              <g onClick="prueba(this)" id="70" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="40" width="20" height="20"></rect>
                <text x="449" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">70</text>
              </g>
              <g onClick="prueba(this)" id="69" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="460" y="40" width="20" height="20"></rect>
                <text x="469" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">69</text>
              </g>
              <g onClick="prueba(this)" id="68" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="480" y="40" width="20" height="20"></rect>
                <text x="489" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">68</text>
              </g>
              <g onClick="prueba(this)" id="67" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="500" y="40" width="20" height="20"></rect>
                <text x="509" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">67</text>
              </g>
              <a href="#" id='66'><g id="66" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="520" y="40" width="20" height="20"></rect>
                <text x="529" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">66</text>
              </g></a>
              <g onClick="prueba(this)" id="65" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="40" width="20" height="20"></rect>
                <text x="549" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">65</text>
              </g>
              <g onClick="prueba(this)" id="64" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="560" y="40" width="20" height="20"></rect>
                <text x="569" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">64</text>
              </g>
              <g onClick="prueba(this)" id="63" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="580" y="40" width="20" height="20"></rect>
                <text x="589" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">63</text>
              </g>
              <g onClick="prueba(this)" id="62" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="600" y="40" width="20" height="20"></rect>
                <text x="609" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">62</text>
              </g>
              <g onClick="prueba(this)" id="61" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="620" y="40" width="20" height="20"></rect>
                <text x="629" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">61</text>
              </g>
              <g onClick="prueba(this)" id="60" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="40" width="20" height="20"></rect>
                <text x="649" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">60</text>
              </g>
              <g onClick="prueba(this)" id="59" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="40" width="20" height="20"></rect>
                <text x="669" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">59</text>
              </g>
              <g onClick="prueba(this)" id="58" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="40" width="20" height="20"></rect>
                <text x="689" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">58</text>
              </g>
              <g onClick="prueba(this)" id="57" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="40" width="20" height="20"></rect>
                <text x="709" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">57</text>
              </g>
              <g onClick="prueba(this)" id="56" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="40" width="20" height="20"></rect>
                <text x="729" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">56</text>
              </g>
              <g onClick="prueba(this)" id="55" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="740" y="40" width="20" height="20"></rect>
                <text x="749" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">55</text>
              </g>
              <g stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="760" y="40" width="20" height="40"></rect>
              </g>
              <g onClick="prueba(this)" id="54" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="780" y="40" width="20" height="20"></rect>
                <text x="789" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">54</text>
              </g>
              <g onClick="prueba(this)" id="53" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="40" width="20" height="20"></rect>
                <text x="809" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">53</text>
              </g>
              <g onClick="prueba(this)" id="52" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="40" width="20" height="20"></rect>
                <text x="829" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">52</text>
              </g>
              <g onClick="prueba(this)" id="51" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="40" width="20" height="20"></rect>
                <text x="849" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">51</text>
              </g>
              <g onClick="prueba(this)" id="50" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="40" width="20" height="20"></rect>
                <text x="869" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">50</text>
              </g>
              <g onClick="prueba(this)" id="49" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="40" width="20" height="20"></rect>
                <text x="889" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">49</text>
              </g>
              <g onClick="prueba(this)" id="48" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="40" width="20" height="20"></rect>
                <text x="909" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">48</text>
              </g>
              <g onClick="prueba(this)" id="47" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="920" y="40" width="20" height="20"></rect>
                <text x="929" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">47</text>
              </g>
              <g onClick="prueba(this)" id="46" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="940" y="40" width="20" height="20"></rect>
                <text x="949" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">46</text>
              </g>
              <g onClick="prueba(this)" id="45" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="960" y="40" width="20" height="20"></rect>
                <text x="969" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">45</text>
              </g>
              <g onClick="prueba(this)" id="44" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="980" y="40" width="20" height="20"></rect>
                <text x="989" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">44</text>
              </g>
              <g onClick="prueba(this)" id="43" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="40" width="20" height="20"></rect>
                <text x="1009" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">43</text>
              </g>
              <g onClick="prueba(this)" id="42" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="40" width="20" height="20"></rect>
                <text x="1029" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">42</text>
              </g>
              <g onClick="prueba(this)" id="41" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="40" width="20" height="20"></rect>
                <text x="1049" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">41</text>
              </g>
              <g onClick="prueba(this)" id="40" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="40" width="20" height="20"></rect>
                <text x="1069" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">40</text>
              </g>
              <g onClick="prueba(this)" id="39" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="40" width="20" height="20"></rect>
                <text x="1089" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">39</text>
              </g>
              <g onClick="prueba(this)" id="38" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="40" width="20" height="20"></rect>
                <text x="1109" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">38</text>
              </g>
              <g onClick="prueba(this)" id="37" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="40" width="20" height="20"></rect>
                <text x="1149" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">37</text>
              </g>

              <g onClick="prueba(this)" id="73" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="60" width="20" height="20"></rect>
                <text x="449" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">73</text>
              </g>
              <g onClick="prueba(this)" id="74" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="460" y="60" width="20" height="20"></rect>
                <text x="469" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">74</text>
              </g>
              <g onClick="prueba(this)" id="75" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="480" y="60" width="20" height="20"></rect>
                <text x="489" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">75</text>
              </g>
              <g onClick="prueba(this)" id="76" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="500" y="60" width="20" height="20"></rect>
                <text x="509" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">76</text>
              </g>
              <g onClick="prueba(this)" id="77" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="520" y="60" width="20" height="20"></rect>
                <text x="529" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">77</text>
              </g>
              <g onClick="prueba(this)" id="78" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="60" width="20" height="20"></rect>
                <text x="549" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">78</text>
              </g>
              <g onClick="prueba(this)" id="79" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="560" y="60" width="20" height="20"></rect>
                <text x="569" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">79</text>
              </g>
              <a href="#" id="80"><g id="80" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="580" y="60" width="20" height="20"></rect>
                <text x="589" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">80</text>
              </g></a>
              <g onClick="prueba(this)" id="81" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="600" y="60" width="20" height="20"></rect>
                <text x="609" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">81</text>
              </g>
              <g onClick="prueba(this)" id="82" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="620" y="60" width="20" height="20"></rect>
                <text x="629" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">82</text>
              </g>
              <g onClick="prueba(this)" id="83" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="60" width="20" height="20"></rect>
                <text x="649" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">83</text>
              </g>
              <g onClick="prueba(this)" id="84" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="60" width="20" height="20"></rect>
                <text x="669" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">84</text>
              </g>
              <g onClick="prueba(this)" id="85" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="60" width="20" height="20"></rect>
                <text x="689" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">85</text>
              </g>
              <g onClick="prueba(this)" id="86" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="60" width="20" height="20"></rect>
                <text x="709" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">86</text>
              </g>
              <g onClick="prueba(this)" id="87" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="60" width="20" height="20"></rect>
                <text x="729" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">87</text>
              </g>
              <g onClick="prueba(this)" id="88" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="740" y="60" width="20" height="20"></rect>
                <text x="749" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">88</text>
              </g>
              <g onClick="prueba(this)" id="89" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="780" y="60" width="20" height="20"></rect>
                <text x="789" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">89</text>
              </g>
              <g onClick="prueba(this)" id="90" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="60" width="20" height="20"></rect>
                <text x="809" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">90</text>
              </g>
              <g onClick="prueba(this)" id="91" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="60" width="20" height="20"></rect>
                <text x="829" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">91</text>
              </g>
              <g onClick="prueba(this)" id="92" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="60" width="20" height="20"></rect>
                <text x="849" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">92</text>
              </g>
              <g onClick="prueba(this)" id="93" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="60" width="20" height="20"></rect>
                <text x="869" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">93</text>
              </g>
              <g onClick="prueba(this)" id="94" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="60" width="20" height="20"></rect>
                <text x="889" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">94</text>
              </g>
              <g onClick="prueba(this)" id="95" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="60" width="20" height="20"></rect>
                <text x="909" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">95</text>
              </g>
              <g onClick="prueba(this)" id="96" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="920" y="60" width="20" height="20"></rect>
                <text x="929" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">96</text>
              </g>
              <g onClick="prueba(this)" id="97" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="940" y="60" width="20" height="20"></rect>
                <text x="949" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">97</text>
              </g>
              <g onClick="prueba(this)" id="98" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="960" y="60" width="20" height="20"></rect>
                <text x="969" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">98</text>
              </g>
              <g onClick="prueba(this)" id="99" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="980" y="60" width="20" height="20"></rect>
                <text x="989" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">99</text>
              </g>
              <g onClick="prueba(this)" id="100" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="60" width="20" height="20"></rect>
                <text x="1009" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">100</text>
              </g>
              <g onClick="prueba(this)" id="101" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="60" width="20" height="20"></rect>
                <text x="1029" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">101</text>
              </g>
              <g onClick="prueba(this)" id="102" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="60" width="20" height="20"></rect>
                <text x="1049" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">102</text>
              </g>
              <g onClick="prueba(this)" id="103" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="60" width="20" height="20"></rect>
                <text x="1069" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">103</text>
              </g>
              <g onClick="prueba(this)" id="104" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="60" width="20" height="20"></rect>
                <text x="1089" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">104</text>
              </g>
              <g onClick="prueba(this)" id="105" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="60" width="20" height="20"></rect>
                <text x="1109" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">105</text>
              </g>
              <g onClick="prueba(this)" id="106" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="60" width="20" height="20"></rect>
                <text x="1149" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">106</text>
              </g>
              <g onClick="prueba(this)" id="107" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="80" width="20" height="20"></rect>
                <text x="1149" y="92" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">107</text>
              </g>

              <g onClick="prueba(this)" id="139" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="100" width="20" height="20"></rect>
                <text x="449" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">139</text>
              </g>
              <g onClick="prueba(this)" id="138" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="460" y="100" width="20" height="20"></rect>
                <text x="469" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">138</text>
              </g>
              <g onClick="prueba(this)" id="137" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="480" y="100" width="20" height="20"></rect>
                <text x="489" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">137</text>
              </g>
              <g onClick="prueba(this)" id="136" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="500" y="100" width="20" height="20"></rect>
                <text x="509" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">136</text>
              </g>
              <g onClick="prueba(this)" id="135" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="520" y="100" width="20" height="20"></rect>
                <text x="529" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">135</text>
              </g>
              <g onClick="prueba(this)" id="134" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="100" width="20" height="20"></rect>
                <text x="549" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">134</text>
              </g>
              <g onClick="prueba(this)" id="133" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="560" y="100" width="20" height="20"></rect>
                <text x="569" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">133</text>
              </g>
              <g onClick="prueba(this)" id="132" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="580" y="100" width="20" height="20"></rect>
                <text x="589" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">132</text>
              </g>
              <g onClick="prueba(this)" id="131" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="600" y="100" width="20" height="20"></rect>
                <text x="609" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">131</text>
              </g>
              <g onClick="prueba(this)" id="130" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="620" y="100" width="20" height="20"></rect>
                <text x="629" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">130</text>
              </g>
              <g onClick="prueba(this)" id="129" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="100" width="20" height="20"></rect>
                <text x="649" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">129</text>
              </g>
              <g onClick="prueba(this)" id="128" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="100" width="20" height="20"></rect>
                <text x="669" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">128</text>
              </g>
              <g onClick="prueba(this)" id="127" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="100" width="20" height="20"></rect>
                <text x="689" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">127</text>
              </g>
              <g onClick="prueba(this)" id="126" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="100" width="20" height="20"></rect>
                <text x="709" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">126</text>
              </g>
              <g onClick="prueba(this)" id="125" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="100" width="20" height="20"></rect>
                <text x="729" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">125</text>
              </g>
              <g onClick="prueba(this)" id="124" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="100" width="20" height="20"></rect>
                <text x="809" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">124</text>
              </g>
              <g onClick="prueba(this)" id="123" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="100" width="20" height="20"></rect>
                <text x="829" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">123</text>
              </g>
              <g onClick="prueba(this)" id="122" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="100" width="20" height="20"></rect>
                <text x="849" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">122</text>
              </g>
              <g onClick="prueba(this)" id="121" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="100" width="20" height="20"></rect>
                <text x="869" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">121</text>
              </g>
              <g onClick="prueba(this)" id="120" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="100" width="20" height="20"></rect>
                <text x="889" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">120</text>
              </g>
              <g onClick="prueba(this)" id="119" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="100" width="20" height="20"></rect>
                <text x="909" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">119</text>
              </g>
              <g onClick="prueba(this)" id="118" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="920" y="100" width="20" height="20"></rect>
                <text x="929" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">118</text>
              </g>
              <g onClick="prueba(this)" id="117" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="940" y="100" width="20" height="20"></rect>
                <text x="949" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">117</text>
              </g>
              <g onClick="prueba(this)" id="116" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="960" y="100" width="20" height="20"></rect>
                <text x="969" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">116</text>
              </g>
              <g onClick="prueba(this)" id="115" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="980" y="100" width="20" height="20"></rect>
                <text x="989" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">115</text>
              </g>
              <g onClick="prueba(this)" id="114" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="100" width="20" height="20"></rect>
                <text x="1009" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">114</text>
              </g>
              <g onClick="prueba(this)" id="113" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="100" width="20" height="20"></rect>
                <text x="1029" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">113</text>
              </g>
              <g onClick="prueba(this)" id="112" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="100" width="20" height="20"></rect>
                <text x="1049" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">112</text>
              </g>
              <g onClick="prueba(this)" id="111" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="100" width="20" height="20"></rect>
                <text x="1069" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">111</text>
              </g>
              <g onClick="prueba(this)" id="110" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="100" width="20" height="20"></rect>
                <text x="1089" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">110</text>
              </g>
              <g onClick="prueba(this)" id="109" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="100" width="20" height="20"></rect>
                <text x="1109" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">109</text>
              </g>

              <g onClick="prueba(this)" id="108" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1120" y="100" width="40" height="20"></rect>
                <text x="1129" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">108</text>
              </g>
              <g onClick="prueba(this)" id="144" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="120" width="20" height="20"></rect>
                <text x="449" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">144</text>
              </g>
              <g onClick="prueba(this)" id="145" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="460" y="120" width="20" height="20"></rect>
                <text x="469" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">145</text>
              </g>
              <g onClick="prueba(this)" id="146" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="480" y="120" width="20" height="20"></rect>
                <text x="489" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">146</text>
              </g>
              <g onClick="prueba(this)" id="147" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="500" y="120" width="20" height="20"></rect>
                <text x="509" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">147</text>
              </g>
              <g onClick="prueba(this)" id="148" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="520" y="120" width="20" height="20"></rect>
                <text x="529" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">148</text>
              </g>
              <g onClick="prueba(this)" id="149" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="120" width="20" height="20"></rect>
                <text x="549" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">149</text>
              </g>
              <g onClick="prueba(this)" id="150" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="560" y="120" width="20" height="20"></rect>
                <text x="569" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">150</text>
              </g>
              <g onClick="prueba(this)" id="151" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="580" y="120" width="20" height="20"></rect>
                <text x="589" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">151</text>
              </g>
              <g onClick="prueba(this)" id="152" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="600" y="120" width="20" height="20"></rect>
                <text x="609" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">152</text>
              </g>
              <g onClick="prueba(this)" id="153" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="620" y="120" width="20" height="20"></rect>
                <text x="629" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">153</text>
              </g>
              <g onClick="prueba(this)" id="154" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="120" width="20" height="20"></rect>
                <text x="649" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">154</text>
              </g>
              <g onClick="prueba(this)" id="155" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="120" width="20" height="20"></rect>
                <text x="669" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">155</text>
              </g>
              <g onClick="prueba(this)" id="156" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="120" width="20" height="20"></rect>
                <text x="689" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">156</text>
              </g>
              <g onClick="prueba(this)" id="157" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="120" width="20" height="20"></rect>
                <text x="709" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">157</text>
              </g>
              <g onClick="prueba(this)" id="158" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="120" width="20" height="20"></rect>
                <text x="729" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">158</text>
              </g>
              <g onClick="prueba(this)" id="159" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="120" width="20" height="20"></rect>
                <text x="809" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">159</text>
              </g>
              <g onClick="prueba(this)" id="160" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="120" width="20" height="20"></rect>
                <text x="829" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">160</text>
              </g>
              <g onClick="prueba(this)" id="161" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="120" width="20" height="20"></rect>
                <text x="849" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">161</text>
              </g>
              <g onClick="prueba(this)" id="162" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="120" width="20" height="20"></rect>
                <text x="869" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">162</text>
              </g>
              <g onClick="prueba(this)" id="163" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="120" width="20" height="20"></rect>
                <text x="889" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">163</text>
              </g>
              <g onClick="prueba(this)" id="164" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="120" width="20" height="20"></rect>
                <text x="909" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">164</text>
              </g>
              <g onClick="prueba(this)" id="165" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="920" y="120" width="20" height="20"></rect>
                <text x="929" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">165</text>
              </g>
              <g onClick="prueba(this)" id="166" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="940" y="120" width="20" height="20"></rect>
                <text x="949" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">166</text>
              </g>
              <g onClick="prueba(this)" id="167" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="960" y="120" width="20" height="20"></rect>
                <text x="969" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">167</text>
              </g>
              <g onClick="prueba(this)" id="168" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="980" y="120" width="20" height="20"></rect>
                <text x="989" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">168</text>
              </g>
              <g onClick="prueba(this)" id="169" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="120" width="20" height="20"></rect>
                <text x="1009" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">169</text>
              </g>
              <g onClick="prueba(this)" id="170" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="120" width="20" height="20"></rect>
                <text x="1029" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">170</text>
              </g>
              <g onClick="prueba(this)" id="171" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="120" width="20" height="20"></rect>
                <text x="1049" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">171</text>
              </g>
              <g onClick="prueba(this)" id="172" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="120" width="20" height="20"></rect>
                <text x="1069" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">172</text>
              </g>
              <g onClick="prueba(this)" id="173" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="120" width="20" height="20"></rect>
                <text x="1089" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">173</text>
              </g>
              <g onClick="prueba(this)" id="174" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="120" width="20" height="20"></rect>
                <text x="1109" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">174</text>
              </g>
              <g onClick="prueba(this)" id="175" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1120" y="120" width="20" height="20"></rect>
                <text x="1129" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">175</text>
              </g>
              <g onClick="prueba(this)" id="176" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="120" width="20" height="20"></rect>
                <text x="1149" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">176</text>
              </g>
              <g onClick="prueba(this)" id="205" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="160" width="34" height="20"></rect>
                <text x="455" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">205</text>
              </g>
              <g onClick="prueba(this)" id="204" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="474" y="160" width="33" height="20"></rect>
                <text x="490" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">204</text>
              </g>
              <g onClick="prueba(this)" id="203" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="507" y="160" width="33" height="20"></rect>
                <text x="522" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">203</text>
              </g>
              <g onClick="prueba(this)" id="202" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="160" width="33" height="20"></rect>
                <text x="555" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">202</text>
              </g>
              <g onClick="prueba(this)" id="201" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="573" y="160" width="33" height="20"></rect>
                <text x="588" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">201</text>
              </g>
              <g onClick="prueba(this)" id="200" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="606" y="160" width="34" height="20"></rect>
                <text x="621" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">200</text>
              </g>
              <g onClick="prueba(this)" id="199" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="160" width="20" height="20"></rect>
                <text x="649" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">199</text>
              </g>
              <g onClick="prueba(this)" id="198" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="160" width="20" height="20"></rect>
                <text x="669" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">198</text>
              </g>
              <g onClick="prueba(this)" id="197" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="160" width="20" height="20"></rect>
                <text x="689" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">197</text>
              </g>
              <g onClick="prueba(this)" id="196" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="160" width="20" height="20"></rect>
                <text x="709" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">196</text>
              </g>
              <g onClick="prueba(this)" id="195" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="160" width="20" height="20"></rect>
                <text x="729" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">195</text>
              </g>
              <g onClick="prueba(this)" id="194" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="740" y="160" width="20" height="20"></rect>
                <text x="749" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">194</text>
              </g>
              <g onClick="prueba(this)" id="193" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="760" y="160" width="20" height="20"></rect>
                <text x="769" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">193</text>
              </g>
              <g onClick="prueba(this)" id="192" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="780" y="160" width="20" height="20"></rect>
                <text x="789" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">192</text>
              </g>
              <g onClick="prueba(this)" id="191" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="160" width="20" height="20"></rect>
                <text x="809" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">191</text>
              </g>
              <g onClick="prueba(this)" id="190" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="160" width="20" height="20"></rect>
                <text x="829" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">190</text>
              </g>
              <g onClick="prueba(this)" id="189" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="160" width="20" height="20"></rect>
                <text x="849" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">189</text>
              </g>
              <g onClick="prueba(this)" id="188" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="160" width="20" height="20"></rect>
                <text x="869" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">188</text>
              </g>
              <g onClick="prueba(this)" id="187" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="160" width="20" height="20"></rect>
                <text x="889" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">187</text>
              </g>
              <g onClick="prueba(this)" id="186" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="160" width="33" height="20"></rect>
                <text x="915" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">186</text>
              </g>
              <g onClick="prueba(this)" id="185" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="933" y="160" width="34" height="20"></rect>
                <text x="948" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">185</text>
              </g>
              <g onClick="prueba(this)" id="184" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="967" y="160" width="33" height="20"></rect>
                <text x="982" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">184</text>
              </g>
              <g onClick="prueba(this)" id="183" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="160" width="20" height="20"></rect>
                <text x="1009" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">183</text>
              </g>
              <g onClick="prueba(this)" id="182" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="160" width="20" height="20"></rect>
                <text x="1029" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">182</text>
              </g>
              <g onClick="prueba(this)" id="181" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="160" width="20" height="20"></rect>
                <text x="1049" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">181</text>
              </g>
              <g onClick="prueba(this)" id="180" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="160" width="20" height="20"></rect>
                <text x="1069" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">180</text>
              </g>
              <g onClick="prueba(this)" id="179" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="160" width="20" height="20"></rect>
                <text x="1089" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">179</text>
              </g>
              <g onClick="prueba(this)" id="178" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="160" width="20" height="20"></rect>
                <text x="1109" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">178</text>
              </g>
              <g onClick="prueba(this)" id="177" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="160" width="20" height="20"></rect>
                <text x="1149" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">177</text>
              </g>


              <g onClick="prueba(this)" id="209" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="180" width="34" height="20"></rect>
                <text x="455" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">209</text>
              </g>
              <g onClick="prueba(this)" id="210" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="474" y="180" width="33" height="20"></rect>
                <text x="490" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">210</text>
              </g>
              <g onClick="prueba(this)" id="211" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="507" y="180" width="33" height="20"></rect>
                <text x="522" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">211</text>
              </g>
              <g onClick="prueba(this)" id="212" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="180" width="33" height="20"></rect>
                <text x="555" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">212</text>
              </g>
              <g onClick="prueba(this)" id="213" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="573" y="180" width="33" height="20"></rect>
                <text x="588" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">213</text>
              </g>
              <g onClick="prueba(this)" id="214" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="606" y="180" width="34" height="20"></rect>
                <text x="621" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">214</text>
              </g>
              <g onClick="prueba(this)" id="215" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="180" width="20" height="20"></rect>
                <text x="649" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">215</text>
              </g>
              <g onClick="prueba(this)" id="216" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="180" width="20" height="20"></rect>
                <text x="669" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">216</text>
              </g>
              <g onClick="prueba(this)" id="217" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="180" width="20" height="20"></rect>
                <text x="689" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">217</text>
              </g>
              <g onClick="prueba(this)" id="218" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="180" width="20" height="20"></rect>
                <text x="709" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">218</text>
              </g>
              <g onClick="prueba(this)" id="219" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="720" y="180" width="20" height="20"></rect>
                <text x="729" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">219</text>
              </g>
              <g onClick="prueba(this)" id="220" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="740" y="180" width="20" height="20"></rect>
                <text x="749" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">220</text>
              </g>
              <g onClick="prueba(this)" id="221" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="760" y="180" width="20" height="20"></rect>
                <text x="769" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">221</text>
              </g>
              <g onClick="prueba(this)" id="222" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="780" y="180" width="20" height="20"></rect>
                <text x="789" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">222</text>
              </g>
              <g onClick="prueba(this)" id="223" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="180" width="20" height="20"></rect>
                <text x="809" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">223</text>
              </g>
              <g onClick="prueba(this)" id="224" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="180" width="20" height="20"></rect>
                <text x="829" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">224</text>
              </g>
              <g onClick="prueba(this)" id="225" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="180" width="20" height="20"></rect>
                <text x="849" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">225</text>
              </g>
              <g onClick="prueba(this)" id="226" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="180" width="20" height="20"></rect>
                <text x="869" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">226</text>
              </g>
              <g onClick="prueba(this)" id="227" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="180" width="20" height="20"></rect>
                <text x="889" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">227</text>
              </g>
              <g onClick="prueba(this)" id="228" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="180" width="33" height="20"></rect>
                <text x="915" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">228</text>
              </g>
              <g onClick="prueba(this)" id="229" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="933" y="180" width="34" height="20"></rect>
                <text x="948" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">229</text>
              </g>
              <g onClick="prueba(this)" id="230" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="967" y="180" width="33" height="20"></rect>
                <text x="982" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">230</text>
              </g>
              <g onClick="prueba(this)" id="231" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="180" width="20" height="20"></rect>
                <text x="1009" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">231</text>
              </g>
              <g onClick="prueba(this)" id="232" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="180" width="20" height="20"></rect>
                <text x="1029" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">232</text>
              </g>
              <g onClick="prueba(this)" id="233" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="180" width="20" height="20"></rect>
                <text x="1049" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">233</text>
              </g>
              <g onClick="prueba(this)" id="234" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="180" width="20" height="20"></rect>
                <text x="1069" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">234</text>
              </g>
              <g onClick="prueba(this)" id="235" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="180" width="20" height="20"></rect>
                <text x="1089" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">235</text>
              </g>
              <g onClick="prueba(this)" id="236" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="180" width="20" height="20"></rect>
                <text x="1109" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">236</text>
              </g>

              <g id="banio230" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1140" y="180" width="20" height="60"></rect>
                <text style="writing-mode: tb;" x="1149" y="215" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">año237</text>
              </g>

              <g onClick="prueba(this)" id="270" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="440" y="220" width="20" height="20"></rect>
                <text x="449" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">270</text>
              </g>
              <g onClick="prueba(this)" id="269" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="460" y="220" width="20" height="20"></rect>
                <text x="469" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">269</text>
              </g>
              <g onClick="prueba(this)" id="268" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="480" y="220" width="20" height="20"></rect>
                <text x="489" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">268</text>
              </g>
              <g onClick="prueba(this)" id="267" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="500" y="220" width="20" height="20"></rect>
                <text x="509" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">267</text>
              </g>
              <g onClick="prueba(this)" id="266" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="520" y="220" width="20" height="20"></rect>
                <text x="529" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">266</text>
              </g>
              <g onClick="prueba(this)" id="265" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="540" y="220" width="20" height="20"></rect>
                <text x="549" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">265</text>
              </g>
              <g onClick="prueba(this)" id="264" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="560" y="220" width="20" height="20"></rect>
                <text x="569" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">264</text>
              </g>
              <g onClick="prueba(this)" id="263" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="580" y="220" width="20" height="20"></rect>
                <text x="589" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">263</text>
              </g>
              <g onClick="prueba(this)" id="262" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="600" y="220" width="20" height="20"></rect>
                <text x="609" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">262</text>
              </g>
              <g onClick="prueba(this)" id="261" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="620" y="220" width="20" height="20"></rect>
                <text x="629" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">261</text>
              </g>
              <g onClick="prueba(this)" id="260" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="640" y="220" width="20" height="20"></rect>
                <text x="649" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">260</text>
              </g>
              <g onClick="prueba(this)" id="259" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="660" y="220" width="20" height="20"></rect>
                <text x="669" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">259</text>
              </g>
              <g onClick="prueba(this)" id="258" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="680" y="220" width="20" height="20"></rect>
                <text x="689" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">258</text>
              </g>
              <g onClick="prueba(this)" id="257" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="700" y="220" width="20" height="20"></rect>
                <text x="709" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">257</text>
              </g>
              <g onClick="prueba(this)" id="256" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="760" y="220" width="20" height="20"></rect>
                <text x="769" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">256</text>
              </g>
              <g onClick="prueba(this)" id="255" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="780" y="220" width="20" height="20"></rect>
                <text x="789" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">255</text>
              </g>
              <g onClick="prueba(this)" id="254" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="800" y="220" width="20" height="20"></rect>
                <text x="809" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">254</text>
              </g>
              <g onClick="prueba(this)" id="253" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="820" y="220" width="20" height="20"></rect>
                <text x="829" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">253</text>
              </g>
              <g onClick="prueba(this)" id="252" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="840" y="220" width="20" height="20"></rect>
                <text x="849" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">252</text>
              </g>
              <g onClick="prueba(this)" id="251" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="860" y="220" width="20" height="20"></rect>
                <text x="869" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">251</text>
              </g>
              <g onClick="prueba(this)" id="250" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="880" y="220" width="20" height="20"></rect>
                <text x="889" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">250</text>
              </g>
              <g onClick="prueba(this)" id="249" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="900" y="220" width="20" height="20"></rect>
                <text x="909" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">249</text>
              </g>
              <g onClick="prueba(this)" id="248" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="920" y="220" width="20" height="20"></rect>
                <text x="929" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">248</text>
              </g>
              <g onClick="prueba(this)" id="247" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="940" y="220" width="20" height="20"></rect>
                <text x="949" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">247</text>
              </g>
              <g onClick="prueba(this)" id="246" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="960" y="220" width="20" height="20"></rect>
                <text x="969" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">246</text>
              </g>
              <g onClick="prueba(this)" id="245" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="980" y="220" width="20" height="20"></rect>
                <text x="989" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">245</text>
              </g>
              <g onClick="prueba(this)" id="244" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1000" y="220" width="20" height="20"></rect>
                <text x="1009" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">244</text>
              </g>
              <g onClick="prueba(this)" id="243" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1020" y="220" width="20" height="20"></rect>
                <text x="1029" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">243</text>
              </g>
              <g onClick="prueba(this)" id="242" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1040" y="220" width="20" height="20"></rect>
                <text x="1049" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">242</text>
              </g>
              <g onClick="prueba(this)" id="241" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1060" y="220" width="20" height="20"></rect>
                <text x="1069" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">241</text>
              </g>
              <g onClick="prueba(this)" id="240" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1080" y="220" width="20" height="20"></rect>
                <text x="1089" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">240</text>
              </g>
              <g onClick="prueba(this)" id="239" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1100" y="220" width="20" height="20"></rect>
                <text x="1109" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">239</text>
              </g>
              <g onClick="prueba(this)" id="238" stroke="#BDBDBD" stroke-width=".5px" fill="white">
                <rect x="1120" y="220" width="20" height="20"></rect>
                <text x="1129" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">238</text>
              </g>
            </svg>
          </div>
        </div>
        <div class="reportes" id="reporte">
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
                    <input type="text" placeholder="Fin">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="ui vertical segment">
            <p><h1>Total generado por este periodo de tiempo:</h1><span id="total">$00.00</span></p>
          </div>
          <h2>GRAFICA POR AÑO</h2>
          <h3><?php echo date('Y'); ?></h3>
          <div class="ui vertical segment">
            <div id="chart">

            </div>
          </div>
        </div>
        <div class="configuracion" id="configuracion">
          <h2>CONFIGURACION</h2>
          <table class="ui orange table tablaSU">
  <thead>
    <tr>
    <th>LOCAL</th>
    <th>MODIFICAR</th>
    <th></th>
    <th></th>
  </tr>
</thead>
<tbody>
  <?php
        $fechahoy = date("Y-m-d");
        $insertar5 = "SELECT * FROM locales";
        $consulta=mysqli_query($conexion,$insertar5);
        while ($row=mysqli_fetch_array($consulta)) {
        $id_local=$row['id_local'];
        $nombre_local=$row['nombre_local'];
            echo "<tr><td>LOCAL $nombre_local</td>";
            echo "<td><button id='btnLocalito$id_local' class='ui primary button'>MODIFICAR</button>
            <script>
            $(document).ready(function() {
            $('#btnLocalito$id_local').click(function(){
            $('#idLocalito').val('$id_local');
            $('#numeritoLocalito').val('$nombre_local');
            $('#modalito2')
            .modal('show')
            });
            });
            </script></td>";
            echo "<td></td>";
            echo "<td></td></tr>";
          }
            ?>
  </tbody>
</table>
        </div>
      </section>
    </main>
    <div class="ui modal modalitox" id="modalitox2">
      <div class="header modalitox">Cargando...</div>
      <div class="content modalitox">
        <img src="../resources/loading1.gif">
      </div>
    </div>

    <div class="ui modal modalito" id="modalito">
    <div class="header arribarriba" id="localito">EDITAR PERFIL</div>
    <div class="content">
      <h4 class="editxt" id="nombrecito">Nombre:</h4>
      <h4 class="editxt" id="celularcito">Celular:</h4>
      <h4 class="editxt" id="correoito">Correo:</h4>
      <h4 class="editxt" id="direccioncita">Direccion:</h4>
      <h4 class="editxt" id="imagencita">Holis</h4>
      <br><br>
      <button type="submit" class="ui primary button" id="aceptar">
      Aceptar
      </button>
    </div>
  </div>

  <div class='ui modal modalito' id='modalito2'>
  <div class='header arribarriba'>EDITAR LOCAL</div>
  <div class='content'>
    <form method='post' id='fileUploadForm2' onsubmit='return forM(this)' enctype='multipart/form-data'>
    <h4 class='editxt'>Nuevo nombre del local:</h4>
    <input class='ediint tamaño' id ="numeritoLocalito" name='nuevomod' type='number' value=''>
    <input type='hidden' name='idmod' id="idLocalito" value=''><br><br>
    <button type='submit' class='ui primary button' id='btnSubirLocalito'>
    Guardar
    </button>
    </form><br>
    <a id='cerrar2'><button class='ui button'>
      Cancelar
    </button></a><br><br>
  </div>
</div>

<div class='ui modal modalito' id='modalito3'>
<div class='header arribarriba'>EDITAR PERFIL</div>
<div class='content'>
  <form method='post' id='fileUploadForm3' onsubmit='return forM(this)' enctype='multipart/form-data'>
  <h4 class='editxt'>Nombre:</h4>
  <input id='nombre' class='ediint' name='nombre' type='text' value='' id="nombre">
  <h4 class='editxt'>Celular:</h4>
  <input class='ediint' onkeypress='return justNumbers(event);' name='celular' type='tel' value='' id="celular">
  <h4 class='editxt'>Correo:</h4>
  <input class='ediint' name='correo' type='text' value='' id="correo"><br><br>
  <h4 class='editxt'>Direccion:</h4>
  <input id='domicilio' class='ediint' name='domicilio' type='text' value=''id="domicilio"><br><br>
  <h4 class='editxt'>Identificación:</h4>
  <input class='filint' type='text'  name='contrato1' id='ife1' required disabled/> <label for='ife' class='botoncillo'><i class='fa fa-upload' aria-hidden='true'></i></label><br><br>
  <div class='notoy'><input type='file' name='ife' id='ife' onchange='ife1.value = this.value'>  </div>
  <input type='hidden' name='id' value='' id="id">
  <input type='hidden' name='dirife' value='' id="ifecita">
  <button type='submit' class='ui primary button' id='btnSubirClientito'>
  Guardar
  </button>
  </form><br>
  <a id='cerrarModalito3'><button class='ui button'>
    Cancelar
  </button></a><br><br>
</div>
</div>

<div class="ui modal modalito" id="modalito4">
<div class="header arribarriba">ENVIAR MENSAJE A USUARIO PARA PROCEDER SU PAGO</div>
<div class="content">
  <h4 class="editxt" id="nombrecitod">Nombre:</h4>
  <form method="post" id="fileUploadFormPro1" onsubmit="return forM(this)" enctype="multipart/form-data" >
  <h4 class="editxt">Celular:</h4>
  <input type="tel" class='ediint' name='celPro' id="celPro1" type='text' value='' maxlength="10" onkeypress="return justNumbers(event);">
  <h4 class="editxt">Texto para promoción:</h4>
  <textarea class='ediint largo' name='txtPro' id="txtPro1" type='text' value='' maxlength="160" onKeyDown="contar1()" onKeyUp="contar1()" rows="8" cols="38"></textarea><br>
  <label>Caracteres:</label>
  <input disabled size="3" value="160" id="contador1">
  <br><br>
  <button type="submit" class="ui primary button" id="enviarMsg">
  Enviar
</button><br><br>
</form>
<a id='cerrarModalito4'><button class='ui button'>
  Cancelar
</button></a>
</div>
</div>

<div class="ui modal modalito" id="modalito5">
<div class="header arribarriba" id="localprom">ENVIAR MENSAJE PARA PROMOCIONAR EL LOCAL#</div>
<div class="content">
  <form method="post" id="fileUploadFormPro" onsubmit="return forM(this)" enctype="multipart/form-data" >
  <h4 class="editxt">Celular:</h4>
  <input type="tel" class='ediint' name='celPro' id="celPro" type='text' value='' maxlength="10" onkeypress="return justNumbers(event);">
  <h4 class="editxt">Texto para promoción:</h4>
  <textarea class='ediint largo' name='txtPro' id="txtPro" type='text' value='' maxlength="160" onKeyDown="contar()" onKeyUp="contar()" rows="8" cols="38"></textarea><br>
  <label>Caracteres:</label>
  <input disabled size="3" value="160" id="contador">
  <br><br>
  <button type="submit" class="ui primary button" id="enviarMsgp">
  Enviar
</button><br><br>
</form>
<a id='cerrarModalito5'><button class='ui button'>
  Cancelar
</button></a>
</div>
</div>
    <footer class="abajeno">
      Copyright © Tekvia 2017 Todos los Derechos Reservados
    </footer>
  </body>
      <script type="text/javascript" src="../assets/js/croquisAdminJs.js"></script>
      <script type="text/javascript" src="../assets/semantic-ui-calendar/dist/calendar.min.js"></script>
      <script src="https://d3js.org/d3.v3.min.js"></script>
      <script src="../assets/c3-master/c3.min.js"></script>

    <script>
    function number_format(amount, decimals) {

        amount += ''; // por si pasan un numero en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

        decimals = decimals || 0; // por si la variable no fue fue pasada

        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0)
            return parseFloat(0).toFixed(decimals);

        // si es mayor o menor que cero retorno el valor formateado como numero
        amount = '' + amount.toFixed(decimals);

        var amount_parts = amount.split('.'),
            regexp = /(\d+)(\d{3})/;

        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

        return amount_parts.join('.');
    }
    $(document).ready(function(){
      var chart = c3.generate({
        bindto: '#chart',
        data: {
          x: 'x',
          columns: [
            ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
            ['Ingresos', 0, 0, 0, 0, 0, 0, 0, 0, 0,0,0,0]
          ],
          type: 'bar'
        },
        axis: {
          x: {
            categories: ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine' , 'ten' , 'eleven' , 'twelve'],
            type: 'categorized'
          }
        }
      });
      $.ajax({
        url: '../php/obtenerIngresos.php',
        type: 'GET'
      }).done(function(data){
        var o = JSON.parse(data);
        console.log(o);
        console.log(o[7]);
        setTimeout(function () {
            chart.load({
                columns: [
                  ['x', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'],
                  ['Ingresos', o[1], o[2], o[3], o[4], o[5], o[6], o[7], o[8], o[9],o[10],o[11],o[12]]
                ],
            });
        }, 1000);

      });






      var cambioCal = 0;
      $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend'),
        disableMinute: false,
        text: {
          days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
          months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
        },
        formatter: {
          date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
          }
        }
      });
      $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart'),
        disableMinute: false,
        text: {
          days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
          months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
        },
        onChange: function(a, t) {
          if(!$('#rangeend').calendar('get startDate') == ''){
            $.ajax({
                  url: "../php/obtenerCargos.php",
                  type: "POST",
                  data: "fechaInicio=" + $('#fechaInicial').val() + "&fechaFinal=" + t
            }).done(function(data){
              console.log(data);
              $('#total').html("$"+ number_format(data,2));
            });

          }
        },
        formatter: {
          date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
          }
        }
      });
      /**Llamar al modal locales Corriente**/
      $("#aceptar").click(function(){
        $('#modalito')
        .modal('hide');
        });
        $("#enviarMsg").click(function(){
          if($("#celPro1").val().length < 1) {
                  swal(
                'Número no agregado',
                'No se puede enviar un mensaje si no se agrega un número',
                'error'
                )
                  return false;
              }else if($("#celPro1").val().length < 10) {
                      swal(
                    'Número no valido',
                    'Tiene que ser un número de maximo 10 caracteres',
                    'error'
                    )
                   return false;
                 }
                 else if($("#txtPro1").val().length < 1) {
                         swal(
                       'Texto no agregado',
                       'Es necesario agregar un texto para promocionar el local',
                       'error'
                       )
                      return false;
                    }else{
                      event.preventDefault();
                      var form = $('#fileUploadFormPro1')[0];
                      var data = new FormData(form);
                      data.append('CustomField', 'This is some extra data, testing');
                      $('#modalitox2')
                      .modal('show');
                      $.ajax({
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        url: '../php/promocionarCel.php',
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {

                          $('#modalito4')
                          .modal('hide');

                          $('#modalitox2')
                          .modal('hide');
                          $('#contador1').val('160');
                          $('#celPro1').val('');
                          $('#txtPro1').val('');
                          swal(
                        {
                          title:'Mensaje enviado con exito',
                          text:'',
                        }
                      )
                        },
                        error: function (e) {
                        }
                    });
    }

          });
          $("#enviarMsgp").click(function(){
            if($("#celPro").val().length < 1) {
                    swal(
                  'Número no agregado',
                  'No se puede enviar un mensaje si no se agrega un número',
                  'error'
                  )
                    return false;
                }else if($("#celPro").val().length < 10) {
                        swal(
                      'Número no valido',
                      'Tiene que ser un número de maximo 10 caracteres',
                      'error'
                      )
                     return false;
                   }
                   else if($("#txtPro").val().length < 1) {
                           swal(
                         'Texto no agregado',
                         'Es necesario agregar un texto para promocionar el local',
                         'error'
                         )
                        return false;
                      }else{
                        event.preventDefault();
                        var form = $('#fileUploadFormPro')[0];
                        var data = new FormData(form);
                        data.append('CustomField', 'This is some extra data, testing');
                        $('#modalitox2')
                        .modal('show');
                        $.ajax({
                          type: 'POST',
                          enctype: 'multipart/form-data',
                          url: '../php/promocionarCel.php',
                          data: data,
                          processData: false,
                          contentType: false,
                          cache: false,
                          timeout: 600000,
                          success: function (data) {

                            $('#modalito5')
                            .modal('hide');

                            $('#modalitox2')
                            .modal('hide');
                            $('#contador').val('160');
                            $('#celPro').val('');
                            $('#txtPro').val('');
                            swal(
                          {
                            title:'Mensaje enviado con exito',
                            text:'',
                          }
                        )
                          },
                          error: function (e) {
                          }
                      });
      }
      });

        $("#cerrarModalito3").click(function(){
          $('#modalito3')
          .modal('hide');
          });
          $("#cerrarModalito4").click(function(){
            $('#contador1').val('160');
            $('#celPro1').val('');
            $('#txtPro1').val('');
            $('#modalito4')
            .modal('hide');
            });
            $("#cerrarModalito5").click(function(){
              $('#contador').val('160');
              $('#celPro').val('');
              $('#txtPro').val('');
              $('#modalito5')
              .modal('hide');
              });
        /**Menu**/
      $('#btnR').click(function(){
        $("#reporte").show();
        $("#localesDeuda").hide();
        $("#localesCorriente").hide();
        $("#localesDisponibles").hide();
        $("#usuarios").hide();
        $("#croquis").hide();
        $("#configuracion").hide();
      });
      $("#btnLCSU").click(function(){
       $("#localesCorriente").show();
       $("#localesDeuda").hide();
       $("#localesDisponibles").hide();
       $("#usuarios").hide();
       $("#croquis").hide();
       $("#configuracion").hide();
       $("#reporte").hide();
     });
     $("#btnLDSU").click(function(){
      $("#localesCorriente").hide();
      $("#localesDeuda").show();
      $("#localesDisponibles").hide();
      $("#usuarios").hide();
      $("#croquis").hide();
      $("#configuracion").hide();
      $("#reporte").hide();
    });
    $("#btnLDISU").click(function(){
     $("#localesCorriente").hide();
     $("#localesDeuda").hide();
     $("#localesDisponibles").show();
     $("#usuarios").hide();
     $("#croquis").hide();
     $("#configuracion").hide();
     $("#reporte").hide();
   });
   $("#btnUSSU").click(function(){
    $("#localesCorriente").hide();
    $("#localesDeuda").hide();
    $("#localesDisponibles").hide();
    $("#usuarios").show();
    $("#croquis").hide();
    $("#configuracion").hide();
    $("#reporte").hide();
  });
  $("#btnCRSU").click(function(){
   $("#localesCorriente").hide();
   $("#localesDeuda").hide();
   $("#localesDisponibles").hide();
   $("#usuarios").hide();
   $("#croquis").show();
   $("#configuracion").hide();
   $("#reporte").hide();
 });
 $("#btnCNSU").click(function(){
  $("#localesCorriente").hide();
  $("#localesDeuda").hide();
  $("#localesDisponibles").hide();
  $("#usuarios").hide();
  $("#croquis").hide();
  $("#configuracion").show();
  $("#reporte").hide();
});
$('#btnR').click(function(){
  $("#reporte").show();
  $("#localesDeuda").hide();
  $("#localesCorriente").hide();
  $("#localesDisponibles").hide();
  $("#usuarios").hide();
  $("#croquis").hide();
  $("#configuracion").hide();
});
$("#btnLCSUm").click(function(){
 $("#localesCorriente").show();
 $("#localesDeuda").hide();
 $("#localesDisponibles").hide();
 $("#usuarios").hide();
 $("#croquis").hide();
 $("#configuracion").hide();
 $("#reporte").hide();
 $("aside").css("top","-1000px");
 menuEstado--;
 $(".linea1").removeClass("linea1Abierta");
 $(".linea2").removeClass("linea2Abierta");
 $(".linea3").removeClass("linea3Abierta");
});
$("#btnLDSUm").click(function(){
$("#localesCorriente").hide();
$("#localesDeuda").show();
$("#localesDisponibles").hide();
$("#usuarios").hide();
$("#croquis").hide();
$("#configuracion").hide();
$("#reporte").hide();
$("aside").css("top","-1000px");
menuEstado--;
$(".linea1").removeClass("linea1Abierta");
$(".linea2").removeClass("linea2Abierta");
$(".linea3").removeClass("linea3Abierta");
});
$("#btnLDISUm").click(function(){
$("#localesCorriente").hide();
$("#localesDeuda").hide();
$("#localesDisponibles").show();
$("#usuarios").hide();
$("#croquis").hide();
$("#configuracion").hide();
$("#reporte").hide();
$("aside").css("top","-1000px");
menuEstado--;
$(".linea1").removeClass("linea1Abierta");
$(".linea2").removeClass("linea2Abierta");
$(".linea3").removeClass("linea3Abierta");
});
$("#btnUSSUm").click(function(){
$("#localesCorriente").hide();
$("#localesDeuda").hide();
$("#localesDisponibles").hide();
$("#usuarios").show();
$("#croquis").hide();
$("#configuracion").hide();
$("#reporte").hide();
$("aside").css("top","-1000px");
menuEstado--;
$(".linea1").removeClass("linea1Abierta");
$(".linea2").removeClass("linea2Abierta");
$(".linea3").removeClass("linea3Abierta");
});
$("#btnCRSUm").click(function(){
$("#localesCorriente").hide();
$("#localesDeuda").hide();
$("#localesDisponibles").hide();
$("#usuarios").hide();
$("#croquis").show();
$("#configuracion").hide();
$("#reporte").hide();
$("aside").css("top","-1000px");
menuEstado--;
$(".linea1").removeClass("linea1Abierta");
$(".linea2").removeClass("linea2Abierta");
$(".linea3").removeClass("linea3Abierta");
});
$("#btnCNSUm").click(function(){
$("#localesCorriente").hide();
$("#localesDeuda").hide();
$("#localesDisponibles").hide();
$("#usuarios").hide();
$("#croquis").hide();
$("#configuracion").show();
$("#reporte").hide();
$("aside").css("top","-1000px");
menuEstado--;
$(".linea1").removeClass("linea1Abierta");
$(".linea2").removeClass("linea2Abierta");
$(".linea3").removeClass("linea3Abierta");
});
$('#btnRm').click(function(){
  $("#reporte").show();
  $("#localesDeuda").hide();
  $("#localesCorriente").hide();
  $("#localesDisponibles").hide();
  $("#usuarios").hide();
  $("#croquis").hide();
  $("#configuracion").hide();
  $("aside").css("top","-1000px");
  menuEstado--;
  $(".linea1").removeClass("linea1Abierta");
  $(".linea2").removeClass("linea2Abierta");
  $(".linea3").removeClass("linea3Abierta");
});
});
$(document).ready(function(){
/**Modulo Locales**/
$('#btnLocalito').click(function(){
  $('#modalito2')
  .modal('show');
});
$('#cerrar2').click(function(){
  $('#modalito2')
  .modal('hide');
});
  });
</script>
<script>
  $(document).ready(function(){
$('#btnSubirLocalito').click(function (event) {
      event.preventDefault();
      var form = $('#fileUploadForm2')[0];
      var data = new FormData(form);
      data.append('CustomField', 'This is some extra data, testing');
      $('#modalitox2')
      .modal('show');
      $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '../php/editarLocal.php',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
          if(data=='true') {
          $('#modalitox2')
          .modal('hide');
          swal(
        {
          title:'Local editado con exito',
          text:'',
          onClose:function(){
            window.location.href = 'panel.php';
          }
        }
         )
       }else{
         swal(
       {
         title:'Nombre de local invalido',
         text:'El nombre del local ya existe intenta con otro',
         onClose:function(){
           $('#modalitox2')
           .modal('hide');
         }
       }
        )
       }
        },
        error: function (e) {
        }
    });
    });
    });
</script>
<script>
       $(document).ready(function () {
       $('#btnSubirClientito').click(function (event) {
             event.preventDefault();
             var form = $('#fileUploadForm3')[0];
             var data = new FormData(form);
             data.append('CustomField', 'This is some extra data, testing');
             $('#modalitox2')
             .modal('show');
             $.ajax({
               type: 'POST',
               enctype: 'multipart/form-data',
               url: '../php/actualizar.php',
               data: data,
               processData: false,
               contentType: false,
               cache: false,
               timeout: 600000,
               success: function (data) {
                 swal(
               {
                 title:'Usuario editado con exito',
                 text:'',
                 onClose:function(){
                   window.location.href = 'panel.php';
                 }
               }
                )
               },
               error: function (e) {
               }
           });
           });
           });
           function contar() {
         var max = "160";
         var cadena = document.getElementById("txtPro").value;
         var longitud = cadena.length;

             if(longitud <= max) {
                  document.getElementById("contador").value = max-longitud;
             } else {
                  document.getElementById("txtPro").value = cadena.substr(0, max);
             }
    }
    function contar1() {
  var max = "160";
  var cadena = document.getElementById("txtPro1").value;
  var longitud = cadena.length;

      if(longitud <= max) {
           document.getElementById("contador1").value = max-longitud;
      } else {
           document.getElementById("txtPro1").value = cadena.substr(0, max);
      }
}
    function justNumbers(e)
    {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;

    return /\d/.test(String.fromCharCode(keynum));
    }
       </script>

       <script>

       </script>
       <script type="text/javascript" src="../assets/js/menuJs.js"></script>
</html>
