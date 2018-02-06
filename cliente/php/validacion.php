<?php
		    include("conection.php");

            $correo = $_POST['user'];
            $password = $_POST['password'];
						$correom = strtolower($correo);

			       $insertar1 = "select * from clientes where correo_cliente = '$correom'";
            $consulta=mysqli_query($conexion,$insertar1);


            while ($row=mysqli_fetch_array($consulta)) {

              $id=$row['id_cliente'];
              $comprobacion=$row['correo_cliente'];
              $contrasenia=$row['celular_cliente'];
              $tekvia=$row['tekvia'];

            }

            if($comprobacion==$correom && $password==$contrasenia && $tekvia=='on'){
                session_start();
                $_SESSION['ide'] = $id;
                 echo "true";
            }

            else{
              echo "false";
            }
?>
