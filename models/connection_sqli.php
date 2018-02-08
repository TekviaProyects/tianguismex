<?php
class Connection {
	public $connection;
	public $affectedRows = 0;

//Conecta a la base de datos
	private function connect() {
		require ("models/configuracion.php");

		if (!$this -> connection = mysqli_connect($servidor, $usuariobd, $clavebd, $bd)) {
			echo "Error al tratar de conectar";
		}
	
	// Previne errores con SetCharset
		$this -> connection -> set_charset('utf8');
	}

// Cierra la coneccion
	private function close() {
		$this -> connection -> close();
	}

// Consulta basica
	public function query($query) {
		$this -> connect();
		$result = $this -> connection -> query($query) or die("Error en la consulta" . $this -> connection -> error . "Error:" . $query);

		$this -> close();
		return $result;
	}

// Consultas multiple
	public function multi_query($query) {
		$result = $this -> connection -> multi_query($query) or die("<b style='color:red;'>Error en la consulta.</b><br /><br />" . $this -> connection -> error . "<be>Error:<br>" . $query);
		return $result;
	}

// Regresa el ID de la insercion
	public function insert_id($query) {
		$this -> connect();
		if (stristr($query, 'insert')) {
			$this -> connection -> query($query) or die("<b style='color:red;'>Error en la consulta.</b><br /><br />" . $this -> connection -> error . "<be>Error:<br>" . $query);

			return $this -> connection -> insert_id;
			$this -> close();
		} else {
			$this -> close();
			return "La consulta no tiene un INSERT.";
		}
	}

// Regresa un array con los registros consultado
	public function query_array($sql, $relational = true) {
		try {
			if (empty($sql)) {
				throw new Exception("empty SQL");
			}
			$this -> sql = $sql;
			$this -> connect();

			$result = $this -> connection -> query($sql) or die("Error en la consulta." . $this -> connection -> error . "Error:" . $sql);

			$this -> affectedRows = mysqli_num_rows($result);

			$fields = array();
			while ($finfo = mysqli_fetch_field($result)) {
				$fields[] = $finfo -> name;
			}

			$rows = array();

			if ($relational) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$rows[] = $row;
				}
			} else {
				while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					foreach ($row as $key => $value) {
						$rows[$key][] = $value;
					}
				}
			}
			$this -> close();
			return array("status" => true, "total" => $this -> affectedRows, "fields" => $fields, "rows" => $rows);

		} catch(Exception $e) {
			$this -> close();
			return array("status" => false, "msg" => $e -> getMessage());
		}
	}

//Metodo para generar transaccion con la base de datos
	public function transaccion($data) {
		$this -> connect();
		$this -> connection -> autocommit(false);
		if ($this -> connection -> query('BEGIN;')) {
			if ($this -> connection -> multi_query($data)) {
				do {
					/* almacenar primer juego de resultados */
					if ($result = $this -> connection -> store_result()) {
						while ($row = $result -> fetch_row()) {
							echo $row[0];
						}
						$result -> free();
					}

				} while ($this->connection->more_results() && $this->connection->next_result());

				$this -> connection -> commit();
				$this -> connection -> close();
				return true;
			} else {
				$error = $this -> connection -> error;
				$this -> connection -> rollback();
				$this -> connection -> close();
				return $error;
			}
		} else {
			$error = $this -> connection -> error;
			$this -> connection -> rollback();
			$this -> connection -> close();
			return $error;
		}
	}
}
?>