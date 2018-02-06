<?php
//FUTUROS numeros de cada controlador, puede agregar mas
//Aqui iran los numeros de los controladores
  $array = array("3317521541","3317521541","3317521541","3317521541");





  include('conexionTextoV3.php');
  $mensajero = new conexionTextoV3();

  foreach ($array as $value) {
    $mensaje = "#PWD123456#RLY1=1";
    $mensajero->enviarMensaje($value,$mensaje);
    $mensaje = "#PWD123456#RLY2=1";
    $mensajero->enviarMensaje($value,$mensaje);
  }
?>
