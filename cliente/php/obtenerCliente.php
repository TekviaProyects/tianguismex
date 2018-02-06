<?php

  include("conection.php");
  $localito = $_GET['variable'];
  mysqli_select_db($conexion);
  $i=0;
  $rawdata = array();
  $insertar3 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_inicio,fecha_pago,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE nombre_local = $localito";
  $consulta = mysqli_query($conexion,$insertar3);
  while($row = mysqli_fetch_assoc($consulta))
   {
       $rawdata[$i] = $row;
       $i++;
   }
   
  echo json_encode($rawdata);

?>
