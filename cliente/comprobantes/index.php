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
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
  </head>
  <body>
    <div class="linea">
    </div>
    <nav>
      <div class="logo">
        <a href="../panel/"><img src="../resources/mercadito.png" alt=""></a>
        <span>Tianguis Mexico</span>
      </div>
      <ul id="opciones">
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Rentas activas</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../panel/">perfil</a></li>
      </ul>
      <button id="botonCerrar" class="ui orange inverted button">Cerrar sesion</button>
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
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Rentas activas</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../panel/">perfil</a></li>
        <li><a href="../php/matar.php">Cerrar Sesión</a></li>
      </ul>
    </aside>
    <main>
      <section id="comprobante">
        <h2 class="txtC">COMPROBANTES</h2>
        <div class="containerM">
          <div class="containerM1">Archivos</div>
            <div class="containerM2">Descargar</div>
          </div>
        <div class="scrollt">
        <table class="ui table">
  <thead>
    <tr><th class="ten wide"></th>
    <th class="six wide"></th>
  </tr>
</thead>
  <tbody>
    <?php
    $archivo = substr("$ife", 22);

     ?>
    <tr class="centrito">
      <td><i class="file outline icon"></i><?php echo "$archivo"; ?></td>
      <td><a href="<?php echo "../php/archivos/$ife"; ?>" target="_blank"><button class="ui button eaea">Descargar</button></a></td>
    </tr>

  </tbody>


</table>
</div>
      </section>
    </main>
    <footer class="footer">
      <img class="imgfooter" src="../resources/tekviacloud.png"><br>Design by Tekvia
    </footer>
  </body>
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ariutta.github.io/svg-pan-zoom/dist/svg-pan-zoom.min.js">
    </script>
    <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
    <script src="../assets/semantic/semantic.min.js"></script>
    <script src="../assets/js/menuJs.js"></script>
</html>
