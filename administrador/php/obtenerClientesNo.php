<?php
  include('../../cliente/php/conexion.php');
  function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
  }
  $arreglo = array();
  $i = 0;
  $consulta = "SELECT * FROM `clientes_no` INNER JOIN clientes ON clientes_no.id_cliente = clientes.id_cliente";
  $resultado = $conexionDb->personalizada($consulta);
  while($fila = mysqli_fetch_assoc($resultado)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode(utf8ize($arreglo));


?>
