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
					id
				FROM
					clientes
				WHERE
					mail = '".$objet['mail']."'";
		// return $sql;
		$clientes = $this -> query_array($sql);
	
	 // User exists
		if ($clientes['total'] > 0) {
			return Array("status" => 2);
		}
		
		$date = date('Y-m-d H:i:s');
		
		$sql = "INSERT INTO 
						clientes(name, last_name, last_name2, mail, pass, date, curp, state, municipality, 
								colony, addres, num, num_int)
				VALUES	
					('".$objet['name']."', '".$objet['last_name']."', '".$objet['last_name2']."', '".$objet['mail']."', 
					'".$objet['pass']."', '".$date."', '".$objet['curp']."', '".$objet['estadodep']."', 
					'".$objet['municipiodep']."', '".$objet['colony']."', '".$objet['addres']."', 
					'".$objet['num']."', '".$objet['num_int']."')";
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
		$condition .= (!empty($objet['id'])) ? ' AND id_cliente = '.$objet['id'] : '' ;
	// Filter by mail if exists
		$condition .= (!empty($objet['mail'])) ? ' AND correo_cliente = \''.$objet['mail'].'\'' : '' ;
	// Filter by pass if exists
		// $condition .= (!empty($objet['pass'])) ? ' AND pass = \''.$objet['pass'].'\'' : '' ;
		
		$sql = "SELECT
					*
				FROM
					clientes
				WHERE
					1 = 1".
				$condition;
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
		$condition .= (!empty($objet['mail'])) ? ' AND correo = \''.$objet['mail'].'\'' : '' ;
		
		$sql = "SELECT
					*
				FROM
					registros
				WHERE
					status = 1".
				$condition;
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
		$sql = "UPDATE 
					clientes
				SET ".
					$objet['customer_columns']." 
				WHERE
					id = ".$objet['id'];
		// return $sql;
		$result = $this -> query($sql);
		
		$sql = "UPDATE 
					schedules
				SET ".
					$objet['schedules_columns']." 
				WHERE
					customer_id = ".$objet['id'];
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
					pass = '".$objet['pass']."' 
				WHERE
					id = ".$objet['id'];
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
					correo_cliente = '".$objet['correo_cliente']."', 
					nombre_cliente = '".$objet['nombre_cliente']."', 
					celular_cliente = '".$objet['celular_cliente']."', 
					domicilio_cliente = '".$objet['domicilio_cliente']."'
				WHERE
					id_cliente = ".$objet['id'];
		// return $sql;
		$result = $this -> query($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END edit							------ ************ //////////////////

}

?>