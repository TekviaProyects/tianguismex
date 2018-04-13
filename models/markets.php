<?php
//Carga la clase de coneccion con sus metodos para consultas o transacciones
//require("models/connection.php"); // funciones mySQL
require ("models/connection_sqli.php");
class marketsModel extends Connection {

///////////////// ******** ----						list_markets						------ ************ //////////////////
//////// Check the markets in the DB and return into array
	// The parameters that can receive are:
		// name -> Customer name
		// client_id -> Client ID
	
	function list_markets($objet) {
	// Filter by the state
		$condition .= (!empty($objet['state'])) ? ' AND t.estado_tianguis = '.$objet['state'] : '' ;
	// Filter by the mail
		$condition .= (!empty($objet['mail'])) ? ' AND t.mail_notification = \''.$objet['mail'].'\'' : '' ;
	// Filter by the tel
		$condition .= (!empty($objet['pass'])) ? ' AND t.pass = \''.md5($objet['pass']).'\'' : '' ;
		
	// Group
		$condition .= (!empty($objet['group'])) ? ' GROUP BY = \''.$objet['group'].'\'' : ' GROUP BY t.id_tianguis';
		
		$sql = "SELECT
					t.*, cxt.status AS permit
				FROM
					tianguis t
				LEFT JOIN
						client_x_tianguis cxt
					ON
						cxt.tianguis_id = t.id_tianguis AND cxt.client_id = '".$objet['client_id']."'
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_markets					------ ************ //////////////////

///////////////// ******** ----						list_cats							------ ************ //////////////////
//////// Check the categories in the DB and return into array
	// The parameters that can receive are:
	
	function list_cats($objet) {
	// Filter by the tianguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND c.tianguis_id = '.$objet['tianguis_id'] : '' ;
	// Filter by status
		$condition .= (!empty($objet['status'])) ? ' AND c.status = '.$objet['status'] : '' ;
		
		$sql = "SELECT
					c.*
				FROM
					cat_x_tianguis c
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_cats						------ ************ //////////////////

///////////////// ******** ----						list_local							------ ************ //////////////////
//////// Check the local in the DB and return into array
	// The parameters that can receive are:
	
	function list_local($objet) {
	// Filter by the tianguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND l.tianguis_id = '.$objet['tianguis_id'] : '' ;
	// Filter by the order ID
		$condition .= (!empty($objet['order_id'])) ? ' AND h.order_id = '.$objet['order_id'] : '' ;
		
		
	// Group
		$condition .= (!empty($objet['group'])) ? ' GROUP BY = '.$objet['group'] : ' GROUP BY l.id' ;
	// Order
		$condition .= (!empty($objet['order'])) ? 
			' ORDER BY = '.$objet['order'] : ' ORDER BY l.tianguis_id ASC, l.y ASC, l.x ASC' ;
		
		$sql = "SELECT
					l.*, cxt.cost, CONCAT(cxt.title, ' - ', cxt.description) AS des_cat, COUNT(l.id) AS total 
				FROM
					local l
				LEFT JOIN
						historical h
					ON
						h.local_id = l.id
				LEFT JOIN
						cat_x_tianguis cxt
					ON
						cxt.id = l.cat_id
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_local						------ ************ //////////////////

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
	// Filter by delimitated dates
		$condition .= (!empty($objet['f_ini']) && !empty($objet['f_end'])) ? 
			' AND o.pay_date BETWEEN "'.$objet['f_ini'].'" AND "'.$objet['f_end'].'"' : '' ;
		
	// Filter by payment store
		$condition .= (!empty($objet['group'])) ? ' GROUP BY '.$objet['group'] : ' GROUP BY o.id';
	// Orders
		$condition .= (!empty($objet['order'])) ? ' ORDER BY '.$objet['order'] : ' ORDER BY o.id ASC';
		
// **** NOTA: Remplazar 0.15 por comisión reall
		$sql = "SELECT
					o.*, DATE_FORMAT(o.pay_date, ' %Y-%m-%d') AS organize_date, (o.cost * 0.15) AS expenses, 
					(o.cost - (o.cost * 0.15)) AS sub_total
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
	
///////////////// ******** ----						data_market							------ ************ //////////////////
//////// Check the data market in the DB and return into array
	// The parameters that can receive are:
	
	function data_market($objet) {
	// Filter by the tianguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND l.tianguis_id = '.$objet['tianguis_id'] : '' ;
		
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
	
///////////////// ******** ----						END data_market						------ ************ //////////////////
	
///////////////// ******** ----						update								------ ************ //////////////////
//////// Check the data market in the DB and return into array
	// The parameters that can receive are:
	
	function update($objet) {
		$data = (!empty($objet['logo'])) ? " ,logo = '".$objet['logo']."'" : '';
		$data .= (!empty($objet['pass'])) ? " ,pass = '".$objet['pass']."'" : '';
		
		$sql = "UPDATE
					tianguis 
				SET
					mail_notification = '".$objet['mail_notification']."', 
					comercial_name = '".$objet['comercial_name']."', 
					support_mail = '".$objet['support_mail']."', 
					municipality = '".$objet['municipality']."', 
					person_type = '".$objet['person_type']."', 
					contact_tel = '".$objet['contact_tel']."', 
					nombre_tianguis = '".$objet['name']."', 
					bank_name = '".$objet['bank_name']."', 
					reference = '".$objet['reference']."', 
					country = '".$objet['country']."', 
					num_ext = '".$objet['num_ext']."', 
					num_int = '".$objet['num_int']."', 
					colony = '".$objet['colony']."', 
					street = '".$objet['street']."', 
					alias = '".$objet['alias']."', 
					state = '".$objet['state']."',
					bank = '".$objet['bank']."', 
					city = '".$objet['city']."', 
					curp = '".$objet['curp']."', 
					`key` = '".$objet['key']."', 
					rfc = '".$objet['rfc']."', 
					cp = '".$objet['cp']."'".
					$data." 
				WHERE
					id_tianguis = ".$objet['id'];
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
					tianguis
				SET 
					pass = '".md5($objet['pass'])."' 
				WHERE
					id_tianguis = ".$objet['id'];
		// return $sql;
		$result = $this -> query($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END new_pass						------ ************ //////////////////
	
///////////////// ******** ----						save_local							------ ************ //////////////////
//////// Save the local data
	// The parameters that can receive are:
	
	function save_local($objet) {
		$join = (!empty($objet['joins'])) ? 1 : 0;
		
		$sql = "INSERT INTO
					local(tianguis_id, `show`, cat_id, description, x, y, disabled, `join`)
				VALUES
					('".$objet['tianguis_id']."', '".$objet['show']."', '".$objet['cat_id']."', '".$objet['text']."', 
					'".$objet['x']."', '".$objet['y']."', '".$objet['disabled']."', $join)";
		// return $sql;
		$result = $loca_id = $this -> insert_id($sql);
		
		if(!empty($objet['joins'])){
			foreach ($objet['joins'] as $key => $value) {
				$sql = "INSERT INTO
							joins(tianguis_id, local_id, original_text, text, x, y)
						VALUES
							('".$objet['tianguis_id']."', '".$loca_id."', '".$value['original_text']."', '".$value['text']."', 
							'".$value['x']."', '".$value['y']."')";
				// return $sql;
				$result = $this -> query($sql);
			}
		}
		
		return $result;
	}
	
///////////////// ******** ----						END save_local						------ ************ //////////////////
	
///////////////// ******** ----						update_local						------ ************ //////////////////
//////// Update the local data on the DB
	// The parameters that can receive are:
		// status -> New local status
	
	function update_local($objet) {
		$sql = "UPDATE
					local
				SET
					".$objet['columns']."
				WHERE
					tianguis_id = ".$objet['tianguis_id'];
		// return $sql;
		$result = $this -> query($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END update_local					------ ************ //////////////////
	
///////////////// ******** ----						save_category						------ ************ //////////////////
//////// Save a tianguis category on the DB
	// The parameters that can receive are:
		// name -> Name of the category
		// cost -> Cost of the category
		// description -> Description of the category
	
	function save_category($objet) {
		$sql = "INSERT INTO
					cat_x_tianguis(tianguis_id, title, description, cost)
				VALUES
					('".$objet['tianguis_id']."', '".$objet['name']."', '".$objet['description']."', '".$objet['cost']."')";
		// return $sql;
		$result = $this -> insert_id($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END save_category					------ ************ //////////////////
	
///////////////// ******** ----						list_joins							------ ************ //////////////////
//////// List the joins local ans return into array
	// The parameters that can receive are:
		// local_id -> Father local ID
	
	function list_joins($objet) {
	 // Filter by local ID
		$condition = (!empty($objet['local_id'])) ? ' AND local_id = '.$objet['local_id'] : '';
		
		$sql = "SELECT 
					*
				FROM
					joins 
				WHERE
					1 = 1 ".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_joins						------ ************ //////////////////
	
///////////////// ******** ----						update_sketch						------ ************ //////////////////
//////// Save the local data
	// The parameters that can receive are:
	
	function update_sketch($objet) {
		$join = (!empty($objet['joins'])) ? 1 : 0;
		
		$sql = "DELETE FROM
					joins
				WHERE
					local_id = ".$objet['id'];
		// return $sql;
		$delete = $this -> query($sql);
		
		if ($objet['new'] == 1) {
			$sql = "INSERT INTO
						local(tianguis_id, `show`, cat_id, description, x, y, disabled, `join`)
					VALUES
						('".$objet['tianguis_id']."', '".$objet['show']."', '".$objet['cat_id']."', '".$objet['text']."', 
						'".$objet['x']."', '".$objet['y']."', '".$objet['disabled']."', $join)";
			// return $sql;
			$result = $objet['id'] = $this -> insert_id($sql);
		} else {
			$sql = "UPDATE
						local
					SET
						`show` = '".$objet['show']."',
						disabled = '".$objet['disabled']."',
						description = '".$objet['text']."',
						cat_id = '".$objet['cat_id']."',
						`join` = $join 
					WHERE
						id = ".$objet['id'];
			// return $sql;
			$result = $this -> query($sql);	
		}
		
		if(!empty($objet['joins'])){
			foreach ($objet['joins'] as $key => $value) {
				$sql = "INSERT INTO
							joins(tianguis_id, local_id, original_text, text, x, y)
						VALUES
							('".$objet['tianguis_id']."', '".$objet['id']."', '".$value['original_text']."', '".$value['text']."', 
							'".$value['x']."', '".$value['y']."')";
				// return $sql;
				$result = $this -> query($sql);
			}
		}
		
		return $result;
	}
	
///////////////// ******** ----						END update_sketch					------ ************ //////////////////
	
}

?>