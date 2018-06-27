<?php
// Send text message
	require 'plugins/twilio-php-master/Twilio/autoload.php';
	$message = new Twilio\Rest\Client("AC8da101d6b7b794bbca955be47a01b8b4", "48703ac1820b5d2e13c21a393284d630");

	date_default_timezone_set("America/Mexico_City");
	mysqli_report(MYSQLI_REPORT_STRICT);
	// ini_set('display_errors', '1');
	error_reporting(0);
	
	try{
		if ($_SERVER['SERVER_NAME'] == 'localhost') {
			$servidor = 'localhost';
			$usuariobd = 'root';
			$clavebd = '';
			$bd = 'tianguismex';
		}else{
			$servidor = 'localhost';
			$usuariobd = 'c0630048_new';
			$clavebd = 'mi69nuFAnu';
			$bd = 'c0630048_new';
		}
		
		$conexion = mysqli_connect($servidor,$usuariobd,$clavebd,$bd);
	} catch (mysqli_sql_exception $e) {
		echo "<h1>Error en la conexion:</h1>";
		echo "<pre>", print_r($e), "</pre>";
		
		return;
	}
	
	$date = date('Y-m-d H:i:s');
	$res = Array();
	
// Update renovation
	try {
		$sql_r = "	UPDATE
						renovations r
					INNER JOIN
							orders o
						ON
							o.id = r.new_order_id
					SET
						r.status = 2
					WHERE
						o.due_date < '".$date."'
					AND
						o.status = 0";
		$res['renovations'] = mysqli_query($conexion, $sql_r);
	} catch (mysqli_sql_exception $e) {
		echo "<h1>Error en la consulta(renovations):</h1>";
		echo "<pre>", print_r($e), "</pre>-----------------".$sql_r;
		
		return;
	}
	
// Update local
	try {
		$sql_l = "	UPDATE
						local l
					INNER JOIN
							historical h
						ON
							h.local_id = l.id
					SET
						l.status = 1
					WHERE
						h.due_date < '".$date."'
					AND
						h.status = 0";
		$res['local'] = mysqli_query($conexion, $sql_l);
	} catch (mysqli_sql_exception $e) {
		echo "<h1>Error en la consulta(Local):</h1>";
		echo "<pre>", print_r($e), "</pre>-----------------".$sql_l;
		echo "<pre>", print_r($res), "</pre>";
		
		return;
	}
	
// Update historical
	try {
		$sql_h = "	UPDATE
						historical
					SET
						status = 2 
					WHERE
						due_date < '".$date."'
					AND
						status = 0";
		$res['historical'] = mysqli_query($conexion, $sql_h);
	} catch (mysqli_sql_exception $e) {
		echo "<h1>Error en la consulta(Historical):</h1>";
		echo "<pre>", print_r($e), "</pre>-----------------".$sql_h;
		echo "<pre>", print_r($res), "</pre>";
		
		return;
	}
	
// Update orders
	try {
		$sql_o = "	SELECT 
						c.celular_cliente AS tel
					FROM 
						orders o
					LEFT JOIN 
						clientes c ON c.id_cliente = o.client_id
					WHERE
						due_date < '".$date."'
					AND
						status = 0";
		$result_o = mysqli_query($conexion, $sql_o);

		while($fila = mysqli_fetch_assoc($result_o)){
			$tel = $fila['tel'];

			if($tel){
				$message->messages->create(
					'+521'.$tel,
					array(
					'from' => '+12107141665 ',
					'body' => 'Te informamos que el periodo para pagar tu ficha ha terminado, te invitamos a generar una nueva ficha'
					)
				);
			}
		}

		$sql_o = "	UPDATE
						orders
					SET
						status = 2 
					WHERE
						due_date < '".$date."'
					AND
						status = 0";
		$res['orders'] = mysqli_query($conexion, $sql_o);
	} catch (mysqli_sql_exception $e) {
		echo "<h1>Error en la consulta(Ordenes):</h1>";
		echo "<pre>", print_r($e), "</pre>-----------------".$sql_o;
		echo "<pre>", print_r($res), "</pre>";
		
		return;
	}
	
	try{
		$new_date = date('Y-m-d');
		$sql_a = "	SELECT 
						c.celular_cliente AS tel
					FROM 
						orders o
					LEFT JOIN 
						clientes c ON c.id_cliente = o.client_id
					WHERE
						DATE_ADD(due_date, INTERVAL 1 DAY) >= '".$new_date." 18:00:00'
					AND
						status = 0";
		$res['prevent_message'] = mysqli_query($conexion, $sql_a);

		while($fila = mysqli_fetch_assoc($res['prevent_message'])){
			$tel = $fila['tel'];

			if($tel){
				$message->messages->create(
					'+521'.$tel,
					array(
						'from' => '+12107141665 ',
						'body' => 'Te informamos que tu ficha esta proxima a vencer, te invitamos realizar el pago correspondiente'
					)
				);
			}
		}
	} catch (Exception $e) {
		echo "<pre>", print_r($e), "</pre>-----------------".$sql_a;
		echo "<pre>", print_r($res), "</pre>";
	}

	$entry = "Saved info $date.\n------------------------------\n";
	$file = "log.txt";
	$open = fopen($file,"a");
	 
	if ( $open ) {
		fwrite($open,$entry);
		fclose($open);
	}
	
	echo "Todo bien :D <br/><pre>", print_r($res), "</pre>";
?>
