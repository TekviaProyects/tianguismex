<?php
  include('../../cliente/php/conexion.php');
  $user = $_GET['user'];
  $pass = $_GET['pass'];
  $consulta = $conexionDb->buscar('usuarios',"WHERE username = '$user' AND contrasenia = '$pass'");
  $contador = 0;
  $tipo = "";
  while($fila = mysqli_fetch_assoc($consulta)){
    $tipo = $fila['tipo_usuario'];
    $contador++;
  }
  if($contador > 0){
    session_start();
    $_SESSION['activo'] = 1;
    $_SESSION['tipo'] = $tipo;
    echo "true";
  }else{
    echo "false";
  }
?>
