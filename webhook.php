<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	//Este archivo recibe las notificaciones de openpay y realiza el procedimiento especifico
	//Esta preparado apra que se añadan mas opciones de ser necesarias
	$timezone = "America/Mexico_City";
	date_default_timezone_set($timezone);
	// include ('php/conection/conection.php');
	mysqli_report(MYSQLI_REPORT_STRICT);
	try{
		$conexion = mysqli_connect("localhost","c0630048_new","mi69nuFAnu","c0630048_new");
	} catch (mysqli_sql_exception $e) {
		$resultado = $e;
	}

	require ("plugins/phpmailerlibs/class.phpmailer.php");
	require ("plugins/phpmailerlibs/class.smtp.php");


//Correo al que decia recibir el codigo de verificacion puede cambiar de ser necesario
		// $correo = "fertekvia@gmail.com";
		// $mail = new PHPMailer();
		// $mail -> IsSMTP();
		// $mail -> SMTPAuth = true;
		// $mail -> SMTPSecure = "ssl";
		// $mail -> Host = "smtp.gmail.com";
		// $mail -> Port = 465;
		// $mail -> Username = "tekviaprogramacion@gmail.com";
		// $mail -> Password = "Biagsa321";
// 
		// //Correo e informacion del remitente
		// $mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
		// //Datos y contenido del correo
		// $mail -> Subject = "Prueba de webhook";
		// $mail -> AltBody = "Esta es la fecha";
		// $algo = file_get_contents('php://input');
		// // $algo = json_decode($algo);
		// // $algo = "<pre>". var_dump($algo)."</pre>";var_dump($algo)
		// $mail -> MsgHTML($algo);
		// $mail -> AddReplyTo("$correo");
		// $mail -> AddAddress("$correo");
		// $mail -> IsHTML(true);
// 
		// //Envio de correo
		// if (!$mail -> send()) {
			// echo 'Message could not be sent.';
			// echo 'Mailer Error: ' . $mail -> ErrorInfo;
		// } else {
			// echo 'Message has been sent';
		// }
		// return;




	$obj = file_get_contents('php://input');
	$json = json_decode($obj);
	$tipo = $json->type;
	$id = $json->transaction->id;
	$resp = array();
	$resp['json'] = $obj;
	
	
