<?php
//Librerias y archivos requeridos
date_default_timezone_set('America/Mexico_City');
require "../vendor/autoload.php";
require_once('Googl.class.php');
include('dbmysqli.php');
include('conexionTextoV3.php');
include('OpenpayObject.php');


function compararFechas($fecha1 , $fecha2){
  $valoresPrimera = explode("-",$fecha1);
  $valoresSegunda = explode("-",$fecha2);

  $anioPrimero = $valoresPrimera[0];
  $mesPrimero = $valoresPrimera[1];
  $diaPrimero = $valoresPrimera[2];

  $anioSegundo = $valoresSegunda[0];
  $mesSegundo = $valoresSegunda[1];
  $diaSegundo = $valoresSegunda[2];

  $diasPrimeraJuliano = gregoriantojd($mesPrimero,$diaPrimero,$anioPrimero);
  $diasSegundaJuliano = gregoriantojd($mesSegundo,$diaSegundo,$anioSegundo);

  if(!checkdate($mesPrimero, $diaPrimero, $anioPrimero)){
    return 0;
  }elseif(!checkdate($mesSegundo, $diaSegundo, $anioSegundo)){
    return 0;
  }else{
    return  $diasPrimeraJuliano - $diasSegundaJuliano;
  }
}





$error_flag = 0;
$id_orden_error = 0;
$id_orden = 0;




