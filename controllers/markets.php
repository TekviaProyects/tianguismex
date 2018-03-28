<?php
require ('controllers/common.php');
require ("models/markets.php");

class markets extends Common {
	public $marketsModel;
	function __construct() {
		$this -> marketsModel = new marketsModel();
	}
	
///////////////// ******** ----						view_new							------ ************ //////////////////
////////Check the markets and loaded the view
	// The parameters that can receive are:
		// name -> Customer name
	
	function view_new($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/markets/view_new.php');
	}
	
///////////////// ******** ----						END view_new						------ ************ //////////////////

///////////////// ******** ----						list_markets						------ ************ //////////////////
//////// Check the markets and loaded the view
	// The parameters that can receive are:
		// state -> State ID of the markerts
	
	function list_markets($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		if ($objet['send'] != 1) {
			$_SESSION['current'] = $objet;
		}
		
		$markets = $this -> marketsModel -> list_markets($objet);
		$markets = $markets['rows'];
		
		require ('views/markets/list_markets.php');
	}
	
///////////////// ******** ----						END list_markets					------ ************ //////////////////

///////////////// ******** ----							list_cats						------ ************ //////////////////
//////// Check the categories and loaded the view
	// The parameters that can receive are:
		// state -> State ID of the markerts
	
	function list_cats($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		if ($objet['send'] != 1) {
			$_SESSION['current'] = $objet;
		}
		
		$cats = $this -> marketsModel -> list_cats($objet);
		$cats = $cats['rows'];
		
		require ('views/markets/list_cats.php');
	}
	
///////////////// ******** ----						END list_cats						------ ************ //////////////////

///////////////// ******** ----						list_local							------ ************ //////////////////
//////// Load the local view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		// cat -> Categori ID
	
	function list_local($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		if ($objet['send'] != 1) {
			$_SESSION['current'] = $objet;
		}
		
		$local = $this -> marketsModel -> list_local($objet);
		$local = $local['rows'];
		
		require ('views/markets/list_local.php');
	}
	
///////////////// ******** ----						END list_local						------ ************ //////////////////

///////////////// ******** ----						view_account_status					------ ************ //////////////////
//////// Load the account status view
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		
	function view_account_status($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/markets/view_account_status.php');
	}
	
///////////////// ******** ----						END view_account_status				------ ************ //////////////////

///////////////// ******** ----						account_status						------ ************ //////////////////
//////// Load the account status
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// tianguis_id -> Tianguis ID
		// range -> Dates range
		
	function account_status($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$data = Array();
		$current = '';
		$k = 0;
		
	// Explode date
		$date = explode(" - ", $objet['range']);
		$objet['f_ini'] = $date[0].' 00:00:01';
		$objet['f_end'] = $date[1].' 23:59:59';
	
	// Check orders
		$objet['tiangui_id'] = $_SESSION['tianguis']['id'];
		$objet['order'] = ' o.pay_date ASC';
		$objet['status'] = 1;
		$orders = $this -> marketsModel -> list_orders($objet);
		$orders = $orders['rows'];
		
		foreach ($orders as $key => $value) {
			if($current != $value['organize_date']){
				$current = $value['organize_date'];
				$k++;
					
				$data['new_orders'][$k]['last_balance'] = $data['new_orders'][$k -1]['balance'];
			}
			
		// New orders array
			$data['new_orders'][$k]['pay_date'] = $current;
			$data['new_orders'][$k]['revenues'] += $value['cost'];
			$data['new_orders'][$k]['expenses'] += $value['expenses'] + ($value['expenses'] * 0.16);
			
		// Calculate balance
			$balance = (empty($data['new_orders'][$k]['balance'])) ? $data['new_orders'][$k]['last_balance'] : 0;
			$data['new_orders'][$k]['balance'] 
				= $balance 
				+ $value['cost']
				- ($value['expenses'] + ($value['expenses'] * 0.16));
			
		// Data info
			$data['revenues'] += $value['cost'];
			$data['expenses'] += $value['expenses'] + ($value['expenses'] * 0.16);
			$data['iva'] += ($value['expenses'] * 0.16);
			$data['total'] += $value['sub_total'];
			$data['num'] ++;
			
		// Card pay
			if (!empty($value['url'])) {
				$data['card']['revenues'] += $value['cost'];
				$data['card']['expenses'] += $value['expenses'];
				$data['card']['num'] ++;
		// Store pay
			} else { 
				$data['store']['revenues'] += $value['cost'];
				$data['store']['expenses'] += $value['expenses'];
				$data['store']['num'] ++;
			}
		}
		
	// Total - IVA
		$data['total'] -= $data['iva'];
		
		require ('views/markets/account_status.php');
	}
	
///////////////// ******** ----						END account_status					------ ************ //////////////////

///////////////// ******** ----						view_commissions					------ ************ //////////////////
//////// Load the commisssions view
	// The parameters that can receive are:
		// tianguis_id -> Tianguis ID
		