//Selector que permite realizar una accion dependiendo el tipo de notificacion recibida
	switch ($tipo) {
		//Procedimiento para notificacion de tipo cargo completado
		case 'charge.succeeded' :
			if ($json -> transaction -> status == 'completed') {
			//obtenemos el id de opnepay de la orden de pago
				$id_orden_open = $json -> transaction -> id;
			  	$html = '';
				$date = date('Y-m-d H:i:s');
				
			  	try {
					$update_order = "UPDATE
					  					orders
					  				SET
					  					status = 1,
					  					pay_date = '".$date."'
					  				WHERE
					  					openpay_id = '".$id_orden_open."'";
					$resultado = mysqli_query($conexion, $update_order);
					
					$update_renew = "UPDATE
					  					renovations
					  				SET
					  					status = 1
					  				WHERE
					  					openpay_id = '".$id_orden_open."'";
					$res_renew = mysqli_query($conexion, $update_renew);
					
					$update_his = "	UPDATE
										historical
									SET
										status = 1
									WHERE
										order_id = (SELECT
													id
												FROM
													orders
												WHERE
													openpay_id = '".$id_orden_open."')";
					$res_his = mysqli_query($conexion, $update_his);
					$resp['res_his'] = $res_his;
				} catch (mysqli_sql_exception $e) {
					$resultado = $e;
					$correo = "fertekvia@gmail.com";
					$mail = new PHPMailer();
					$mail -> IsSMTP();
					$mail -> SMTPAuth = true;
					$mail -> SMTPSecure = "ssl";
					$mail -> Host = "smtp.gmail.com";
					$mail -> Port = 465;
					$mail -> Username = "tekviaprogramacion@gmail.com";
					$mail -> Password = "Biagsa321";
					$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
					$mail -> Subject = "Error en script";
					$mail -> AltBody = "Esta es la fecha";
					$algo = json_encode($e);
					$mail -> MsgHTML($algo);
					$mail -> AddReplyTo("$correo");
					$mail -> AddAddress("$correo");
					$mail -> IsHTML(true);
					
					if (!$mail -> send()) {
						$resp['error_mail'] = json_encode('Mailer Error: ' . $mail -> ErrorInfo);
					} else {
						$resp['send_mail'] = json_encode('Message has been sent');
					}
					
					$resp['error_res_his'] = json_encode("Error en script".$e);
					return $resp;
				}
				
			  	try {
					$q_user_mail = "SELECT
					  					c.correo_cliente
					  				FROM
					  					clientes c
					  				LEFT JOIN
					  						orders o
					  					ON
					  						o.client_id = c.id_cliente
					  				WHERE
					  					o.openpay_id = '".$id_orden_open."'";
					$user_mail = mysqli_query($conexion, $q_user_mail);
					$resp['user_mail'] = json_encode($user_mail);
					
					while ($fila = mysqli_fetch_assoc($user_mail)) {
						$correo = $fila['correo_cliente'];
					}
					
					if (empty($correo)) {
						$encode = json_encode($json);
						$correo = 'fertekvia@gmail.com';
						$html = 'Correo no encontrado:<br>'.$encode;
					}
				} catch (mysqli_sql_exception $e) {
					$correo = $e;
					$correo = "fertekvia@gmail.com";
					$mail = new PHPMailer();
					$mail -> IsSMTP();
					$mail -> SMTPAuth = true;
					$mail -> SMTPSecure = "ssl";
					$mail -> Host = "smtp.gmail.com";
					$mail -> Port = 465;
					$mail -> Username = "tekviaprogramacion@gmail.com";
					$mail -> Password = "Biagsa321";
					$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
					$mail -> Subject = "Error en correo";
					$mail -> AltBody = "Esta es la fecha";
					$algo = json_encode($json);
					$mail -> MsgHTML($e);
					$mail -> AddReplyTo("$correo");
					$mail -> AddAddress("$correo");
					$mail -> IsHTML(true);
					
					if (!$mail -> send()) {
						$resp['error_mail'] = json_encode('Mailer Error: ' . $mail -> ErrorInfo);
					} else {
						$resp['send_mail'] = json_encode('Message has been sent');
					}
					
					$resp['error_send_user_mail'] = json_encode("Error en script".$e);
					return $resp;
				}
				
				if (empty($html)) {
					$html = "Tu siguiente compra se completo:<br>
						        ".$json -> transaction -> description."<br>
						        Por el monto de $".$json -> transaction -> amount;
				}
				
			// Configuration mail
				$mail = new PHPMailer();
				$mail -> IsSMTP();
				$mail -> SMTPAuth = true;
				$mail -> SMTPSecure = "ssl";
				$mail -> Host = "smtp.gmail.com";
				$mail -> Port = 465;
				$mail -> Username = "tekviaprogramacion@gmail.com";
				$mail -> Password = "Biagsa321";
				$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
				
			// Mail message
				$mail -> Subject = "Confirmacion de pago";
				$mail -> AltBody = "Confirmacion de pago";
				$mail -> MsgHTML($html);
				
			// More configuration mail
				$mail -> AddReplyTo("$correo");
				$mail -> AddAddress("$correo");
				$mail -> IsHTML(true);
				
			//Envio de correo
				try {
					$mail -> send();
				} catch(phpmailerException $e) {
					$resp['error_mail'] = json_encode("Error en script".$e);
					return $resp;
				}
			} elseif ($json -> transaction -> status == 'failed') {
				$correo = "fertekvia@gmail.com";
				$mail = new PHPMailer();
				$mail -> IsSMTP();
				$mail -> SMTPAuth = true;
				$mail -> SMTPSecure = "ssl";
				$mail -> Host = "smtp.gmail.com";
				$mail -> Port = 465;
				$mail -> Username = "tekviaprogramacion@gmail.com";
				$mail -> Password = "Biagsa321";
				$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
				$mail -> Subject = "Funcion de cronJob";
				$mail -> AltBody = "Esta es la fecha";
				$algo = json_encode($json);
				$mail -> MsgHTML($algo);
				$mail -> AddReplyTo("$correo");
				$mail -> AddAddress("$correo");
				$mail -> IsHTML(true);
				
				if (!$mail -> send()) {
					$resp['error_mail'] = json_encode('Mailer Error: ' . $mail -> ErrorInfo);
				} else {
					$resp['send_mail'] = json_encode('Message has been sent');
				}
				
				$resp['error_send_user_mail'] = json_encode("Error en script".$e);
				return $resp;
			}else{
				$correo = "fertekvia@gmail.com";
				$mail = new PHPMailer();
				$mail -> IsSMTP();
				$mail -> SMTPAuth = true;
				$mail -> SMTPSecure = "ssl";
				$mail -> Host = "smtp.gmail.com";
				$mail -> Port = 465;
				$mail -> Username = "tekviaprogramacion@gmail.com";
				$mail -> Password = "Biagsa321";
				$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
				$mail -> Subject = "Transaction incompleted";
				$mail -> AltBody = "Esta es la fecha";
				$algo = json_encode($json);
				$mail -> MsgHTML($algo);
				$mail -> AddReplyTo("$correo");
				$mail -> AddAddress("$correo");
				$mail -> IsHTML(true);
				
				if (!$mail -> send()) {
					$resp['error_mail'] = json_encode('Mailer Error: ' . $mail -> ErrorInfo);
				} else {
					$resp['send_mail'] = json_encode('Message has been sent');
				}
				
				$resp['error_transaction'] = json_encode("Error en script".$e);
				return $resp;
			}
			break;
	
	// Cancelled
		case 'charge.cancelled' :
		//obtenemos el id de opnepay de la orden de pago
			$id_orden_open = $json -> transaction -> id;
		  	$html = '';
			
		  	try {
		  	// Update order status
				$update = "	UPDATE
			  					orders
			  				SET
			  					status = 2
			  				WHERE
			  					openpay_id = '".$id_orden_open."'
			  				AND
			  					status != 1";
				$resultado = mysqli_query($conexion, $update);
			
			// Update historical status
				$update = "	UPDATE
								historical
							SET
								status = 2
							WHERE
								order_id = (SELECT
												o.id
											FROM
												orders o
											WHERE
												o.openpay_id = '".$id_orden_open."'
											AND
			  									o.status != 1)";
				$resultado = mysqli_query($conexion, $update);
				
			// Update local status
				$update = "	UPDATE
								local l
							INNER JOIN 
									(SELECT 
										h.local_id
									FROM
										historical h
									LEFT JOIN
											orders o
										ON
											o.id = h.order_id
									WHERE
										o.openpay_id = '".$id_orden_open."'
									AND
	  									o.status != 1) t2
							   ON 
									l.id  = t2.local_id 
							SET
								l.status = 1";
				$resultado = mysqli_query($conexion, $update);
			} catch (mysqli_sql_exception $e) {
				throw $e;
				$resultado = $e;
			}
			
		  	try {
				$q_user_mail = "SELECT
				  					c.correo_cliente
				  				FROM
				  					clientes c
				  				LEFT JOIN
				  						orders o
				  					ON
				  						o.client_id = c.id_cliente
				  				WHERE
				  					o.openpay_id = '".$id_orden_open."'";
				$user_mail = mysqli_query($conexion, $q_user_mail);
				
				while ($fila = mysqli_fetch_assoc($user_mail)) {
					$correo = $fila['mail'];
				}
				
				if (empty($correo)) {
					$encode = json_encode($json);
					$correo = 'fertekvia@gmail.com';
					$html = 'Correo no encontrado:<br>'.$encode;
				}
			} catch (mysqli_sql_exception $e) {
				throw $e;
				$correo = $e;
			}
			
			if (empty($html)) {
				$html = "Tu siguiente compra ha caducado, por favor solicita una nueva:<br>
					        ".$json -> transaction -> description."<br>
					        Por el monto de $".$json -> transaction -> amount;
			}
			
		// Configuration mail
			$mail = new PHPMailer();
			$mail -> IsSMTP();
			$mail -> SMTPAuth = true;
			$mail -> SMTPSecure = "ssl";
			$mail -> Host = "smtp.gmail.com";
			$mail -> Port = 465;
			$mail -> Username = "tekviaprogramacion@gmail.com";
			$mail -> Password = "Biagsa321";
			$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
			
		// Mail message
			$mail -> Subject = "Ficha caducada";
			$mail -> AltBody = "Ficha caducada";
			$mail -> MsgHTML($html);
			
		// More configuration mail
			$mail -> AddReplyTo("$correo");
			$mail -> AddAddress("$correo");
			$mail -> IsHTML(true);
			
		//Envio de correo
			try {
				$mail -> send();
			} catch(phpmailerException $e) {
				throw $e;
				var_dump($e);
			}
			break;
			
		//No eliminar ya que sera necesario si desea migrar el proyecto a otro host para recibir la aprobacion de webhook
		//Por parte de openpay
		case 'verification' :
		//Correo al que decia recibir el codigo de verificacion puede cambiar de ser necesario
			$correo = "fertekvia@gmail.com";
		//Procedimiento de envio de correo por medio de phpmailer
			$mail = new PHPMailer();
	
		//modificar en caso de utilizar un correo distinto a gmail
			$mail -> IsSMTP();
			$mail -> SMTPAuth = true;
			$mail -> SMTPSecure = "ssl";
			$mail -> Host = "smtp.gmail.com";
			$mail -> Port = 465;
	
		//Datos de acceso al smtp
			$mail -> Username = "tekviaprogramacion@gmail.com";
			$mail -> Password = "Biagsa321";
	
		//Correo e informacion del remitente
			$mail -> setFrom('tekviaprogramacion@gmail.com', 'TianguisMex');
		//Datos y contenido del correo
			$mail -> Subject = "Codigo de verificacion";
			$mail -> AltBody = "Esta es la fecha";
			$mail -> MsgHTML("$json->verification_code");
			$mail -> AddReplyTo("$correo");
			$mail -> AddAddress("$correo");
			$mail -> IsHTML(true);
			
		//Envio de correo
			if (!$mail -> send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail -> ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
			
			break;
		case 'charge.created' :
			$correo = "fertekvia@gmail.com";
			$mail = new PHPMailer();
		//modificar en caso de utilizar un correo distinto a gmail
			$mail -> IsSMTP();
			$mail -> SMTPAuth = true;
			$mail -> SMTPSecure = "ssl";
			$mail -> Host = "smtp.gmail.com";
			$mail -> Port = 465;
		//Datos de acceso al smtp
			$mail -> Username = "tekviaprogramacion@gmail.com";
			$mail -> Password = "Biagsa321";
		//Correo e informacion del remitente
			$mail -> setFrom('tekviaprogramacion@gmail.com', 'Tianguismex');
		//Datos y contenido del correo
			$mail -> Subject = "Cargo creado";
			$mail -> AltBody = "Esta es la fecha";
			$algo = json_encode($json);
			$mail -> MsgHTML($algo);
			$mail -> AddReplyTo("$correo");
			$mail -> AddAddress("$correo");
			$mail -> IsHTML(true);
		//Envio de correo
			if (!$mail -> send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail -> ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
			
			break;
		default :
			$correo = "fertekvia@gmail.com";
			$mail = new PHPMailer();
			
			$mail -> IsSMTP();
			$mail -> SMTPAuth = true;
			$mail -> SMTPSecure = "ssl";
			$mail -> Host = "smtp.gmail.com";
			$mail -> Port = 465;
			$mail -> Username = "tekviaprogramacion@gmail.com";
			$mail -> Password = "Biagsa321";

			$mail -> From = "Webhook Openpay";
			$mail -> FromName = "Webhook Openpay";
			$mail -> Subject = "Función no encontrada";
			$mail -> AltBody = "";
			$algo = json_encode($json);
			$mail -> MsgHTML($algo.'------------'.$tipo);
			$mail -> AddReplyTo("$correo");
			$mail -> AddAddress("$correo");
			$mail -> IsHTML(true);
			
		//Envio de correo
			if (!$mail -> send()) {
				$resp['error_mail'] = json_encode('Mailer Error: ' . $mail -> ErrorInfo);
			} else {
				$resp['send_mail'] = json_encode('Message has been sent');
			}
			
			$resp['error_nothig'] = json_encode("Error en script".$e);
			return $resp;
			
			break;
	}
?>
