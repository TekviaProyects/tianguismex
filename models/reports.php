<?php
//Carga la clase de coneccion con sus metodos para consultas o transacciones
//require("models/connection.php"); // funciones mySQL
require ("models/connection_sqli.php");
class reportsModel extends Connection {

///////////////// ******** ----						list_periodic						------ ************ //////////////////
//////// Check the periodic report data and return into array
	// The parameters that can receive are:
		// f_ini -> Start date
		// f_end -> End date
		// tianguis_id -> Tianguis ID

	function list_periodic($objet) {
	// Filter by delimitated dates
		$condition .= (!empty($objet['f_ini']) && !empty($objet['f_end'])) ? 
			' AND o.creation_date BETWEEN "'.$objet['f_ini'].'" AND "'.$objet['f_end'].'"' : '' ;
	// Filter by tianguis ID
		$condition .= (!empty($objet['tianguis_id'])) ? ' AND o.tianguis_id = '.$objet['tianguis_id'] : '';
	// Filter by client ID
		$condition .= (!empty($objet['client_id'])) ? ' AND o.client_id = '.$objet['client_id'] : '';
		
	// Group
		$condition .= (!empty($objet['group'])) ? ' GROUP BY = '.$objet['group'] : ' GROUP BY o.client_id, o.status';
		
		$sql = "SELECT
					o.client_id, c.nombre_cliente AS client_name, c.correo_cliente AS client_mail,
					o.status, COUNT(o.id) AS total
				FROM
					orders o
				LEFT JOIN
						clientes c
					ON
						c.id_cliente = o.client_id
				WHERE
					1 = 1 ".
				$condition;
	// return $sql;
		$result = $this -> query_array($sql);

		return $result;
	}

///////////////// ******** ----						END list_periodic					------ ************ //////////////////

}
?>