	function view_commissions($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/markets/view_commissions.php');
	}
	
///////////////// ******** ----						END view_commissions				------ ************ //////////////////

///////////////// ******** ----							 view_sketch					------ ************ //////////////////
//////// Load the view to sketch
	// The parameters that can receive are:
		// tianguis_id -> Tianguis ID
		
	function view_sketch($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/markets/view_sketch.php');
	}
	
///////////////// ******** ----						END view_sketch						------ ************ //////////////////

///////////////// ******** ----						modify_order						------ ************ //////////////////
//////// Load the view to modify order
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// order_id -> Order ID
	
	function modify_order($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
	
	// List locals selected and the total
		$local_selected = $this -> marketsModel -> list_local($objet);
		$total_selected = $local_selected['total'];
		$local_selected = $local_selected['rows'];
		
	// List locals
		$data['tianguis_id'] = $objet['tianguis_id'];
		$local = $this -> marketsModel -> list_local($data);
		$local = $local['rows'];
		
		$view = (!empty($objet['view'])) ? $objet['view'] : 'modify_order';
		
		require ('views/markets/'.$view.'.php');
	}
	
///////////////// ******** ----						END modify_order					------ ************ //////////////////

///////////////// ******** ----						view_login							------ ************ //////////////////
//////// Load the login view.
	// The parameters that can receive are:
		// div -> Div where the content is loaded
	
	function view_login($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/markets/view_login.php');
	}
	
///////////////// ******** ----						END view_login						------ ************ //////////////////

///////////////// ******** ----						login								------ ************ //////////////////
//////// Vliadate if the tianguis exists.
	// The parameters that can receive are:
		// mail -> Tianguis mail.
		// tel -> Tianguis phone number.
	
	function login($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Check market
		$exists = $this -> marketsModel -> list_markets($objet);
		
		if($exists['total'] > 0){
			$_SESSION['tianguis'] = $exists['rows'][0];
			$_SESSION['tianguis']['id'] = $exists['rows'][0]['id_tianguis'];
			$_SESSION['tianguis']['nombre'] = $exists['rows'][0]['nombre_tianguis'];
		}else{
			$resp['status'] = 2;
		}
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END login							------ ************ //////////////////

///////////////// ******** ----						logout								------ ************ //////////////////
//////// Log out session
	// The parameters that can receive are:
	
	function logout($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
		$_SESSION['tianguis'] = '';
		unset($_SESSION['tianguis']);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END logout							------ ************ //////////////////

///////////////// ******** ----						view_profile						------ ************ //////////////////
//////// Load the profile view.
	// The parameters that can receive are:
	
	function view_profile($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/markets/view_profile.php');
	}
	
///////////////// ******** ----						END view_profile					------ ************ //////////////////

///////////////// ******** ----						update								------ ************ //////////////////
//////// Log out session
	// The parameters that can receive are:
	
	function update($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
		if($_FILES['logo']){
			$estructura = 'data_tianguis/'.$_SESSION['tianguis']['id'];
			mkdir($estructura, 0777, true);
			
			$image = 'data_tianguis/'.$_SESSION['tianguis']['id'].'/'.date('s').basename($_FILES['logo']['name']);
			move_uploaded_file($_FILES['logo']['tmp_name'], $image);
			
			$objet['logo'] = $image;
		}
		
		if (!empty($objet['pass'])) {
			$objet['pass'] = md5($objet['pass']);
		}
		
		$objet['id'] = $_SESSION['tianguis']['id'];
		$resp['result'] = $this -> marketsModel -> update($objet);
		
		$_SESSION['tianguis'] = $objet;
		$_SESSION['tianguis']['nombre'] = $objet['name'];
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END update							------ ************ //////////////////

}

?>