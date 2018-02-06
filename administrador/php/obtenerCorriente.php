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
  $opc = $_GET['tipoPeticion'];
  $fecha = $_GET['fecha'];
  $tipo = $_GET['tipoLocal'];
  switch ($opc) {
    case 1:
      $consulta = "SELECT * FROM (locales INNER JOIN cliente_locales ON locales.id_local = cliente_locales.id_local) INNER JOIN clientes ON cliente_locales.id_cliente = clientes.id_cliente WHERE cliente_locales.fecha_inicio <= '$fecha' AND cliente_locales.fecha_pago >= '$fecha'  AND `estado_pago` = 1 AND tipo_local = $tipo";
      break;
    case 2:
      $consulta = "SELECT * FROM (locales INNER JOIN cliente_locales ON locales.id_local = cliente_locales.id_local) INNER JOIN clientes ON cliente_locales.id_cliente = clientes.id_cliente WHERE cliente_locales.fecha_inicio <= '$fecha'  AND `estado_pago` = 0 AND tipo_local = $tipo";
    break;
      break;
    default:
      # code...
      break;
  }
  $resultado = $conexionDb->personalizada($consulta);
  while($fila = mysqli_fetch_assoc($resultado)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode(utf8ize($arreglo));


?>
