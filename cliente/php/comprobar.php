<?php
		    include("conection.php");

            $usuario = $_POST['user'];
            $pass = $_POST['password'];

						$insertar1 = "select * from usuarios where username = '$usuario'";
            $consulta=mysqli_query($conexion,$insertar1);


            while ($row=mysqli_fetch_array($consulta)) {

              $id=$row['id_usuario'];
              $comprobacion=$row['username'];
              $contrasenia=$row['contrasenia'];
							$tekvia=$row['tekvia'];

            }

            if($comprobacion==$usuario && $pass==$contrasenia && $tekvia == 'on'){
                session_start();
                $_SESSION['SUide'] = $id;
                 echo "<meta HTTP-EQUIV='REFRESH' CONTENT='0;URL=../superuser/panel.php'/>";
            }

            else{
             echo "<meta HTTP-EQUIV='REFRESH' CONTENT='0;URL=../superuser/index.php'/>";
            }


?>
