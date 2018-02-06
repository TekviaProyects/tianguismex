<?php
  include('conexion.php');
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  try{
    $resultado = $conexionDb->buscar('clientes',"WHERE celular_cliente = '$telefono' AND correo_cliente = '$correo'");
    if(verificar($correo)){
      if($resultado->num_rows == 0){
        echo 'existencia';
      }else{
        while ($fila = mysqli_fetch_assoc($resultado)) {
          $estado = $fila['estado_cliente'];
          $ide = $fila['id_cliente'];
        }
        if($estado == 0){
          echo "estado";
        }else{
          session_start();
          $_SESSION['ide'] = $ide;



          echo 'true';
        }





      }
    }else{
      echo 'formato';
    }
  }catch(Exception $e){
    echo 'fallo';
  }





  //funcionesLogin

  function verificar($direccion)
  {
     $sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
     if(preg_match($sintaxis,$direccion))
        return true;
     else
       return false;
  }







?>
