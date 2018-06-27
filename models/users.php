<?php
//Carga la clase de coneccion con sus metodos para consultas o transacciones
//require("models/connection.php"); // funciones mySQL
require ("models/connection_sqli.php");
class usersModel extends Connection {

///////////////// ******** ----							 save							------ ************ //////////////////
//////// Call the dunction to save the user on the DB
	// The parameters that can receive are:
		// last_name -> Customer last name
		// mail -> Customer mail
		// name -> Customer name
		// pass -> Password
		// curp -> Customer CURP
		// estadodep -> Customer state
		// municipiodep -> Customer municipality
		// colony -> Customer colony
		// addres -> Customer addres
		// num -> External number
		// num_int -> Internal number

	function save($objet) {
	// Validate if the user exists
		$sql = "SELECT
					id_cliente
				FROM
					clientes
				WHERE
					correo_cliente = '" . $objet['mail'] . "'";
	// return $sql;
		$clientes = $this -> query_array($sql);

	// User exists
		if ($clientes['total'] > 0) {
			return Array("status" => 2);
		}

		$date = date('Y-m-d H:i:s');

		$sql = "INSERT INTO 
						clientes(nombre_cliente, celular_cliente, correo_cliente, domicilio_cliente, ine, ine_back, uid_cliente, c_address)
				VALUES	
					('" . $objet['name'] . "', '" . $objet['tel'] . "', '" . $objet['mail'] . "', '" . $objet['address'] . "', 
					'" . $objet['ine'] . "', '" . $objet['ine_back'] . "', '" . $objet['uid_cliente'] . "', '" . $objet['c_address'] . "')";
		$result = $this -> insert_id($sql);

		return $result;
	}

///////////////// ******** ----						END save							------ ************ //////////////////

///////////////// ******** ----						list_users							------ ************ //////////////////
//////// Check the clientes in the DB and return into array
	// The parameters that can receive are:
		// name -> Customer name
		// id -> Customer ID

