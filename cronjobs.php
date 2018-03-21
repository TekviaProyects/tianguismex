<?php
	date_default_timezone_set("America/Mexico_City");
	mysqli_report(MYSQLI_REPORT_STRICT);
	ini_set('display_errors', '1');
	error_reporting(E_ALL);
	
	try{
		if ($_SERVER['SERVER_NAME'] == 'localhost') {
			$servidor = 'localhost';
			$usuariobd = 'root';
			$clavebd = '';
			$bd = 'c0630048_mds_p';
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
	
	$entry = "Saved info $date.\n------------------------------\n";
	$file = "log.txt";
	$open = fopen($file,"a");
	 
	if ( $open ) {
		fwrite($open,$entry);
		fclose($open);
	}
	
	echo "Todo bien :D <br/><pre>", print_r($res), "</pre>";
?>
