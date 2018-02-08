<?php
//Carga la clase de coneccion con sus metodos para consultas o transacciones
//require("models/connection.php"); // funciones mySQL
require ("models/connection_sqli.php");
class localModel extends Connection {

///////////////// ******** ----						list_local						------ ************ //////////////////
//////// Check the local in the DB and return into array
	// The parameters that can receive are:
		// name -> Customer name
		// id -> Customer ID
	
	function list_local($objet) {
	// Filter by the ID if exists
		$condition .= (!empty($objet['id'])) ? ' AND c.id = '.$objet['id'] : '' ;
	// Filter by the name if exists
		$condition .= (!empty($objet['name'])) ? ' AND c.full_name LIKE \'%'.$objet['name'].'%\'' : '' ;
		
		$sql = "SELECT
					c.*, s.lu, s.ma, s.mi, s.ju, s.vi, s.sa, s.do, s.schedule_ini, s.schedule_end
				FROM
					local c 
				LEFT JOIN
						schedules s
					ON
						s.customer_id = c.id
				WHERE
					1 = 1".
				$condition;
		// return $sql;
		$result = $this -> query_array($sql);
		
		return $result;
	}
	
///////////////// ******** ----						END list_local					------ ************ //////////////////

}

?>