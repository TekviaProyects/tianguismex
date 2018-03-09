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
	// Filter by select date
		$condition .= (!empty($objet['select_date'])) ? ' AND o.select_date = "'.$objet['select_date'].'"' : '' ;
	// Filter by the minimun due date
		$condition .= (!empty($objet['min_due_date'])) ? ' AND o.due_date < "'.$objet['min_due_date'].'"' : '' ;
	// Filter by end date
		$condition .= (!empty($objet['check_date'])) ? ' AND o.end_date >= "'.$objet['check_date'].'"' : '' ;
	// Filter by TIanguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND o.tianguis_id = '.$objet['tianguis_id'] : '' ;
	// Filter by the client ID
		$condition .= (!empty($objet['client_id'])) ? ' AND o.client_id = '.$objet['client_id'] : '' ;
	// Filter by status
		$condition .= (!empty($objet['status'])) ? ' AND o.status = '.$objet['status'] : '' ;
	// Filter by ID
		$condition .= (!empty($objet['id'])) ? ' AND o.id = '.$objet['id'] : '' ;
	// Filter by payment store
		$condition .= (!empty($objet['store'])) ? ' AND o.url != ""' : '' ;
	// Filter by payment card
		$condition .= (!empty($objet['card'])) ? ' AND o.url = ""' : '' ;
		
	// Filter by payment store
		$condition .= (!empty($objet['group'])) ? ' GROUP BY \''.$objet['group'].'\'' : ' GROUP BY o.id';
	// Order rows
		$condition .= (!empty($objet['order'])) ? ' ORDER BY \''.$objet['order'].'\'' : ' ORDER BY o.id DESC';
		
		$sql = "SELECT
					o.*, r.status AS status_renew
				FROM
					orders o
				LEFT JOIN
						historical h
					ON
						h.order_id = o.id
				LEFT JOIN
						renovations r
					ON
						r.order_id = o.id
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

///////////////// ******** ----						list_historical						------ ************ //////////////////
//////// Check the historical of the order and return into array
	// The parameters that can receive are:
		// order_id -> Order ID
	
	function list_historical($objet) {
	// Filter by the tianguis ID
		$condition .= (!empty($objet['order_id'])) ? ' AND h.order_id = '.$objet['order_id'] : '' ;
		
		
	// Order
		$condition .= (!empty($objet['order'])) ? ' ORDER BY = '.$objet['order'] : ' ORDER BY h.id DESC' ;
		
		$sql = "SELECT
					h.*, l.description AS text_local
				FROM
					historical h
				LEFT JOIN
						local l
					ON
						l.id = h.local_id
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_historical					------ ************ //////////////////
	
///////////////// ******** ----						list_renovations					------ ************ //////////////////
//////// Check the renovations and return into array
	// The parameters that can receive are:
		// end_date -> End date renovation
		// status -> Status renovation
		// order_id -> Order ID
	
	function list_renovations($objet) {
	// Filter by status
		$condition .= (!empty($objet['status'])) ? ' AND r.status = '.$objet['status'] : '' ;
	// Filter by the tianguis ID
		$condition .= (!empty($objet['order_id'])) ? ' AND r.order_id = '.$objet['order_id'] : '' ;
	// Filter by the end date
		$condition .= (!empty($objet['end_date'])) ? ' AND r.end_date = \''.$objet['end_date'].'\'' : '' ;
		
		
	// Order
		$condition .= (!empty($objet['order'])) ? ' ORDER BY = '.$objet['order'] : ' ORDER BY r.id DESC' ;
		
		$sql = "SELECT
					r.*, o.url
				FROM 
					renovations r
				LEFT JOIN
						orders o
					ON
						o.id = r.new_order_id
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_renovations				------ ************ //////////////////
	
///////////////// ******** ----						save_renew							------ ************ //////////////////
//////// Save the historical data on the DB
	// The parameters that can receive are:
		// order_id -> Order ID 
		// creation_date -> Creation date of the order
		// end_date -> End date of the order 
		// openpay_id -> Openpay ID
		
	function save_renew($objet) {
		$status = (!empty($objet['status'])) ? $objet['status'] : 0;
		
		$sql = "INSERT INTO
					renovations(order_id, new_order_id, creation_date, end_date, openpay_id, status)
				VALUES
					('".$objet['order_id']."', '".$objet['new_order_id']."', '".$objet['creation_date']."', 
					'".$objet['end_date']."', '".$objet['openpay_id']."', ".$status.")";
		// return $sql;
		$result = $this -> insert_id($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END save_renew						------ ************ //////////////////
	
}

?>