$time = -3600;
try{
  $conexionDb = new dbmysqli();
  $mensajero = new conexionTextoV3();
  $open = new OpenpayObject();



  //Obtencion de datos de sesion
  session_start();
  $id_cliente = $_SESSION['ide'];


  //Obtencion de datos get
  $tipo = $_GET['tipo'];
  $fechaInicial = $_GET['fechaActual'];
  $json = $_GET['json'];


  //inicializacion de variables necesarias
  $respuesta = 'false';
  $json = json_decode($json);
  $estado = "";
  $tabla = "cliente_locales";
  $fechaInicial = date("Y-m-d",strtotime($fechaInicial));


  //Obtener datos del usuario
  $resultado = $conexionDb->buscar('clientes',"WHERE id_cliente = $id_cliente" );
  while($fila = mysqli_fetch_assoc($resultado)){
    $correo = $fila['correo_cliente'];
    $telefono = $fila['celular_cliente'];
    $nombre_cliente = $fila['nombre_cliente'];
  }


  //Creacion del objeto cliente para Openpay

  $cliente = array(
    'name'=>$nombre_cliente,
    'phone_number'=>$telefono,
    'email'=>$correo
  );


  //Colocacion de datos por tipo de local

  switch($tipo){
    case 'normal':
      $tipoN = 1;
      $descripcion = "Normal x 1 dia locales:";
      $precio = 50;
      $fechaI = date('Y-m-d');
      $fechaI = date('Y-m-d',strtotime($fechaI));

      $horaI = "23:59:59-05:00";
      $fechaIso = $fechaI."T".$horaI;
      $caducidad = $fechaIso;
      $caducidadBd = $caducidad;
      $fechaPago = date("Y-m-d",strtotime($_GET['fechaActual']));
      break;
    case 'class':
      $tipoN = 2;
      $descripcion = "Class x 1 dia locales:";
      $precio = 100;
      $fechaI = date('Y-m-d');
      $fechaI = date('Y-m-d',strtotime($fechaI));
      $horaI = "23:59:59-05:00";
      $fechaIso = $fechaI."T".$horaI;
      $caducidad = $fechaIso;
      $caducidadBd = $caducidad;
      $fechaPago = date("Y-m-d",strtotime($_GET['fechaActual']));
      break;
    case 'ultra':
      $tipoN = 3;
      $descripcion = "Ultra x 1 mes locales:";
      $precio = 900;
      $fecha1 = date('Y-m-d');
      $dif = compararFechas($fecha1,$fechaInicial);
      if($dif < 0){
        if($dif > -4 && $dif <= 0){
          $caducidad = strtotime('-1 day',strtotime($fechaInicial));
          $caducidad = date('Y-m-d',$caducidad);
          $caducidadBd = $caducidad;
          $caducidad = $caducidad.'T'."23:59:59-05:00";
        }else{
          $caducidad = strtotime('+3 day',strtotime($fecha1));
          $caducidad = date('Y-m-d',$caducidad);
          $caducidadBd = $caducidad;
          $caducidad = $caducidad.'T'."23:59:59-05:00";
        }
      }else{
        $caducidad = strtotime('+3 day',strtotime($fecha1));
        $caducidad = date('Y-m-d',$caducidad);
        $caducidadBd = $caducidad;
        $caducidad = $caducidad.'T'."23:59:59-05:00";
      }
      $fechaPago = $fechaInicial;
      break;
    case 'super':
      $tipoN = 4;
      $descripcion = "Super x 1 mes locales:";
      $precio = 1000;
      $fecha1 = date('Y-m-d');
      $dif = compararFechas($fecha1,$fechaInicial);
      if($dif < 0){
        if($dif > -4 && $dif <= 0){
          $caducidad = strtotime('-1 day',strtotime($fechaInicial));
          $caducidad = date('Y-m-d',$caducidad);
          $caducidadBd = $caducidad;
          $caducidad = $caducidad.'T'."23:59:59-05:00";
        }else{
          $caducidad = strtotime('+3 day',strtotime($fecha1));
          $caducidad = date('Y-m-d',$caducidad);
          $caducidadBd = $caducidad;
          $caducidad = $caducidad.'T'."23:59:59-05:00";
        }
      }else{
        $caducidad = strtotime('+3 day',strtotime($fecha1));
        $caducidad = date('Y-m-d',$caducidad);
        $caducidadBd = $caducidad;
        $caducidad = $caducidad.'T'."23:59:59-05:00";
      }
      $fechaPago = $fechaInicial;
      break;
    case 'master':
      $tipoN = 5;
      $descripcion = "Master x 1 mes locales:";
      $precio = 1800;



      $fecha1 = date('Y-m-d');
      $dif = compararFechas($fecha1,$fechaInicial);
      if($dif < 0){
        if($dif > -4 && $dif <= 0){
          $caducidad = strtotime('-1 day',strtotime($fechaInicial));
          $caducidad = date('Y-m-d',$caducidad);
          $caducidadBd = $caducidad;
          $caducidad = $caducidad.'T'."23:59:59-05:00";
        }else{
          $caducidad = strtotime('+3 day',strtotime($fecha1));
          $caducidad = date('Y-m-d',$caducidad);
          $caducidadBd = $caducidad;
          $caducidad = $caducidad.'T'."23:59:59-05:00";
        }
      }else{
        $caducidad = strtotime('+3 day',strtotime($fecha1));
        $caducidad = date('Y-m-d',$caducidad);
        $caducidadBd = $caducidad;
        $caducidad = $caducidad.'T'."23:59:59-05:00";
      }



      $fechaPago = $fechaInicial;
      break;
  }


  $descripcion1 = "";
  $precioTotal = 0;
  foreach ($json as $key => $value) {
    $precioTotal += $precio;
    $descripcion1 .= " ".$value." ";
  }
  $descripcion = $descripcion.$descripcion1;
  $cargo = $open->crearCargo($precioTotal,$descripcion,$cliente,$caducidad);
  $link = "https://dashboard.openpay.mx/paynet-pdf/mxjw8mwssvb49ecuirzz/".$cargo->payment_method->reference;
  $original = $link;
  $googl = new Googl('AIzaSyC44Ry7bvkkkX8FTHSNnVXfKeB5YTTfAFI');
  $link = $googl->shorten($link);
  unset($googl);
  $tabla = "ordenes_pago";
  $campos = "openpay_url,id_openpay";
  $datos = "'$link','$cargo->id'";
  $insercion = $conexionDb->insertar($tabla,$campos,$datos);
  $id_orden = $conexionDb->conn->insert_id;
  $tabla = "cliente_locales";
  foreach ($json as $key => $value) {
    $resultado = $conexionDb->buscar('locales',"WHERE nombre_local = '$value'");
    while($fila = mysqli_fetch_assoc($resultado)){
      $id_local = $fila['id_local'];
    }
    $fecha_pago = strtotime('-1 day',strtotime($fechaInicial));
    $fecha_pago = date('Y-m-d',$fecha_pago);
    $campos = "id_orden = $id_orden , caducidad = '$caducidadBd'";
    $condicion = "WHERE id_cliente = $id_cliente AND id_local = $id_local";
    $respuesta = $conexionDb->modificar('cliente_locales',$campos,$condicion);
  }





  //Procedimiento de envio de correo por medio de phpmailer
  $mail = new PHPMailer();

  //modificar en caso de utilizar un correo distinto a gmail
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
    <h3>Mercadito Puerta del Sol te invita a realizar el pago haz clic en el link  ".$link."</h3><br>
    <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
    <h2>Ingresa ahora</h2><a style='text-decoration:none!important;' href='http://mercaditopuertadelsol.com/cliente/' target='_blank'><div style='margin-bottom:15px!important;text-align:center!important;margin-left:35px!important;background-color:orange!important;border-radius:5px!important;border-color:orange!important;color:#fff!important;font-size:20px!important;width:150px!important;'>IR</div></a>
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
  $envio = $mail->send();
  unset($mail);
  $mensaje = "Mercadito Puerta del Sol te invita a realizar el pago haz clic en el link ".$link;
  $men = $mensajero->enviarMensaje($telefono,$mensaje);
  $respuesta = $original;







}catch(Exception $e){
  $id_orden_error = $id_orden;
  $eliminar = $conexionDb->eliminar('cliente_locales',"id_orden = $id_orden_error");

  $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
}

echo $respuesta;
?>
