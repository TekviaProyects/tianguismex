<?php
session_start();
if ($_SERVER['SERVER_NAME'] == 'localhost') {
	$servidor = 'localhost';
	$usuariobd = 'root';
	$clavebd = '';
	$bd = 'c0630048_mds_p';
} else {
	$servidor = 'localhost';
	$usuariobd = 'c0630048_new';
	$clavebd = 'mi69nuFAnu';
	$bd = 'c0630048_new';
}

?>