<?php
  include("conection.php");
  mysqli_select_db($conexion);
  $i=0;
  $rawdata = array();
  $insertar3 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_inicio,fecha_pago,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE CURDATE() >= fecha_inicio AND CURDATE() <= fecha_pago AND tipo_pago = 1 OR CURDATE() = fecha_inicio";
  $consulta = mysqli_query($conexion,$insertar3);
  while($row = mysqli_fetch_assoc($consulta))
   {
       $rawdata[$i] = $row;
       $i++;
   }

  echo json_encode($rawdata);

?>
