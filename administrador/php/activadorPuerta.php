<?php
  include('../../cliente/php/conexion.php');
  include('conexionTextoV3.php');
  $mensajero = new conexionTextoV3();
  $id_control = $_GET['id_control'];
  $puerta = $_GET['puerta'];

  $consulta = $conexionDb->personalizada("SELECT * FROM `puertas` WHERE `id_control` = $id_control AND `numero_puerta` = $puerta");
  $i = 0;
  $arreglo = array();
  while ($fila = mysqli_fetch_assoc($consulta)) {
    $estado = $fila['estado_puerta'];
  }

  $consulta = $conexionDb->buscar('controles',"WHERE id_control = $id_control");
  $i = 0;
  $arreglo = array();
  while ($fila = mysqli_fetch_assoc($consulta)) {
    $telefono = $fila['telefono_control'];
  }
  $telefono = substr($telefono,2);
  if($puerta == '1'){
    $mensaje = "#PWD123456#RLY1=1";
  }else{
    $mensaje = "#PWD123456#RLY2=1";
  }
  try{
    $mensajero->enviarMensaje($telefono,$mensaje);
    if($estado == 0){
      $modificar = $conexionDb->modificar('puertas','estado_puerta=1',"WHERE id_control = $id_control AND numero_puerta = $puerta");
    }else{
      $modificar = $conexionDb->modificar('puertas','estado_puerta=0',"WHERE id_control = $id_control AND numero_puerta = $puerta");
    }
  }catch(Exception $e){
    $estado = "fallo";
  }


  echo $estado;
?>
