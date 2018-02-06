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
$fecha = $_GET['fecha'];
$tipo = $_GET['tipo'];
$i=0;
$rawdata = array();
$consulta = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_inicio,fecha_pago,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente  AND (tipo_pago = $tipo AND fecha_inicio <= '$fecha' AND fecha_pago >= '$fecha') || (fecha_inicio <= '$fecha' AND estado_pago = 0)";
$respuesta = $conexionDb->personalizada($consulta);
while($row = mysqli_fetch_assoc($respuesta))
 {
     $rawdata[$i] = $row;
     $i++;
 }

echo json_encode(utf8ize($rawdata));
?>
