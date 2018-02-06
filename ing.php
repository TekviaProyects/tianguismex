<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/estiloPaginaIng.css">
    <link rel="stylesheet" href="../css/estiloDropdown.css">

    <title>Mercadito Puerta del Sol</title>
  </head>
  <body>

    <?php
    $on = ($_REQUEST['on']);
    if($on == 'market'){
      echo "<script>window.location.href = '#popup';</script>";
    }else {

    }
    ?>

    <header>
      <section id="seccion1">
        <div class="columna1">
          <img src="resources/mercadito.png" alt="">
          <p>MERCADITO PUERTA DEL SOL</p>
        </div>
        <div class="columna2">
          <div class="filas">
          <div class="fila1">
            <p>You have doubts?</p>
          </div>
          <div class="fila2">
            <img src="resources/whats.png" alt="">
            <p>899 944 1098</p>
          </div>
        </div>
        </div>
      </section>
      <section id="seccion2">
        <div class="columna1">
          <div class="nav">
            <div class="dropdown">
              <button class="dropbtn">LANGUAGE</button>
              <div class="dropdown-content">
                <a href="http://mercaditopuertadelsol.com"> <img src="resources/Mexico.svg" width="25px" height="15px" id="idioma"> SPANISH</a>
                <a href="http://mercaditopuertadelsol.com/ing.php"> <img src="resources/UnitedKingdom.svg" width="25px" height="15px" id="idioma"> ENGLISH </a>
              </div>
            </div>
          </div>
        </div>
          <div class="columna2">
            <a href="http://mercaditopuertadelsol.com/cliente/php/archivos/form.php"> <button type="button" name="button">REGISTER</button> </a>
            <a href="http://mercaditopuertadelsol.com/cliente/index.php"> <button type="button" name="button">LOGN</button> </a>
          </div>
      </section>
    </header>
    <main>
      <section id="seccion3">
        <div class="fila1">
          <p> RENT A COMMERCIAL PLACE </p>
        </div>
        <div class="fila2">
          <div class="columna1">
            <p> NORMAL X 1 DAY = $50 MXN </p>
            <a href=http://mercaditopuertadelsol.com/cliente/index.php> <button type="button" name="button">RENT</button> </a>
          </div>
          <div class="columna2">
            <p> CLASS &nbsp; &nbsp; X 1 DAY = $100 MXN </p>
            <a href=http://mercaditopuertadelsol.com/cliente/index.php> <button type="button" name="button">RENT</button> </a>
          </div>
          <div class="columna3">
            <p> ULTRA &nbsp; &nbsp; X 1 MOTH = $900 MXN </p>
            <a href=http://mercaditopuertadelsol.com/cliente/index.php> <button type="button" name="button">RENT</button> </a>
          </div>
        </div>
        <div class="fila3">
          <p> DO NOT WAIT FOR MORE AND DO BUSINESS WITH US </p>
        </div>
      </section>
      <section id="seccion4">

      </section>
      <section id="seccion5">
        <p> VISIT OUR </p>
            <button type="button" name="button">OPEN MAP</button>
        <img src="resources/fire.png" alt="">
      </section>
      <section id="seccion6">
        <form method="post" action="send.php">
          <button type="sumbit" name="button"> SUBSCRIBE </button>
          <input type="mail" placeholder="EMAIL" name="correo">
        </form>
      </section>
      <section id="seccion7">
        <div class="columna1">
          <img src="resources/secure.png" alt="">
        </div>
        <div class="columna2">
          <p>YOUR PAY IS 100% SELF</p>
          <p>DO NOT RUSH YOUR OPPORTUNITY</p>
        </div>
      </section>
      <section id="seccion8">
        <div class="caja">
          <p> PAY HERE </p>
          <p> WITHOUT COMPLICATIONS </p>
        </div>
        <img src="resources/openpay.png" alt="">
      </section>
    </main>
    <footer>
        Copyright © Tekvia 2017 All Rights Reserved
    </footer>

    <div class="modal-wrapper" id="popup">
        <div class="popup-contenedor">
              ¡TANK YOU FOR SUBSCRIBING!
           <a class="popup-cerrar" href="#">X</a>
        </div>
    </div>

  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>
