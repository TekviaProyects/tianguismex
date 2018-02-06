<?php
      include("../conection.php");
      $nick = $_POST["nick2"];
      $consulta = "SELECT * FROM clientes WHERE celular_cliente = '$nick'";
      $result = $conexion->query($consulta);

      if( $result->num_rows > 0)
        echo 0;
      else
        echo 1;
?>
