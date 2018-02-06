<!DOCTYPE html>
<?php
     include("../php/conection.php");
     session_start();
     if(empty($_SESSION['ide'])){
     }else{
       echo "<script>window.location.href = 'panel/';</script>";
     }
     ?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="assets/css/estiloLoginUser.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/panelEstilos.css">
    <link rel="stylesheet" href="assets/css/estiloForm.css">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Mercadito Puerta del Sol</title>
  </head>
  <body>
    <main>
      <table class="ui fixed single line celled table" style="width:80%!important;margin-bottom:150px!important;">
  <thead>
    <tr>
    <th>nombre</th>
    <th>Celular</th>
    <th>Correo</th>
    <th>domicilio</th>
  </tr>
</thead>
  <tbody>
    <section style="width:80%; margin-top:150px;">
    <?php
         include("php/conection.php");

         $insertar0 = "select * from clientes";
         $consulta=mysqli_query($conexion,$insertar0);
         while ($row=mysqli_fetch_array($consulta)){
         $nombre=$row['nombre_cliente'];
         $celular=$row['celular_cliente'];
         $correo=$row['correo_cliente'];
         $domicilio=$row['domicilio_cliente'];

         echo "<tr><td>$nombre</td>";
         echo "<td>$celular</td>";
         echo "<td>$correo</td>";
         echo "<td>$domicilio</td></tr>";

         }
    ?>

  </tbody>
</table>
</section>
      </main>

  </body>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="assets/sweetalert/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.min.css">
    <script src="assets/semantic/semantic.min.js"></script>


</html>
