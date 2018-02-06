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
  $consulta = "SELECT clientes.`id_cliente`,`nombre_cliente`,`celular_cliente`,`correo_cliente`,`domicilio_cliente` FROM `clientes` LEFT JOIN cliente_locales ON clientes.id_cliente = cliente_locales.id_cliente WHERE id_orden IS NULL";
  $resultado = $conexionDb->personalizada($consulta);
  while($fila = mysqli_fetch_assoc($resultado)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode(utf8ize($arreglo));


?>
