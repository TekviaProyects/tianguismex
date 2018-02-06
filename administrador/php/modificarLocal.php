<?php
include('../../cliente/php/conexion.php');
$id_local = $_GET['id_local'];
$tipo_local = $_GET['tipo_local'];
$insertar = $conexionDb->modificar("locales","tipo_local = $tipo_local","WHERE id_local = $id_local");
echo $insertar;



?>
