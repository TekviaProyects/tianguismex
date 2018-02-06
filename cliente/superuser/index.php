
<!DOCTYPE html>
<?php
     include("../php/conection.php");
     session_start();
     if(empty($_SESSION['SUide'])){
     }else{
       echo "<script>window.location.href = 'panel.php';</script>";
     }
     ?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/estiloLoginSU.css">
    <link rel="stylesheet" href="../assets/css/style.css">
     <!--  <link rel="stylesheet" href="../assets/css/panelEstilos.css"> -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Mercadito Puerta del Sol</title>
  </head>
  <body>
    <main>
      <section id="login">
        <div class="car">
          <img src="../resources/mercadito.png" alt="">
        </div>
        <div class="user">
          <div class="input1">
            <img src="../resources/user.png" alt="">
              <form method="post" action="../php/comprobar.php">
            <input type="text" placeholder="USUARIO" name="user">
          </div>
        </div>
        <div class="password">
          <div class="input2">
            <img src="../resources/spell.png" alt="">
            <input type="password" placeholder="CONTRASEÑA" name="password">
          </div>
        </div>
        <div class="boton">
            <input type="submit" class="button" value="ENTRAR">
            </div>
            </form>
      </section>
      </main>
      <footer>
        Copyright © Tekvia 2017 Todos los Derechos Reservados
      </footer>
  </body>
</html>
