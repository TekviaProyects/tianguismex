<?php
include('../php/conexion.php');
session_start();
$id = $_SESSION['ide'];
$resultado = $conexionDb->personalizada("SELECT * FROM cliente_locales WHERE id_cliente = $ide");
$i = 0;
while($fila = mysqli_fetch_assoc($resultado)){
  $i++;
}
if($i == 0){
  echo "false";
}else{
  echo "true";
}
?>
