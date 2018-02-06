<?php
  include('dbmysqli.php');
  $conexionDb = new dbmysqli();


  $idOrden = $_GET['id_orden'];

  $resultado = $conexionDb->personalizada("SELECT * FROM ordenes_pago WHERE id_orden = $idOrden");

  $link = "";
  while($fila = mysqli_fetch_assoc($resultado)){
    $link = $fila['openpay_url'];
  }

  echo $link;

?>
