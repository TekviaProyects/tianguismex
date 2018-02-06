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
$i = 0;
$arreglo = array();
$buscar = $conexionDb->personalizada('SELECT * FROM `controles` INNER JOIN puertas ON controles.id_control = puertas.id_control');
while($fila = mysqli_fetch_assoc($buscar)){
  $arreglo[$i] = $fila;
  $i++;
}
echo json_encode(utf8ize($arreglo));
?>
