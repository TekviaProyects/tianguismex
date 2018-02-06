<!DOCTYPE html>
<?php
     include("../php/conection.php");
     include("../php/conexion.php");
     session_start();
     if(empty($_SESSION['ide'])){
     echo "<script>window.location.href = '../index.php';</script>";
     }
     $id = $_SESSION['ide'];

     $insertar0 = "select * from clientes where id_cliente='$id'";
     $consulta=mysqli_query($conexion,$insertar0);
     while ($row=mysqli_fetch_array($consulta)){
     $nombre=$row['nombre_cliente'];
     $celular=$row['celular_cliente'];
     $correo=$row['correo_cliente'];
     $domicilio=$row['domicilio_cliente'];
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
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
    <link rel="stylesheet" href="../assets/css/panelEstilos.css">
    <link rel="stylesheet" href="../assets/css/estiloForm.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">

    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>

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
      <a href="../panel/"></a>  <img src="../resources/mercadito.png" alt="">
      </div>
      <ul id="opciones">
        <li><a class="activo" href="../panel/">Inicio</a></li>
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Vencimientos</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
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
        <li><a class="activoMovil" href="../panel/">Inicio</a></li>
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Vencimientos</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../php/matar.php">Cerrar Sesión</a></li>
      </ul>
    </aside>
    <main>

      <section class="infocliente">
        <div class="hg">
          <div class="ui card" id="tarjetaProx">
            <div class="content">
              <div class="header"><h2 class="cardtxt">Estos son tus Locales Rentados</h2></div>
            </div>
            <div class="content">
              <?php
              $sen = "SELECT * FROM `cliente_locales` INNER JOIN locales ON locales.id_local = cliente_locales.id_local WHERE estado_pago = 1 AND fecha_pago >= CURDATE() AND id_cliente = $id";
              $res = $conexionDb->personalizada($sen);
              ?>
              <table class="ui very basic table" id="tablaActivos">
                <thead>
                  <tr>
                    <th>Local</th>
                    <th>Proxima Fecha de pago</th>

                    <th>Tipo</th>
                    <th>Renovar Local</th>

                  </tr>
                </thead>
                <tbody>
                  <?php

                  while($f = mysqli_fetch_assoc($res)){
                    $fechaPago = strtotime('+1 day',strtotime($f['fecha_pago']));
                    $fechaPago = date('Y-m-d',$fechaPago);

                    $fechaActual = date('Y-m-d');
                    $fechaLimite = strtotime('-3 day',strtotime($f['fecha_pago']));





                  ?>
                  <tr>
                    <td><?php echo $f['nombre_local']; ?></td>
                    <td><?php echo $f['fecha_pago'];?></td>

                    <td>
                      <?php
                      if($f['tipo_local']==1){
                        echo "Normal";
                      }
                      if($f['tipo_local']==2){
                        echo "Class";
                      }
                      if($f['tipo_local']==3){
                        echo "Ultra";
                      }
                      if($f['tipo_local']==4){
                        echo "Super-ultra";
                      }
                      if($f['tipo_local']==5){
                        echo "Master";
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      $estado = 0;
                      $f1 = strtotime(date('Y-m-d'));
                      $f2 = strtotime($f['caducidad']);
                      if($f1 <= $f2 ){
                        $estado = 1;
                      }
                      if(($f['tipo_local'] == 3 || $f['tipo_local'] == 4 || $f['tipo_local'] == 5) && $estado == 0){
                      ?>
                      <div class="ui animated fade button" id="<?php echo $f['nombre_local'];?>" onclick="renovarClick(<?php echo $f['nombre_local']; ?>,<?php echo $f['tipo_local'] ?>,'<?php echo $fechaPago ?>')">
                        <div class="visible content">
                          <i class="refresh icon"></i>
                        </div>
                        <div class="hidden content">
                          Renovar
                        </div>
                      </div>
                      <?php
                      }else{
                      ?>
                      <div class="ui animated fade button" onclick="verClick(<?php echo $f['id_orden'] ?>)">
                        <div class="visible content">
                          <i class="search icon"></i>
                        </div>
                        <div class="hidden content">
                          Orden
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
          <div class="ui card trarget" id="tarjetaDatos">
            <div class="content">
              <div class="header"><h2 class="cardtxt">DATOS PERSONALES</h2></div>
            </div>
            <div class="content">
              <h4 class="ui sub header">Información de perfil</h4>
              <div class="ui small feed cardcontxt">
                <div class="event">
                  <div class="content">
                    <div class="summary">
                       Nombre: <div class="txt1"><?php echo "$nombre"; ?></div>
                    </div>
                  </div>
                </div>
                <div class="event">
                  <div class="content">
                    <div class="summary">
                       Celular: <div class="txt1"><?php echo "$celular"; ?></div>
                    </div>
                  </div>
                </div>
                <div class="event">
                  <div class="content">
                    <div class="summary">
                       Correo: <div class="txt1"><?php echo "$correo"; ?></div>
                    </div>
                  </div>
                </div>
                <div class="event">
                  <div class="content">
                    <div class="summary">
                       Domicilio: <div class="txt1"><?php echo "$domicilio"; ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="extra content">
              <?php echo "<img class='ife' src='../php/archivos/$ife'>"; ?>
              <br><br>
              <a  id="editars"><button class="ui button">EDITAR</button></a>
            </div>
          </div>
        </div>
      </section>
      <div class="pieG">
        Servicio sujeto a <a href="">terminos y condiciones</a>
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
  <div class="ui disabled dimmer" id="loader">
      <div class="ui loader"></div>
    </div>

  <div class="ui modal" id="modalRenovar">

  </div>
  <div class="ui modal" id="modalOrden">

  </div>


  <div class="ui modal modalito" id="modalito1">
  <div class="header arribarriba">EDITAR PERFIL</div>
  <div class="content">
    <form method="post" id="fileUploadForm" onsubmit="return forM(this)" enctype="multipart/form-data" >
    <h4 class="editxt">Nombre:</h4>
    <?php echo "<input id='nombre' class='ediint' name='nombre' type='text' value='$nombre' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$nombre';}'>"; ?>
    <h4 class="editxt">Celular:</h4>
    <?php echo "<input id='nick2' class='ediint' maxlength='10' onkeypress='return justNumbers(event);' name='celular' type='tel' value='$celular' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$celular';}'>"; ?>
    <h4 class="editxt">Correo:</h4>
    <?php echo "<input id='nick' class='ediint' name='correo' type='text' value='$correo' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$correo';}'><br><br>"; ?>
    <h4 class="editxt">Direccion:</h4>
    <?php echo "<input id='domicilio' class='ediint' name='domicilio' type='text' value='$domicilio' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$domicilio';}'><br><br>"; ?>
    <h4 class="editxt">Identificación:</h4>
    <?php $archivo = substr("$ife", 22); ?>
    <input class="filint" type="text" placeholder="<?php echo "$archivo"; ?>" name="contrato1" id="ife1" required disabled/> <label for="ife" class="botoncillo"><i class="fa fa-upload" aria-hidden="true"></i></label><br><br>
    <div class="notoy"><input type="file" name="ife" id="ife" onchange="ife1.value = this.value">  </div>
    <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
    <?php echo "<input type='hidden' name='dirife' value='$ife'>"; ?>
    <button type="submit" class="ui primary button" id="btnSubir">
    Guardar
    </button>
    </form><br>
    <a id="editarsc"><button class="ui button">
      Cancelar
    </button></a><br><br>
  </div>
</div>

    <div class="ui modal modalitox" id="modalito2">
      <div class="header modalitox">Actualizando información por favor espere...</div>
      <div class="content modalitox">
        <img src="../resources/loading1.gif">
      </div>
    </div>




    <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
    <script src="../assets/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="../assets/js/menuJs.js" ></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.semanticui.min.js" charset="utf-8"></script>
    <script src="../assets/js/renovar.js" charset="utf-8"></script>




    <script>
                  $(document).ready(function() {
                    $('#tablaActivos').DataTable({
                      language:{
                        info: "Mostrando _PAGE_ de _PAGES_",
                        search: "",
                        sLengthMenu: "_MENU_",
                        searchPlaceholder: "Buscar Local Rentado",
                        oPaginate: {
                            sPrevious: "<",
                            sNext: ">"
                        }
                      }
                    });

                  $('#editars').click(function(){
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
                        'Agrege texto A-Z o a-z',
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


                      }else if ($("#nick").val().indexOf('@', 0) == -1 || $("#nick").val().indexOf('.', 0) == -1){
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
                    url: "../php/actualizar.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                      window.location.href = 'index.php';
                    },
                    error: function (e) {
                    }
                });
              }
            });
        });
                  </script>
                  <script>


                            function justNumbers(e)
                            {
                            var keynum = window.event ? window.event.keyCode : e.which;
                            if ((keynum == 8) || (keynum == 46))
                            return true;

                            return /\d/.test(String.fromCharCode(keynum));
                            }
                            </script>
                          <script type="text/javascript" src="//mercaditopuertadelsol.com/livechat/php/app.php?widget-init.js"></script>
</html>
