<?php
  require "../vendor/autoload.php";
  $correo = $_POST['correo'];
  $nombre = $_POST['nombre'];
  $telefono = $_POST['telefono'];
  $domicilio = $_POST['domicilio'];
  $archivo = $_FILES['archivo'];
  $tipoArchivo =  $_FILES['archivo']['type'];
  $nombreArchivo = $_FILES['archivo']['name'];
  $uid = uniqid();
  if(verificar($correo)){
    if(verificarNombre($nombre)){
      if(verificarDireccion($domicilio)){
        if(verificarDisponibilidadCorreo($correo)){
          if(verificarArchivo($tipoArchivo)){
            if(verficarNumero($telefono)){
              if(almacenarUsuario($nombre,$telefono,$correo,$domicilio,$archivo,$nombreArchivo,$uid)){
                enviarCorreo($correo,$uid);
                echo "true";
              }else{
                echo "otro";
              }
            }else{
              echo "exTel";
            }
          }else{
            echo "archivo";
          }
        }else{
          echo "existencia";
        }
      }else{
        echo "formato";
      }
    }else{
      echo "formato";
    }
  }else{
    echo "formato";
  }


//funciones

function verificar($direccion)
{
   $sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
   if(preg_match($sintaxis,$direccion))
      return true;
   else
     return false;
}
function verificarNombre($nombre){
  $sintaxis="#^[a-zA-ZñÑáéíóúÁÉÍÓÚ[:space:]]*$#";
  if(preg_match($sintaxis,$nombre))
     return true;
  else
    return false;
}
function verificarDireccion($direccion){
  $sintaxis="#^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ[:space:]\.]*$#";
  if(preg_match($sintaxis,$direccion))
     return true;
  else
    return false;
}
function verificarDisponibilidadCorreo($correo){
  include_once('conexion.php');
  $resultado = $conexionDb->buscar('clientes',"WHERE correo_cliente = '$correo'");
  unset($conexionDb);
  if($resultado->num_rows == 0)
    return true;
  else
    return false;

}
function verificarArchivo($tipoArchivo){
  if($tipoArchivo == "image/x-png"
    || $tipoArchivo == "image/png"
    || $tipoArchivo == "image/gif"
    || $tipoArchivo == "image/gif"
    || $tipoArchivo == "image/pjpeg"
    || $tipoArchivo == "image/jpeg")
      return true;
  else
      return false;
}
function verficarNumero($numero){
  include('conexionTextoV3.php');
  $mensajero = new conexionTextoV3();
  try{
    $mensajero->enviarMensaje($numero,'Este mensaje es para verificar su numero, gracias');
    return true;
  }catch(Exception $e){
    return false;
  }
}
function almacenarUsuario($nombre,$celular,$correo,$domicilio,$archivo,$nombreArchivo,$uid){
  include_once('dbmysqli.php');
  $conn = new dbmysqli();
  $campos = "nombre_cliente, telefono_cliente, celular_cliente, correo_cliente, domicilio_cliente, identificacion_cliente, contrato_cliente, tekvia, estado_cliente, uid_cliente";
  $fecha = date("Y-m-d");
  $carpeta = "archivos/$fecha-$celular";
  if(!file_exists("$carpeta")){
    mkdir($carpeta,0777,true);
  }
  $dir = "$fecha-$celular";
  $destino1 = "$dir/"."$nombreArchivo";
  copy($_FILES['archivo']['tmp_name'],$destino1);

  $datos = "'$nombre', ' ', '$celular', '$correo', '$domicilio', '$destino1', ' ', 'on',0,'$uid'";
  $insertar = $conn->insertar('clientes',$campos,$datos);
  if($insertar == 'true'){
    return true;
  }else{
    return false;
  }




}

function enviarCorreo($correo,$uid){
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;

  //Datos de acceso al smtp
  $mail->Username = "tekviaprogramacion@gmail.com";
  $mail->Password = "tekvia123";

  //Correo e informacion del remitente
  $mail->setFrom('tekviaprogramacion@gmail.com','Tekvia');
  //Datos y contenido del correo
  $mail->Subject = "Formato de pago";
  $mail->Subject = "Mercadito puerta del sol";
  $mail->MsgHTML("
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset='utf-8'>
        <title></title>
      </head>
      <body style='background-color:#F2F2F2!important;width:92%!important;margin-left:4px!important;position:absolute!important;'>
    <div style='color:#2E2E2E!important;font-family:sans-serif!important;font-size:12px!important;font-weight:normal!important;'>
    <div style='background-color:orange!important;width:100%!important;height:75px!important;'>
      <img style='height:50px!important;max-width: 60px!important;margin-top:10px!important;margin-left:5px!important;' src='http://mercaditopuertadelsol.com/cliente/resources/mercadito.png'>
    </div>
    <div style='color:#2E2E2E!important;font-family:sans-serif!important;margin:8px!important;font-size:12px!important;font-weight:normal!important;'>
    <h1>Mercadito Puerta del Sol</h1>
    <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
    <h3>Hola!!!!</h3><br>
    <h3>Mercadito Puerta del Sol te invita a confirmar tu registro dando click en el siguiente boton</h3><br>
    <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
    <h2>Ingresa ahora</h2><a style='text-decoration:none!important;' href='http://mercaditopuertadelsol.com/cliente/php/confirmarCorreo.php?codigo=$uid' target='_blank'><div style='margin-bottom:15px!important;text-align:center!important;margin-left:35px!important;background-color:orange!important;border-radius:5px!important;border-color:orange!important;color:#fff!important;font-size:20px!important;width:150px!important;'>IR</div></a>
    </div>
    <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div><br>
    <div style='background-color:#2E2E2E!important;height:45px!important;width:100%!important;text-align:center!important;color:#fff!important;font-size:11px!important;'>
      <img style='height:20px!important; margin-top:8px!important;' src='http://mercaditopuertadelsol.com/cliente/resources/tekviacloud.png'>
      <br>Design by Tekvia
    </div>
    <div style='width:100%!important;height:10px!important;background-color:#2E2E2E!important;'></div>
    </div>
    </body>
    </html>
  ");
  $mail->AddReplyTo("$correo");
  $mail->AddAddress("$correo");
  $mail->IsHTML(true);


  //Envio de correo
  $mail->send();
  unset($mail);
}

?>
