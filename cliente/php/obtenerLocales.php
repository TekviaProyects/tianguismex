<?php
  include('conexion.php');

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





  $fecha = $_GET['fechaActual'];
  $fecha = date("Y-m-d",strtotime($fecha));
  $nuevaFecha = date("Y-m-d",strtotime('+30 day',strtotime($fecha)));
  switch ($_GET['tipo']) {
    case 'normal':
      $tipo = 1;
      $consulta = "SELECT * FROM  locales LEFT JOIN cliente_locales ON locales.id_local = cliente_locales.id_local WHERE tipo_local <> $tipo or `fecha_inicio` = '$fecha'";
      break;
    case 'class':
      $tipo = 2;
      $consulta = "SELECT * FROM  locales LEFT JOIN cliente_locales ON locales.id_local = cliente_locales.id_local WHERE tipo_local <> $tipo or `fecha_inicio` = '$fecha'";
      break;
    case 'ultra':
      $tipo = 3;
      $consulta = "SELECT * FROM `cliente_locales` right join locales ON cliente_locales.id_local = locales.id_local WHERE `fecha_pago`<> '' OR `tipo_local` <> 3";
      break;
    case 'super':
      $tipo = 4;
      $consulta = "SELECT * FROM `cliente_locales` right join locales ON cliente_locales.id_local = locales.id_local WHERE `fecha_pago`<> '' OR `tipo_local` <> $tipo";
      break;
    case 'master':
      $tipo = 5;
      $consulta = "SELECT * FROM `cliente_locales` right join locales ON cliente_locales.id_local = locales.id_local WHERE `fecha_pago`<> '' OR `tipo_local` <> $tipo";
      break;
    case 'promo':
      $tipo = 6;
      $consulta = "SELECT * FROM `cliente_locales` right join locales ON cliente_locales.id_local = locales.id_local WHERE `fecha_pago`<> '' OR `tipo_local` <> 6";
      break;
    default:
      # code...
      break;
  }


  $arreglo = array();
  $i = 0;
  $resultado = $conexionDb->personalizada($consulta);
  while($fila = mysqli_fetch_assoc($resultado)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode(utf8ize($arreglo));

?>
