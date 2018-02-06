<?php
      include("../conection.php");
      $nick = $_POST["nick"];
      $consulta = "SELECT * FROM clientes WHERE correo_cliente = '$nick'";
      $result = $conexion->query($consulta);

      if( $result->num_rows > 0)
        echo 0;
      else
        echo 1;
?>
