<?php
//vendor de *composer* obtiene todos los archivos necesarios de la carpeta vendor
require "../../cliente/vendor/autoload.php";


/*
Esta clase genera las conexionses con el API de Twilio
Para el envio de SMS
*/
class conexionTextoV3{
  //Keys para acceso al API
  private $sid = "AC8da101d6b7b794bbca955be47a01b8b4";
  private $token = "48703ac1820b5d2e13c21a393284d630";
  //Objeto tipo cliente de twilio
  private $client;


  //Inicia el cliente de twilio con el sid y token necesarios para el acceso a la app
  public function __construct(){
    $this->client = new Twilio\Rest\Client($this->sid,$this->token);
  }
  //Esta funcion crea y envia un mensaje SMS, recibe el telefono en formato "+521xxxxxxxxxx" y el mensaje, ambos como cadenas de texto
  public function enviarMensaje($telefono,$mensaje){

    $message = $this->client->messages->create(
      '+521'.$telefono,//Sustituir por $telefono en produccion
      array(
        'from' => '+12107141665 ',
        'body' => $mensaje
      )
    );
    return $message->sid;
  }
}
