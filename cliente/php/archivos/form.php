<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../../assets/css/estiloForm.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/semantic/semantic.min.css">

    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />



    <title>Mercadito Puerta del Sol</title>
  </head>
  <body>
    <main>
      <section id="login">
        <div class="car">
          <img src="../../resources/mercadito.png" alt="">
        </div>
        <form method="post" id="fileUploadForm" onsubmit="return forM(this)" enctype="multipart/form-data" >
        <div class="user">
          <div class="input1">
            <input type="text" id="nombre" placeholder="NOMBRE COMPLETO" name="nombre" autocomplete="off" required>
          </div>
        </div>
        <div class="movil">
          <div class="input2">
            <input type="tel" id="nick2" onkeypress="return justNumbers(event);" placeholder="NUMERO CELULAR" name="movil" maxlength="10" autocomplete="off" required>
          </div>
        </div>
        <div class="email">
          <div class="input3">
            <input id="nick" type="email" placeholder="CORREO ELECTRONICO" name="email" autocomplete="off" required>
          </div>
        </div>
        <div class="domicilio">
          <div class="input4">
            <input type="text" id="domicilio" placeholder="DOMICILIO" name="domicilio" autocomplete="off" required>
          </div>
        </div>
        <div class="ife">
          <div class="input5">
            <input type="text" placeholder="IFE" name="ife1" id="ife1" required disabled/> <label for="ife" class="botonife">SUBIR</label>
          </div>
          <div class="hollow">
            <input type="file" name="ife" id="ife" onchange="ife1.value = this.value">
          </div>
        </div>
          <div class="botones">
            <div class="boton">
                <input type="submit" id="btnSubir" class="button" value="REGISTRARSE">
                </form>
            </div>
            <div class="boton1">
              <a href="../../index.php"> <button type="button" name="button">REGRESAR</button> </a>
            </div>
          </div>

        </div>
      </section>
      </main>

      <footer>
        Copyright © Tekvia 2017 Todos los Derechos Reservados
      </footer>
  </body>
  <script src="../../assets/sweetalert/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/sweetalert/dist/sweetalert2.min.css">
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../assets/semantic/semantic.min.js"></script>
<div class="ui modal modalitox">
  <div class="header modalitox">Enviando registro por favor espere...</div>
  <div class="content modalitox">
    <img src="../../resources/loading1.gif">
  </div>
</div>
<div id="msgUsuario">

</div>
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
          var $this = $(this);
          var $ife =  $this.find('ife').val();
          $(document).ready(function () {
    $("#btnSubir").click(function (event) {
      if($("#nombre").val().length < 1) {
              swal(
            'El nombre es obligatorio',
            '',
            'error'
            )
              return false;
          }
          else if (!$("#nombre").val().match(/^[a-zA-Z\sñ.]+$/)) {
            document.getElementById("nombre").value='';
            swal(
          'Nombre invalido',
          'Agregue texto A-Z o a-z',
          'error'
          )
              return false;

          }
          else if ($("#nick2").val().length < 1) {
            swal(
          'El número es obligatorio',
          '',
          'error'
          )
              return false;
          }else if ($("#nick").val().length < 1) {
            swal(
          'El correo es obligatorio',
          '',
          'error'
          )
              return false;
          }
          else if (!$("#nick").val().match(/^[0-9a-zA-Z\sñ@.-_]+$/)) {
            document.getElementById("nick").value='';
            swal(
          'Correo invalido',
          'Ingrese un correo valido',
          'error'
          )
              return false;

          }
          else if ($("#domicilio").val().length < 1) {
            swal(
          'El domicilio es obligatorio',
          '',
          'error'
          )
              return false;
            }
            else if (!$("#domicilio").val().match(/^[0-9a-zA-Z\s,ñ#.]+$/)) {
              document.getElementById("domicilio").value='';
              swal(
            'Dirección invalida',
            'Agrege una direccion valida evite utilizar (.?¿¡!&%$/*[]"")',
            'error'
            )
                return false;

            }

            else if (jQuery('#ife').val() == ''){
              swal(
            'Es necesario subir una identificación',
            '',
            'error'
            )
            return false;
        }else if ($("#nick").val().indexOf('@', 0) == -1 || $("#nick").val().indexOf('.', 0) == -1){
        }
        else{
        event.preventDefault();
        var form = $('#fileUploadForm')[0];
        var data = new FormData(form);
        data.append("CustomField", "This is some extra data, testing");
        $("#btnSubir").prop("disabled", false);
        $('.modal')
        .modal('show');
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "registro.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
              $('.modal')
              .modal('hide');
              document.getElementById("fileUploadForm").reset();
              swal(
            {
              title:"REGISTRO EXITOSO",
              text:"Revisa tu correo e inicia sesión",
              onClose:function(){
                window.location.href = '../../index.php';

              }

            }
             )
            },
            error: function (e) {
            }
        });
}
    });

});
</script>
<script>
$(document).ready(function(){
$('#nick').focusout( function(){
    if($('#nick').val()!= ""){
        $.ajax({
            type: "POST",
            url: "checarcorreo.php",
            data: "nick="+$('#nick').val(),
            beforeSend: function(){},
            success: function( respuesta ){
              if(respuesta == '1'){

              }

              else{
                swal(
              'El correo ya se encuentra registrado',
              'Intenta con otro',
              'error'
              )
              document.getElementById("nick").value='';
              }
            }
        });
    }
});
});
</script>
<script>
$(document).ready(function(){
$('#nick2').focusout( function(){
    if($('#nick2').val()!= ""){
        $.ajax({
            type: "POST",
            url: "checarnumero.php",
            data: "nick2="+$('#nick2').val(),
            beforeSend: function(){},
            success: function( respuesta ){
              if(respuesta == '1'){

              }

              else{
                swal(
              'El número ya se encuentra registrado',
              'Intenta con otro',
              'error'
              )
              document.getElementById("nick2").value='';
              }
            }
        });
    }
});
});
</script>
</html>
