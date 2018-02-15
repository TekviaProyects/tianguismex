<?php
require ('controllers/common.php');
require ("models/local.php");

// Show error messages
	// error_reporting(E_ALL);

class local extends Common {
	public $localModel;
	function __construct() {
		$this -> localModel = new localModel();
	}

///////////////// ******** ----						list_local						------ ************ //////////////////
////////Check the local and loaded the view
	// The parameters that can receive are:
		// name -> Customer name
	
	function view_new($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/local/view_new.php');
	}
	
///////////////// ******** ----						END list_local					------ ************ //////////////////

///////////////// ******** ----						rent_local						------ ************ //////////////////
//////// Rent local
	// The parameters that can receive are:
		// name -> Customer name
	
	function rent_local($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
	// Librerias y archivos requeridos
		session_start();
		date_default_timezone_set('America/Mexico_City');
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$id_orden_error = 0;
		$id_orden = 0;
		$time = -3600;
		$fecha1 = date('Y-m-d');
		$caducidad = strtotime('+3 day', strtotime($fecha1));
		$caducidad = date('Y-m-d', $caducidad);
		$caducidad = $caducidad." 23:59:59";
		$fechaInicial = $objet['date'];
		$des = "";
		$resp['status'] = 1;
		
		try {
		// Init
			$cliente = array(
				'name' => $_SESSION['user']['nombre'], 
				'phone_number' => $_SESSION['user']['tel'], 
				'email' => $_SESSION['user']['mail']
			);
			
			foreach ($objet['local'] as $key => $value) {
				$des .= $value['description']." - ".$value['des_cat'].", ";
			}
			$des = substr($des, 0, -2);
			
		// Build array
			$data['client_id'] = $_SESSION['user']['id'];
			$data['order_id'] = 123;
			$data['cost'] = $objet['total'];
			$data['creation_date'] = date('Y-m-d H:i:s');
			$data['select_date'] = $fechaInicial;
			$data['due_date'] = $caducidad;
			$data['openpay_id'] = 'xxxxxxxx';
			$data['url'] = 'http//fb.com';
			$data['description'] = $des;
			$data['reference'] = '1-1--11';
			$data['authorization'] = '2--2----2';
		// Save order
			$data['order_id'] = $this -> localModel -> save_order($data);
			
			$data_update['columns'] = ' status = 2';
				
			foreach ($objet['local'] as $key => $value) {
				$data['local_id'] = $value['id'];
				$data['quantity'] = $value['cost'];
				$data['description'] = $value['des_cat'];
				
				$resp['result'][$value['id']]['save'] = $this -> localModel -> save_historical($data);
				
				$data_update['id'] = $value['id'];
				$resp['result'][$value['id']]['update'] = $this -> localModel -> update($data_update);
			}
			
			echo json_encode($resp);
		} catch(Exception $e) {
			// $id_orden_error = $id_orden;
			// $eliminar = $conexionDb -> eliminar('cliente_locales', "id_orden = $id_orden_error");
			$resp['status'] = 2;
			$resp['message'] = "Hubo un error con el servicio de transacciones o no se encuentra disponible, intente mas tarde";
			
			echo json_encode($resp);
		}
	}
	
///////////////// ******** ----						END rent_local					------ ************ //////////////////

}

?>