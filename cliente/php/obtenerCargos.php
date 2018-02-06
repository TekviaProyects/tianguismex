<?php
  include('conexion.php');
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFinal = $_POST['fechaFinal'];
  $resultado = $conexionDb->personalizada("SELECT SUM(cantidad) FROM `reporte` WHERE `fecha`>='$fechaInicio' AND fecha <= '$fechaFinal'");
  $i = 0;
  while($fila = mysqli_fetch_assoc($resultado)){
    echo $fila['SUM(cantidad)'];
    $i++;
  }







?>
