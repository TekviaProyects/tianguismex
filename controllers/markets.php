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
		
	// Vars
		$last = end($local);
		$x = $last['x'];
		$y = $last['y'];
		$column = 1;
		
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

///////////////// ******** ----						send_recovery						------ ************ //////////////////
////////Check the users and loaded the view
	// The parameters that can receive are:
		// name -> Customer name
	
	function send_recovery($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_POST : $objet;
		$resp['status'] = 1;
		
	// Check info
		$exists = $this -> marketsModel -> list_markets($objet);
		$exists = $exists['rows'][0];
		
	// No data
		if(empty($exists)){
			$resp['status'] = 2;
			echo json_encode($resp);
			
			return;
		}
		
		$objet['id'] = $exists['id_tianguis'];
		$resp['status'] = $this -> eviar_correo($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END send_recovery					------ ************ //////////////////

///////////////// ******** ---- 					eviar_correo						------ ************ //////////////////
//////// Envia un correo de confirmacion al cliente
	// Como parametros puede recibir:
		// u_id -> ID unico del cliente
		// mail -> Correo del cliente

	function eviar_correo($objet) {
	// Si el objeto viene vacio(llamado desde el index) se le asigna el $_POST que manda el Index
	// Si no conserva su valor normal
		$objet = (empty($objet)) ? $_POST : $objet;
		
	// Valida si viene del local host
		$url = ($objet['localhost'] == 1) ? 'http://localhost/tianguismex/' : 'http://mercaditopuertadelsol.com/new/' ;
		
		require("plugins/phpmailerlibs/class.phpmailer.php");
		require("plugins/phpmailerlibs/class.smtp.php");
		
		$correom = $objet['mail'];
		$mail = new PHPMailer();
		$mail -> IsSMTP();
		$mail -> SMTPAuth = true;
		$mail -> SMTPSecure = "ssl";
		$mail -> Host = "smtp.gmail.com";
		$mail -> Port = 465;
		$mail -> Username = "tekviaprogramacion@gmail.com";
		$mail -> Password = "tekvia123";

		$mail->From = "TianguisMex";
		$mail->FromName = "TianguisMex";
		$mail->Subject = "Recuperar cuenta";
		$mail->AltBody = "";
		$mail->MsgHTML("
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset='utf-8'>
				</head>
				<body style='background-color:#F2F2F2; width:92%; margin-left:4px; position:absolute;'>
					<div style='color:#2E2E2E; font-family:sans-serif; font-size:12px; font-weight:normal;'>
						<div style='background-color:#EE6E73; width:100%; height:75px;'>
						</div>
						<div style='color:#2E2E2E; font-family:sans-serif;margin:8px; font-size:12px; font-weight:normal;'>
							<h1>Recuperar cuenta</h1>
							<div style='width:100%;height:2px;background-color:#848484;'> </div>
							<h3>Da click en el boton para recuperar tu cuenta</h3>
							<a
								style='text-decoration:none;'
								href='".$url."ajax.php?c=markets&f=new_pass&id=".$objet['id']."&pass=".$objet['pass_recovery']."'
								target='_blank'>
								<div
									style='margin-bottom:0px; text-align:center;
											background-color:#2BBBAD; border-radius:10px; padding: 10px;
											border-color:orange; color:#fff;
											font-size:30px; width:160px;'>
									Recuperar
								</div>
							</a>
						</div>
						<div style='width:100%;height:2px;background-color:#848484;'> </div>
						<br>
						<div style='background-color:#2E2E2E; height:45px;width:100%;
									text-align:center; color:#fff; font-size:11px;'>
							<img style='height:20px; margin-top:8px;'
								src='http://mercaditopuertadelsol.com/cliente/resources/tekviacloud.png'>
							<br>
							Design by Tekvia
						</div>
						<div style='width:100%;height:10px;background-color:#2E2E2E;'> </div>
					</div>
				</body>
			</html>
		");
		$mail->AddReplyTo("$correom");
		$mail->AddAddress("$correom");
		$mail->IsHTML(true);

		$resp['result'] = $mail->Send();

		if (!$resp['result']) {
			$resp['mensaje'] = $mail->ErrorInfo;
		}else{
			$resp = 1;
		}

		return $resp;
	}

///////////////// ******** ---- 					FIN eviar_correo					------ ************ //////////////////

///////////////// ******** ----							new_pass						------ ************ //////////////////
//////// Change the user pass
	// The parameters that can receive are:
		// id -> User ID
		// pass -> New password
	
	function new_pass($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_GET : $objet;
		
		$update = $this -> marketsModel -> new_pass($objet);
		
		if(!empty($update)){
			echo "	<script>
						alert('Tu contraseña ha sido cambiada');
						location.href='admin.php';
					</script>";	
		}else{
			echo "	<script>
						alert('Problema al cambiar la contraseña, intentalo de nuevo');
						location.href='admin.php';
					</script>";	
		}
		
	}
	
///////////////// ******** ----						END new_pass						------ ************ //////////////////

///////////////// ******** ----						view_sketch							------ ************ //////////////////
//////// Load the view to sketch
	// The parameters that can receive are:
		// tianguis_id -> Tianguis ID
		
	function view_sketch($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
	// List categories
		$categories = $this -> marketsModel -> list_cats($objet);
		$categories = $categories['rows'];
		
	// List locals
		$local = $this -> marketsModel -> list_local($objet);
		$local = $local['rows'];
		
		foreach ($local as $key => $value) {
			if(!empty($value['join'])){
				$value['local_id'] = $value['id'];
				$local[$key]['joins'] = $this -> marketsModel -> list_joins($value);
				$local[$key]['joins'] = $local[$key]['joins']['rows'];
			}
		}
		
	// Vars
		$last = end($local);
		$x = $last['x'];
		$y = $last['y'];
		$column = 1;
		
		require ('views/markets/view_sketch.php');
	}
	
///////////////// ******** ----						END view_sketch						------ ************ //////////////////

///////////////// ******** ----						save_sketch							------ ************ //////////////////
//////// Save the locals on the DB
	// The parameters that can receive are:
	// The parameters that can receive are:
		// x -> X local position
		// y -> Y local position
		// text -> Text to show
		// show -> 1-> Show local, 0-> Hide local
		// cat_id -> Category ID
		// disabled -> 1-> Disabled, 0-> Enabled
	
	function save_sketch($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
		$objet['tianguis_id'] = $_SESSION['tianguis']['id'];
		$resp['save'] = $this -> marketsModel -> save_local($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END save_sketch						------ ************ //////////////////

///////////////// ******** ----						update_local						------ ************ //////////////////
//////// Update the local data on the DB
	// The parameters that can receive are:
		// status -> New local status
	
	function update_local($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
		$objet['tianguis_id'] = $_SESSION['tianguis']['id'];
		$objet['columns'] = (!empty($objet['status'])) ? ' status = '.$objet['status'] : '';
		
		$resp['delete'] = $this -> marketsModel -> update_local($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END update_local					------ ************ //////////////////

///////////////// ******** ----						save_category						------ ************ //////////////////
//////// Save a tianguis category
	// The parameters that can receive are:
		// name -> Name of the category
		// cost -> Cost of the category
		// description -> Description of the category
	
	function save_category($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
		$objet['tianguis_id'] = $_SESSION['tianguis']['id'];
		$resp['delete'] = $this -> marketsModel -> save_category($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END save_category					------ ************ //////////////////

///////////////// ******** ----						update_sketch						------ ************ //////////////////
//////// Update the locals on the DB
	// The parameters that can receive are:
		// x -> X local position
		// y -> Y local position
		// text -> Text to show
		// show -> 1-> Show local, 0-> Hide local
		// id -> Local ID
		// cat_id -> Category ID
		// disabled -> 1-> Disabled, 0-> Enabled
	
	function update_sketch($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		session_start();
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
		$objet['tianguis_id'] = $_SESSION['tianguis']['id'];
		$resp['update'] = $this -> marketsModel -> update_sketch($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END update_sketch					------ ************ //////////////////

}

?>