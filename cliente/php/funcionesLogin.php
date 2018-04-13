<?php
session_start();
include ('conexion.php');
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

try {
	$resultado = $conexionDb -> buscar('clientes', "WHERE celular_cliente = '$telefono' AND correo_cliente = '$correo'");
	if (verificar($correo)) {
		if ($resultado -> num_rows == 0) {
			echo 'existencia';
		} else {
			while ($fila = mysqli_fetch_assoc($resultado)) {
				$estado = $fila['estado_cliente'];
				$ide = $fila['id_cliente'];
				$nombre = $fila['nombre_cliente'];
				$o_id = $fila['o_id'];
				$_SESSION['user'] = $fila;
			}
			if ($estado == 0) {
				echo "estado";
			} else {
				$_SESSION['ide'] = $ide;
				
				$_SESSION['user']['id'] = $ide;
				$_SESSION['user']['mail'] = $correo;
				$_SESSION['user']['tel'] = $telefono;
				$_SESSION['user']['nombre'] = $nombre;
				$_SESSION['user']['o_id'] = $o_id;
				
				echo 'true';
			}

		}
	} else {
		echo 'formato';
	}
} catch(Exception $e) {
	echo 'fallo';
}

//funcionesLogin

function verificar($direccion) {
	$sintaxis = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
	if (preg_match($sintaxis, $direccion))
		return true;
	else
		return false;
}
?>
