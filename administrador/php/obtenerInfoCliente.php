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
$id = $_GET['id_cliente'];
$consulta = "SELECT * FROM clientes WHERE id_cliente = $id";
$busqueda = $conexionDb->personalizada($consulta);
$arreglo = array();
$i = 0;

while($fila = mysqli_fetch_assoc($busqueda)){
  $arreglo[$i] = $fila;
  $i++;
}
echo json_encode(utf8ize($arreglo));





?>
