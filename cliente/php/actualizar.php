<?php
            include("conection.php");
            mysqli_select_db($conexion);
            $id= $_POST['id'];
            $nombre = $_POST['nombre'];
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            $domicilio = $_POST['domicilio'];
            $direccion = $_POST['dirife'];
            $ife = $_FILES['ife'];
            $ifen = $_FILES['ife']['name'];


            if(empty($_FILES['ife']['name'])){
              $insertar0 = "UPDATE clientes SET nombre_cliente='$nombre' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar0);
              $insertar1 = "UPDATE clientes SET celular_cliente='$celular' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar1);
              $insertar2 = "UPDATE clientes SET domicilio_cliente='$domicilio' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar2);
              $insertar3 = "UPDATE clientes SET correo_cliente='$correo' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar3);
            }
            else{
              $fecha = date("Y-m-d");

              $archivo = substr("$direccion", 0,22);

              $destino1 = "archivos/$archivo/"."$ifen";
              copy($_FILES['ife']['tmp_name'],$destino1);



              $insertar0 = "UPDATE clientes SET nombre_cliente='$nombre' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar0);
              $insertar1 = "UPDATE clientes SET celular_cliente='$celular' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar1);
              $insertar2 = "UPDATE clientes SET domicilio_cliente='$domicilio' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar2);
              $insertar3 = "UPDATE clientes SET correo_cliente='$correo' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar3);
              $insertar4 = "UPDATE clientes SET identificacion_cliente='$archivo$ifen' WHERE id_cliente='$id'";
              mysqli_query($conexion,$insertar4);
            }
?>

<html>
<head>
    <meta HTTP-EQUIV='REFRESH' CONTENT='5;URL=../panel/'/>
    <link rel="stylesheet" href="../assets/css/estiloForm.css">
</head>
<body class="bodyR">
  <div class="pormientras">

</div>
</body>
