<?php
  include("conection.php");
  mysqli_select_db($conexion);

  $correo = $_POST['correo'];
  $correom = strtolower($correo);


  $insertar0 = "select * from clientes where correo_cliente='$correom'";
  $consulta=mysqli_query($conexion,$insertar0);
  while ($row=mysqli_fetch_array($consulta)){
  $celular=$row['celular_cliente'];
  $llave=$row['tekvia'];
  }

if($llave=='on'){
  echo "true";
  ini_set('display_errors',1);
  require("phpmailerlibs/class.phpmailer.php");
  require("phpmailerlibs/class.smtp.php");


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
$mail->Subject = "Recuperacion Cuenta Mercadito Puerta del Sol";
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
  <img style='height:50px!important;max-width: 60px!important;margin-top:10px!important;margin-left:5px!important;' src='http://mercaditopuertadelsol.com/cliente/resources/mercadito.png'>
</div>
<div style='color:#2E2E2E!important;font-family:sans-serif!important;margin:8px!important;font-size:12px!important;font-weight:normal!important;'>
<h1>Mercadito Puerta del Sol</h1>
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

}else{

}
?>
