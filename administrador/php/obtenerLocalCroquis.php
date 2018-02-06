<?php
  include('../../cliente/php/conexion.php');
  $fecha = $_GET['fecha'];
  $local = $_GET['local'];
  function utf8ize($d){
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
  }

  $busqueda = $conexionDb->personalizada("SELECT * FROM `clientes` INNER JOIN (cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local) ON clientes.id_cliente = cliente_locales.id_cliente WHERE nombre_local = '$local' AND fecha_inicio <= '$fecha' AND fecha_pago >= '$fecha'");
  $arreglo = array();
  $i = 0;
  while($fila = mysqli_fetch_assoc($busqueda)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode(utf8ize($arreglo));











?>
