<?php
  include('conexion.php');
  $uid = $_REQUEST['codigo'];

  $resultado = $conexionDb->modificar('clientes','estado_cliente = 1',"WHERE uid_cliente = '$uid'");
  echo "<script>window.location.href = '../panel';</script>";
?>
