<?php
require "../vendor/autoload.php";
require_once('Googl.class.php');
include('conexion.php');
include('conexionTextoV3.php');
include('OpenpayObject.php');


$mensajero = new conexionTextoV3();
$open = new OpenpayObject();
session_start();
$id_cliente = $_SESSION['ide'];
$respuesta = 'false';
$tipo = $_GET['tipo'];
$fechaInicial = $_GET['fechaActual'];
$json = $_GET['json'];
$json = json_decode($json);
$falso = "";
$tabla = "cliente_locales";



function borrarFallido($id_local_fallo,$id_usuario_fallo){
  $condicion = "id_usuario = $id_usuario_fallo AND id_local = $id_local_fallo";
  $eliminar = $conexionDb->eliminar('cliente_locales',$condicion);
}


$fechaInicial = date("Y-m-d",strtotime($fechaInicial));
$resultado = $conexionDb->buscar('clientes',"WHERE id_cliente = $id_cliente" );
while($fila = mysqli_fetch_assoc($resultado)){
  $correo = $fila['correo_cliente'];
  $telefono = $fila['celular_cliente'];
  $nombre_cliente = $fila['nombre_cliente'];
}
$cliente = array(
  'name'=>$nombre_cliente,
  'phone_number'=>$telefono,
  'email'=>$correo
);
switch ($tipo) {
  case 'normal':
  $descripcion1 = "Normal x 1 dia";
  $precio = 50;
  $fechaI = date('Y-m-d');
  $horaI = "23:59:59-05:00";
  $fechaIso = $fechaI."T".$horaI;
  $caducidad = $fechaIso;
  $fechaPago = date("Y-m-d",strtotime($_GET['fechaActual']));

  foreach ($json as $key => $value) {
    $respuesta = "";
    $campos = "id_cliente,id_local,tipo_pago,fecha_pago,fecha_inicio";
    $resultado = $conexionDb->buscar('locales',"WHERE nombre_local = '$value'");
    while($fila = mysqli_fetch_assoc($resultado)){
      $id_local = $fila['id_local'];
    }
    $datos = "$id_cliente,$id_local,1,'$fechaPago','$fechaInicial'";
    $respuesta = $conexionDb->insertar($tabla,$campos,$datos);
    if($respuesta == "true"){
      try{
        $descripcion = $descripcion1." por local $value";
        $cargo = $open->crearCargo($precio,$descripcion,$cliente,$caducidad);
        $link = "https://sandbox-dashboard.openpay.mx/paynet-pdf/mtuapgdbiyibi6mlfbjd/".$cargo->payment_method->reference;
        $googl = new Googl('AIzaSyC44Ry7bvkkkX8FTHSNnVXfKeB5YTTfAFI');
        $link = $googl->shorten($link);
        unset($googl);
        $tabla = "ordenes_pago";
        $campos = "openpay_url,id_openpay";
        $datos = "'$link','$cargo->id'";
        $insercion = $conexionDb->insertar($tabla,$campos,$datos);
        $id_orden = $conexionDb->conn->insert_id;
        $tabla = "cliente_locales";
        $campos = "id_orden = ".$id_orden;
        $condicion = "WHERE id_cliente = $id_cliente AND id_local = $id_local";
        $modificacion = $conexionDb->modificar($tabla,$campos,$condicion);

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
        $mail->send();
        unset($mail);
        $mensaje = "Mercadito Puerta del Sol te invita a realizar el pago haz clic en el link  ".$link;
        $mensajero->enviarMensaje($telefono,$mensaje);
        $respuesta = "true";
      }catch(Exception $e){
        $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
        borrarFallido($id_local,$id_cliente);
      }catch (OpenpayApiTransactionError $e) {
        $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
        borrarFallido($id_local,$id_cliente);
      }catch (OpenpayApiRequestError $e) {
        $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
        borrarFallido($id_local,$id_cliente);
      } catch (OpenpayApiConnectionError $e) {
        $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
        borrarFallido($id_local,$id_cliente);
      } catch (OpenpayApiAuthError $e) {
        $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
        borrarFallido($id_local,$id_cliente);
      } catch (OpenpayApiError $e) {
        $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
        borrarFallido($id_local,$id_cliente);
      }

    }
  }
    break;
  case 'class':
    $descripcion1 = "Class x 1 dia";
    $precio = 100;
    $fechaI = date('Y-m-d');
    $horaI = "23:59:59-05:00";
    $fechaIso = $fechaI."T".$horaI;
    $caducidad = $fechaIso;
    $fechaPago = date("Y-m-d",strtotime($_GET['fechaActual']));

    foreach ($json as $key => $value) {
      $respuesta = "";
      $campos = "id_cliente,id_local,tipo_pago,fecha_pago,fecha_inicio";
      $resultado = $conexionDb->buscar('locales',"WHERE nombre_local = '$value'");
      while($fila = mysqli_fetch_assoc($resultado)){
        $id_local = $fila['id_local'];
      }
      $datos = "$id_cliente,$id_local,2,'$fechaPago','$fechaInicial'";
      $respuesta = $conexionDb->insertar($tabla,$campos,$datos);
      if($respuesta == "true"){
        try{
          $descripcion = $descripcion1." por local $value";
          $cargo = $open->crearCargo($precio,$descripcion,$cliente,$caducidad);
          $link = "https://sandbox-dashboard.openpay.mx/paynet-pdf/mtuapgdbiyibi6mlfbjd/".$cargo->payment_method->reference;
          $googl = new Googl('AIzaSyC44Ry7bvkkkX8FTHSNnVXfKeB5YTTfAFI');
          $link = $googl->shorten($link);
          unset($googl);
          $tabla = "ordenes_pago";
          $campos = "openpay_url,id_openpay";
          $datos = "'$link','$cargo->id'";
          $insercion = $conexionDb->insertar($tabla,$campos,$datos);
          $id_orden = $conexionDb->conn->insert_id;
          $tabla = "cliente_locales";
          $campos = "id_orden = ".$id_orden;
          $condicion = "WHERE id_cliente = $id_cliente AND id_local = $id_local";
          $modificacion = $conexionDb->modificar($tabla,$campos,$condicion);

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
          $mail->send();
          unset($mail);
          $mensaje = "Mercadito Puerta del Sol te invita a realizar el pago haz clic en el link ".$link;
          $mensajero->enviarMensaje($telefono,$mensaje);
          $respuesta = "true";

        }catch(Exception $e){
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        }catch (OpenpayApiTransactionError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        }catch (OpenpayApiRequestError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        } catch (OpenpayApiConnectionError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        } catch (OpenpayApiAuthError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        } catch (OpenpayApiError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        }

      }
    }
    break;
  case 'ultra':
    $descripcion1 = "Ultra x 1 mes";
    $precio = 900;


    $fechaA = $fechaInicial;
    $fechadb = $fechaA;
    // Pasa la fecha de la DB a epoch y le aqgrega 7 días
    $tmp = explode('-',$fechadb);
    $epochdb = mktime(0,0,0,$tmp[0],$tmp[1],$tmp[2]);
    // pasa la fecha actual a epoch
    $fecha = date("Y-m-d");
    $tmp = explode('-',$fecha);
    $epoch = mktime(0,0,0,$tmp[0],$tmp[1],$tmp[2]+3);
    if( $epoch > $epochdb) {
      $fechaI = date('Y-m-d');
      $horaI = "23:59:59-05:00";
      $fechaIso = $fechaI."T".$horaI;
      $caducidad = $fechaIso;
    } else {
       //aqui va
       $nuevafecha = strtotime ( '+3 day' , strtotime ( date("c") ) ) ;
       $caducidad = date("c",$nuevafecha);

    }

    foreach ($json as $key => $value) {
      $respuesta = "";
      $campos = "id_cliente,id_local,tipo_pago,fecha_pago,fecha_inicio";
      $resultado = $conexionDb->buscar('locales',"WHERE nombre_local = '$value'");
      while($fila = mysqli_fetch_assoc($resultado)){
        $id_local = $fila['id_local'];

      }
      $datos = "$id_cliente,$id_local,3,'$fechaInicial','$fechaInicial'";
      $respuesta = $conexionDb->insertar($tabla,$campos,$datos);
      if($respuesta == "true"){
        try{
          $descripcion = $descripcion1." por local $value";
          $cargo = $open->crearCargo($precio,$descripcion,$cliente,$caducidad);
          $link = "https://sandbox-dashboard.openpay.mx/paynet-pdf/mtuapgdbiyibi6mlfbjd/".$cargo->payment_method->reference;
          $googl = new Googl('AIzaSyC44Ry7bvkkkX8FTHSNnVXfKeB5YTTfAFI');
          $link = $googl->shorten($link);
          unset($googl);
          $tabla = "ordenes_pago";
          $campos = "openpay_url,id_openpay";
          $datos = "'$link','$cargo->id'";
          $insercion = $conexionDb->insertar($tabla,$campos,$datos);
          $id_orden = $conexionDb->conn->insert_id;
          $tabla = "cliente_locales";
          $campos = "id_orden = ".$id_orden;
          $condicion = "WHERE id_cliente = $id_cliente AND id_local = $id_local";
          $modificacion = $conexionDb->modificar($tabla,$campos,$condicion);

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
          $mail->send();
          unset($mail);

          $mensaje = "Mercadito Puerta del Sol te invita a realizar el pago haz clic en el link  ".$link;
          $mensajero->enviarMensaje($telefono,$mensaje);
          $respuesta = "true";

        }catch(Exception $e){
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        }catch (OpenpayApiTransactionError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        }catch (OpenpayApiRequestError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        } catch (OpenpayApiConnectionError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        } catch (OpenpayApiAuthError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        } catch (OpenpayApiError $e) {
          $respuesta = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
          borrarFallido($id_local,$id_cliente);
        }

      }
    }
    break;

  default:
    # code...
    break;
}


echo $respuesta;
?>
