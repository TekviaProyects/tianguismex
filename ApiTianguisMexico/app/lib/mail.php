<?php
namespace App\Lib;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require '../vendor/autoload.php';


class Mail{

  private $sender;

  public function __CONSTRUCT(){
    $this->sender = new PHPMailer(true);
    $this->configuration();
  }

  private function configuration(){
    $this->sender->IsSMTP();
    $this->sender->SMTPAuth = true;
    $this->sender->SMTPSecure = "ssl";
    $this->sender->Host = "smtp.gmail.com";
    $this->sender->Port = 465;

    //Datos de acceso al smtp
    $this->sender->Username = "tekviaprogramacion@gmail.com";
    $this->sender->Password = "tekvia123";

    //Correo e informacion del remitente
    $this->sender->setFrom('tekviaprogramacion@gmail.com','Tekvia');
  }
  public function sendMail($correo,$mensaje){
    $this->sender->Subject = "Formato de pago";
    $this->sender->Subject = "Mercadito puerta del sol";
    $this->sender->MsgHTML("
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
      <h1>Tianguis Mexico</h1>
      <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
      <h3>Hola!!!!</h3><br>
      $mensaje
      <div style='width:100%!important;height:10px!important;background-color:#2E2E2E!important;'></div>
      </div>
      </body>
      </html>
    ");
    $this->sender->AddReplyTo("$correo");
    $this->sender->AddAddress("$correo");
    $this->sender->IsHTML(true);
    //Envio de correo
    $this->sender->send();
  }

  public function checkMail($id,$correo){
    $mensaje = "<a href='https://tianguismexico.mx/ApiTianguisMexico/public/administrador/comprobar_cuenta/$id'>Comprobar correo</a>";
    $this->sendMail($correo,$mensaje);
  }





}
