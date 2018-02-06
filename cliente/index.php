<!DOCTYPE html>
<?php
  echo "<script>window.location.href = 'login/';</script>";
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
      <section id="login">
        <div class="car">
          <img src="resources/mercadito.png" alt="">
        </div>


        <form method="post" id="fileUploadForm1" onsubmit="return forM(this)" enctype="multipart/form-data" >
        <div class="user">
          <div class="input1">
            <img src="resources/user.png" alt="">
            <input type="email" placeholder="CORREO ELECTRONICO" name="user" id="nick">
          </div>
        </div>
        <div class="password">
          <div class="input2">
            <img src="resources/spell.png" alt="">
            <input onkeypress="return justNumbers(event);" title="solo pueden ingresar numeros" type="tel" placeholder="TELEFONO MOVIL" name="password" maxlength="10">
          </div>
        </div>
        <div class="opciones">
          <label class="control control--checkbox">
            <input type="checkbox" checked="checked"/>
            <div class="control__indicator"></div>
          </label>
          <p>RECORDAR</p>
          <a id="recuperar" href="#">¿OLVIDASTE TU CONTRASEÑA?</a>
        </div>
          <div class="botones">
            <div class="boton">
                <input id="btnSubir1" type="submit" class="button" value="ENTRAR">
            </div>
            </form>


            <div class="boton1">
             <a href="php/archivos/form.php"> <button type="button" name="button">REGISTRARSE</button> </a>
            </div>
          </div>

        </div>
      </section>
      </main>
      <footer>
        Copyright © Tekvia 2017 Todos los Derechos Reservados
      </footer>
  </body>
  <div class="ui modal modales" id="modalito1">
  <div class="header arribarriba">Recuperar contraseña</div>
  <div class="content">
    <form method="post" id="fileUploadForm" onsubmit="return forM(this)" enctype="multipart/form-data">
      <h3>Ingresa tu correo:</h3>
      <input class='ediint' name='correo' type='mail' id="nick1"><br><br>
      <button type="submit" id="btnSubir" class="ui primary button">
      Recuperar
    </button>
</form><br>
    <a id="editarsc"><button class="ui button">
      Cancelar
    </button></a>
  </div>
</div>
<div class="ui modal modalitox" id="modalito2">
  <div class="header modalitox">Recuperando datos de acceso por favor espere...</div>
  <div class="content modalitox">
    <img src="resources/loading1.gif">
  </div>
</div>
<div class="ui modal modalitox" id="modalito3">
  <div class="header modalitox"></div>
  <div class="content modalitox">
    <img src="resources/loading1.gif">
  </div>
</div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="assets/sweetalert/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.min.css">
    <script src="assets/semantic/semantic.min.js"></script>

      <script>
              function justNumbers(e)
              {
              var keynum = window.event ? window.event.keyCode : e.which;
              if ((keynum == 8) || (keynum == 46))
              return true;

              return /\d/.test(String.fromCharCode(keynum));
              }
              </script>

              <script>
              $(document).ready(function() {
              $('#recuperar').click(function(){
              $('#modalito1')
                .modal('show');
              });
              });

              $(document).ready(function() {
              $('#editarsc').click(function(){
                $('#modalito1')
                .modal('hide');
              });
              });
              </script>

              <script>
              $(document).ready(function () {
              $("#btnSubir").click(function (event) {
                if(!$("#nick1").val().match(/^[0-9a-zA-Z\sñ@.-_]+$/)) {
                  document.getElementById("nick1").value='';
                  swal(
                'Correo invalido',
                'Ingrese un correo valido',
                'error'
                )
                    return false;

                }
                else{
              event.preventDefault();
              var form = $('#fileUploadForm')[0];
              var data = new FormData(form);
              data.append("CustomField", "This is some extra data, testing");
              $('#modalito1')
              .modal('hide');
              $('#modalito2')
              .modal('show');
              $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "php/recuperar.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                  console.log(data);
                  console.log("true");
                  if(data=='true') {
                  $('#modalito2')
                  .modal('hide');
                  swal(
                'TU DATOS DE ACCESO FUERON ENVIADOS',
                'Revisa tu correo',
                'success'
                 )
               }
               else {
                 $('#modalito2')
                 .modal('hide');
                 swal(
               'CORREO NO REGISTRADO',
               'Verifica tus datos',
               'error'
                     )
               }
                },
                error: function (e) {
                }
            });
          }
        });
    });
              </script>


              <script>
              $(document).ready(function () {
              $("#btnSubir1").click(function (event) {
                if(!$("#nick").val().match(/^[0-9a-zA-Z\sñ@.-_]+$/)) {
                  document.getElementById("nick").value='';
                  swal(
                'Correo invalido',
                'Ingrese un correo valido',
                'error'
                )
                    return false;

                }
                else{
              event.preventDefault();
              var form = $('#fileUploadForm1')[0];
              var data = new FormData(form);
              data.append("CustomField", "This is some extra data, testing");
              $('#modalito3')
              .modal('show');
              $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "php/validacion.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                if (data=='true') {
                  window.location.href = "panel/";
                }else {
                  $('#modalito3')
                  .modal('hide');
                  swal(
                'USUARIO O CONTRASEÑA INCORRECTO',
                'Verifica tus datos',
                'error'
                      )
                }
                },
                error: function (e) {
                }
            });
          }
        });
    });
              </script>

</html>
