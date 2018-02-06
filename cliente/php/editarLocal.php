<?php
            include("conection.php");
            mysqli_select_db($conexion);
            $idmod = $_POST['idmod'];
            $nuevomod = $_POST['nuevomod'];

            $insertar0 = "select * from locales WHERE nombre_local = '$nuevomod'";
            $result = $conexion->query($insertar0);

            if( $result->num_rows > 0){
              echo 'false';
            }else{
              echo 'true';
              $insertar1 = "UPDATE locales SET nombre_local='$nuevomod' WHERE id_local='$idmod'";
              mysqli_query($conexion,$insertar1);
              }
?>
