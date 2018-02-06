
<?php
  include("../conection.php");
  mysqli_select_db($conexion);

  $nombre = $_POST['nombre'];
  $celular = $_POST['movil'];
  $correo = $_POST['email'];
  $domicilio = $_POST['domicilio'];
  $correom = strtolower($correo);

  $ife = $_FILES['ife'];
  $ifen = $_FILES['ife']['name'];

  $fecha = date("Y-m-d");

  $carpeta = "$fecha-$celular";
  if (!file_exists("$carpeta")) {
  mkdir($carpeta, 0777, true);
 }

  $destino1 = "$carpeta/"."$ifen";
  copy($_FILES['ife']['tmp_name'],$destino1);

  $insertar1 = "INSERT INTO clientes(nombre_cliente, telefono_cliente, celular_cliente, correo_cliente, domicilio_cliente, identificacion_cliente, contrato_cliente, tekvia)
  VALUES ('$nombre', ' ', '$celular', '$correom', '$domicilio', '$destino1', ' ', 'on')";
  mysqli_query($conexion,$insertar1);

  ini_set('display_errors',1);
require("../phpmailerlibs/class.phpmailer.php");
require("../phpmailerlibs/class.smtp.php");


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "tekviaprogramacion@gmail.com";
$mail->Password = "tekvia123";


$mail->From = "Mercadito Puerta del Sol";
$mail->FromName = "Mercadito Puerta del Sol";
$mail->Subject = "Bienvenido a Mercadito Puerta del Sol";
$mail->AltBody = "";
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
  <img style='max-height: 200px!important;max-width: 60px!important;height:50px!important;margin-top:10px!important;margin-left:5px!important;' src='http://mercaditopuertadelsol.com/cliente/resources/mercadito.png'>
</div>
<div style='color:#2E2E2E!important;font-family:sans-serif!important;margin:8px!important;font-size:12px!important;font-weight:normal!important;'>
<h1>Bienvenido a Mercadito Puerta del Sol</h1>
<div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
<h3>Tus datos de acceso son los siguientes:</h3><br>
<h3>Usuario: </h3><h2>$correom</h2>
<h3>Contrasena: </h3><h2>$celular</h2><br>
<div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
<h2>Ingresa ahora y comienza a rentar</h2><a style='text-decoration:none!important;' href='http://mercaditopuertadelsol.com/cliente/' target='_blank'><div style='margin-bottom:15px!important;text-align:center!important;margin-left:35px!important;background-color:orange!important;border-radius:5px!important;border-color:orange!important;color:#fff!important;font-size:20px!important;width:150px!important;'>IR</div></a>
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
$mail->AddReplyTo("$correom");
$mail->AddAddress("$correom");
$mail->IsHTML(true);
if(!$mail->Send()) {
echo "Error: " . $mail->ErrorInfo;
} else {
}
?>
