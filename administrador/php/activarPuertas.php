<?php
  include('conexionTextoV3.php');
  $mensajero = new conexionTextoV3();
  $telefono = $_GET['telefono'];
  $puerta = $_GET['puerta'];


  if($puerta){
    $cadena = "RLY2";
  }else{
    $cadena = "RLY1";
  }
  $mensaje = "#PWD123456#".$cadena."=1";
  $mensajero->enviarMensaje($telefono,$mensaje);
?>
