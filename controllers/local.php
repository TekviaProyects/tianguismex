<?php
require ('controllers/common.php');
require ("models/local.php");

// Show error messages
	// error_reporting(E_ALL);

class local extends Common {
	public $localModel;
	private $production = 0;
	
	function __construct() {
		$this -> localModel = new localModel();
	}

///////////////// ******** ----						view_new						------ ************ //////////////////
//////// Load new view
	// The parameters that can receive are:
	
	function view_new($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/local/view_new.php');
	}
	
///////////////// ******** ----						END view_new					------ ************ //////////////////

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
		$objet['o_id'] = $_SESSION['user']['o_id'];
		$id_orden_error = 0;
		$id_orden = 0;
		$time = -3600;
		$fecha1 = date('Y-m-d');
		$caducidad = strtotime('+3 day', strtotime($fecha1));
		$caducidad = date('Y-m-d', $caducidad);
		$due_date = $caducidad;
		$caducidad = $caducidad." 23:59:59";
		$fechaInicial = $objet['date'];
		$des = "";
		$resp['status'] = 1;
		
		try {
		// Import openpay library
			require('plugins/openpay/Openpay.php');
			include('controllers/openpay.php' );
			
		// Call the function to generate a charge
			$open_pay = new openpayObject();
			
			$customer = $open_pay -> get_customer($objet);
			
			if($customer['status'] == 2 && $customer['error_code'] !== 0){
				$resp['status'] = 2;
				$resp['message'] = "Ocurrio un error al rentar tus locales [Openpay no disponible], intenta mas tarde";
				$resp['message_openpay'] = $customer['message'];
				
				echo json_encode($resp);
				
				return;
			}
			
			if($customer['error_code'] === 0){
				$objet['name'] = $_SESSION['user']['nombre'];
				$objet['email'] = $_SESSION['user']['mail'];
				$objet['external_id'] = $_SESSION['user']['id'];
				
				$customer = $open_pay -> add_customer($objet);
				$o_id = $customer->id;
				
				if(!empty($o_id)){
					$data['id'] = $_SESSION['user']['id'];
					$data['columns'] = " o_id = '".$o_id."'";
					$resp['result'] = $this -> localModel -> update_client($data);
					
					$_SESSION['user']['o_id'] = $o_id;
				}
			}else{
				$customer = $customer['result'];
				$o_id = $customer->id;
			}
			
			$des = 'Costo por renta de local: ';
			foreach ($objet['local'] as $key => $value) {
				$des .= $value['description']." - ".$value['des_cat'].", ";
			}
			$des = substr($des, 0, -2);
			
		// Charge
			$data = array(
			    'method' => 'store',
			    'amount' => $objet['total'],
			    'description' => $des,
			    'due_date' => $due_date
			);
			$cargo = $customer->charges->create($data);
			
		// Create a link to test or production
			$link = ($this->production == 0) ? 'sandbox-dashboard.openpay.mx' : 'dashboard.openpay.mx';
			$link = "https://".$link."/paynet-pdf/mngsvcdrvfxhfkedj98m/".$cargo->payment_method->reference;
			
		// Google short link
			require_once('plugins/google-api-php-client-2.2.0/vendor/autoload.php');
			require_once('controllers/Googl.class.php');
			$original = $link;
			$googl = new Googl('AIzaSyCsZOvqzL9c7_O7Fj7t3FDt77nejjwbZXw');
			$resp['url'] = $data['url'] = $googl->shorten($link);
			unset($googl);
			
		// Save order
			$data['client_id'] = $_SESSION['user']['id'];
			$data['cost'] = $objet['total'];
			$data['creation_date'] = date('Y-m-d H:i:s');
			$data['select_date'] = $fechaInicial;
			$data['due_date'] = $caducidad;
			$data['openpay_id'] = $cargo -> id;
			$data['description'] = $des;
			$data['reference'] = $cargo->payment_method->reference;
			$data['authorization'] = '';
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
			$resp['e'] = $e;
			$resp['message'] = "Ocurrio un error al rentar tus locales";
			
			echo "<pre>", print_r($resp),  "</pre>";
		}
	}
	
///////////////// ******** ----						END rent_local						------ ************ //////////////////

///////////////// ******** ----						list_orders							------ ************ //////////////////
//////// Check the orders and load a view
	// The parameters that can receive are:
		// client_id -> Client ID 
	
	function list_orders($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		$orders = $this -> localModel -> list_orders($objet);
		$orders = $orders['rows'];
		
		require ('views/local/list_orders.php');
	}
	
///////////////// ******** ----						END list_orders						------ ************ //////////////////

}

?>