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
$i=0;
$rawdata = array();
$consulta = "SELECT * FROM locales";
$respuesta = $conexionDb->personalizada($consulta);
while($row = mysqli_fetch_assoc($respuesta))
 {
     $rawdata[$i] = $row;
     $i++;
 }

echo json_encode(utf8ize($rawdata));
?>
