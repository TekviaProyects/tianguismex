<?php
           include("conection.php");
           mysqli_select_db($conexion);
 		       $correo = $_POST['correo'];

           $insertar1 = "INSERT INTO newsletter(correo) VALUES ('$correo')";
           mysqli_query($conexion,$insertar1);

           echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php?on=market'/>";

?>