	function list_users($objet) {
	// Filter by the ID if exists
		$condition .= (!empty($objet['id'])) ? ' AND id_cliente = ' . $objet['id'] : '';
	// Filter by mail if exists
		$condition .= (!empty($objet['mail'])) ? ' AND correo_cliente = \'' . $objet['mail'] . '\'' : '';
		$condition .= (!empty($objet['tel'])) ? ' AND celular_cliente = \'' . $objet['tel'] . '\'' : '';
	// Filter by pass if exists
	// $condition .= (!empty($objet['pass'])) ? ' AND pass = \''.$objet['pass'].'\'' : '' ;

		$sql = "SELECT
					*
				FROM
					clientes
				WHERE
					1 = 1" . $condition;
	// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}

///////////////// ******** ----						END list_users					------ ************ //////////////////

///////////////// ******** ----						list_places						------ ************ //////////////////
//////// Check the clientes in the DB and return into array
	// The parameters that can receive are:
		// name -> Customer name
		// id -> Customer ID

	function list_places($objet) {
	// Filter by mail if exists
		$condition .= (!empty($objet['mail'])) ? ' AND correo = \'' . $objet['mail'] . '\'' : '';

		$sql = "SELECT
					*
				FROM
					registros
				WHERE
					status = 1" . $condition;
	// return $sql;
		$result = $this -> query_array($sql);

		return $result;
	}

///////////////// ******** ----						END list_places						------ ************ //////////////////

///////////////// ******** ----							update							------ ************ //////////////////
//////// Check the clientes in the DB and return into array
	// The parameters that can receive are:
		// name -> Customer name
		// id -> Customer ID

	function update($objet) {
		$data = (!empty($objet['ine'])) ? " ,ine = '".$objet['ine']."'" : '';
		$data .= (!empty($objet['licence'])) ? " ,licence = '".$objet['licence']."'" : '';
		
		$sql = "UPDATE
					clientes 
				SET
					celular_cliente = '".$objet['celular_cliente']."', 
					comercial_name = '".$objet['comercial_name']."', 
					correo_cliente = '".$objet['correo_cliente']."', 
					nombre_cliente = '".$objet['nombre_cliente']."', 
					support_mail = '".$objet['support_mail']."', 
					municipality = '".$objet['municipality']."', 
					person_type = '".$objet['person_type']."', 
					bank_name = '".$objet['bank_name']."', 
					reference = '".$objet['reference']."', 
					country = '".$objet['country']."', 
					num_ext = '".$objet['num_ext']."', 
					num_int = '".$objet['num_int']."', 
					colony = '".$objet['colony']."', 
					street = '".$objet['street']."', 
					state = '".$objet['state']."',
					name = '".$objet['name']."', 
					city = '".$objet['city']."', 
					curp = '".$objet['curp']."', 
					rfc = '".$objet['rfc']."', 
					cp = '".$objet['cp']."'".
					$data." 
				WHERE
					id_cliente = ".$objet['id'];
		// return $sql;
		$result = $this -> query($sql);

		return $result;
	}

///////////////// ******** ----						END update							------ ************ //////////////////

///////////////// ******** ----						new_pass							------ ************ //////////////////
//////// Change the user pass
	// The parameters that can receive are:
		// id -> User ID
		// pass -> New password

	function new_pass($objet) {
		$sql = "UPDATE 
					clientes
				SET 
					pass = '" . $objet['pass'] . "' 
				WHERE
					id = " . $objet['id'];
	// return $sql;
		$result = $this -> query($sql);

		return $result;
	}

///////////////// ******** ----						END new_pass						------ ************ //////////////////

///////////////// ******** ----							 edit							------ ************ //////////////////
//////// Update user on the DB
	// The parameters that can receive are:
		// id -> User ID
		// correo_cliente -> Customer mail
		// nombre_cliente -> Customer name
		// celular_cliente -> Phone number name
		// domicilio_cliente -> Addres name

	function edit($objet) {
		$sql = "UPDATE 
					clientes
				SET 
					correo_cliente = '" . $objet['correo_cliente'] . "', 
					nombre_cliente = '" . $objet['nombre_cliente'] . "', 
					celular_cliente = '" . $objet['celular_cliente'] . "', 
					domicilio_cliente = '" . $objet['domicilio_cliente'] . "'
				WHERE
					id_cliente = " . $objet['id'];
	// return $sql;
		$result = $this -> query($sql);

		return $result;
	}

///////////////// ******** ----						END edit							------ ************ //////////////////

///////////////// ******** ----						list_clients						------ ************ //////////////////
//////// Check the clients and return into array
	// The parameters that can receive are:
		// tianguis_id -> Tianguis ID

	function list_clients($objet) {
	// Filter by the ID if exists
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND cxt.tianguis_id = ' . $objet['tianguis_id'] : '';

	// Group
		$condition .= (!empty($objet['group'])) ? ' GROUP BY \'' . $objet['group'] . '\'' : ' GROUP BY cxt.id';
		
		$sql = "SELECT
					c.*, cxt.status AS permit, 
					(	SELECT
							SUM(cost)
						FROM
							orders o
						WHERE
							client_id = c.id_cliente
						AND
							o.status = 1
						AND
							o.tianguis_id = cxt.tianguis_id) AS balance
				FROM
					client_x_tianguis cxt
				LEFT JOIN
						clientes c
					ON
						c.id_cliente = cxt.client_id
				WHERE
					1 = 1" . $condition;
	// return $sql;
		$result = $this -> query_array($sql);

		return $result;
	}

///////////////// ******** ----						END list_clients					------ ************ //////////////////

///////////////// ******** ----						update_x_tianguis					------ ************ //////////////////
//////// Update the client infomation
	// The parameters that can receive are:
		// client_id -> Client ID
		// status -> Status to change
		// tianguis_id -> Tianguis ID

	function update_x_tianguis($objet) {
		$sql = "UPDATE 
					client_x_tianguis
				SET 
					status = " . $objet['status'] . " 
				WHERE
					client_id = " . $objet['client_id']." 
				AND
					tianguis_id = " . $objet['tianguis_id'];
	// return $sql;
		$result = $this -> query($sql);

		return $result;
	}

///////////////// ******** ----						END update_x_tianguis				------ ************ //////////////////

}
?>