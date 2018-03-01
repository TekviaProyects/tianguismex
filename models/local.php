<?php
//Carga la clase de coneccion con sus metodos para consultas o transacciones
//require("models/connection.php"); // funciones mySQL
require ("models/connection_sqli.php");
class localModel extends Connection {

///////////////// ******** ----						list_local							------ ************ //////////////////
//////// Check the local in the DB and return into array
	// The parameters that can receive are:
	
	function list_local($objet) {
	// Filter by the tianguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND l.tianguis_id = '.$objet['tianguis_id'] : '' ;
		
		
	// Order
		$condition .= (!empty($objet['order'])) ? 
			' ORDER BY = '.$objet['order'] : ' ORDER BY l.tianguis_id ASC, l.y ASC, l.x ASC' ;
		
		$sql = "SELECT
					l.*
				FROM
					local l
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_local						------ ************ //////////////////
	
///////////////// ******** ----						save_order							------ ************ //////////////////
//////// Save the historical data on the DB
	// The parameters that can receive are:
		// client_id -> Client ID
		// local_id -> Local ID 
		// quantity -> Quantity to pay
		// creation_date -> Creation date of the order
		// select_date -> Selected date on the calendar
		// end_date -> End date of the order 
		// due_date -> Due date of the order 
		// openpay_id -> Openpay ID
		// url -> URL to charge the pay document
		// description -> Order description
		// reference -> Openpay reference
	
	function save_order($objet) {
		$status = (!empty($objet['status'])) ? $objet['status'] : 0;
		
		$sql = "INSERT INTO
					orders(client_id, cost,  creation_date, select_date, end_date, due_date, openpay_id, url, description, 
							reference, status, tianguis_id, pay_date)
				VALUES
					(".$objet['client_id'].", '".$objet['cost']."', '".$objet['creation_date']."', 
					'".$objet['select_date']."', '".$objet['end_date']."', '".$objet['due_date']."', 
					'".$objet['openpay_id']."', '".$objet['url']."', '".$objet['description']."', '".$objet['reference']."',
					".$status.", '".$objet['tianguis_id']."', '".$objet['pay_date']."')";
		// return $sql;
		$result = $this -> insert_id($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END save_order						------ ************ //////////////////

///////////////// ******** ----						save_historical						------ ************ //////////////////
//////// Save the historical data on the DB
	// The parameters that can receive are:
		// client_id -> Client ID
		// order_id -> Order ID 
		// local_id -> Local ID 
		// quantity -> Quantity to pay
		// creation_date -> Creation date of the order
		// select_date -> Selected date on the calendar
		// end_date -> End date of the order 
		// due_date -> Due date of the order 
		// authorization -> Authorization number
		// reference -> Reference
		// description -> Description
	
	function save_historical($objet) {
		$status = (!empty($objet['status'])) ? $objet['status'] : 0;
		
		$sql = "INSERT INTO
					historical(client_id, order_id, local_id, quantity, creation_date, select_date, end_date, due_date, 
								authorization, reference, description, status)
				VALUES
					(".$objet['client_id'].", '".$objet['order_id']."', ".$objet['local_id'].", ".$objet['quantity'].", 
					'".$objet['creation_date']."', '".$objet['select_date']."', '".$objet['end_date']."', 
					'".$objet['due_date']."', '".$objet['authorization']."', '".$objet['reference']."', 
					'".$objet['description']."', ".$status.")";
		// return $sql;
		$result = $this -> query($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END save_historical					------ ************ //////////////////

///////////////// ******** ----							update							------ ************ //////////////////
//////// Update the local information on the DB
	// The parameters that can receive are:
		// columns -> String with the columns afected
		// id -> Local ID
	
	function update($objet) {
		$sql = "UPDATE 
					local
				SET ".
					$objet['columns']." 
				WHERE
					id = ".$objet['id'];
		// return $sql;
		$result = $this -> query($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END update							------ ************ //////////////////

///////////////// ******** ----						list_orders							------ ************ //////////////////
//////// Check the orders in the DB and return into array
	// The parameters that can receive are:
	
	function list_orders($objet) {
	// Filter by TIanguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND o.tianguis_id = '.$objet['tianguis_id'] : '' ;
	// Filter by the client ID
		$condition .= (!empty($objet['client_id'])) ? ' AND o.client_id = '.$objet['client_id'] : '' ;
	// Filter by status
		$condition .= (!empty($objet['status'])) ? ' AND o.status = '.$objet['status'] : '' ;
	// Filter by payment card
		$condition .= (!empty($objet['card'])) ? ' AND h.authorization != ""' : '' ;
	// Filter by ID
		$condition .= (!empty($objet['id'])) ? ' AND o.id = '.$objet['id'] : '' ;
	// Filter by payment store
		$condition .= (!empty($objet['store'])) ? ' AND h.reference != ""' : '' ;
		
	// Filter by payment store
		$condition .= (!empty($objet['group'])) ? ' GROUP BY \''.$objet['group'].'\'' : ' GROUP BY o.id';
		
		$sql = "SELECT
					o.*
				FROM
					orders o
				LEFT JOIN
						historical h
					ON
						h.order_id = o.id
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_orders						------ ************ //////////////////

///////////////// ******** ----						update_client						------ ************ //////////////////
//////// Update the local information on the DB
	// The parameters that can receive are:
		// columns -> String with the columns afected
		// id -> Local ID
	
	function update_client($objet) {
		$sql = "UPDATE 
					clientes
				SET ".
					$objet['columns']." 
				WHERE
					id_cliente = ".$objet['id'];
		// return $sql;
		$result = $this -> query($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END update_client					------ ************ //////////////////

///////////////// ******** ----						save_client_x_tianguis				------ ************ //////////////////
//////// Save a client X tianguis if not exists
	// The parameters that can receive are:
		// client_id -> Client ID
		// tianguis_id -> Tianguis ID
	
	function save_client_x_tianguis($objet) {
		$sql = "SELECT
					id
				FROM
					client_x_tianguis
				WHERE
					client_id = ".$objet['client_id']." 
				AND
					tianguis_id = ".$objet['tianguis_id'];
		// return $sql;
		$exists = $this -> query_array($sql);
		
		if($exists['total'] > 0){
			$result = true;
		}else{
			$sql = "INSERT IGNORE INTO
						client_x_tianguis(client_id, tianguis_id)
					VALUES
						(".$objet['client_id'].", ".$objet['tianguis_id'].")";
			// return $sql;
			$result = $this -> query($sql);
		}
		
		return $result;
	}
	
///////////////// ******** ----					END save_client_x_tianguis				------ ************ //////////////////

}

?>