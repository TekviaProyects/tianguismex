<?php

// error_reporting(E_ALL);

require ('controllers/common.php');
require ("models/users.php");

class users extends Common {
	public $usersModel;
	function __construct() {
		$this -> usersModel = new usersModel();
	}

///////////////// ******** ----							 save							------ ************ //////////////////
//////// Call the function to save user on the DB
	// The parameters that can receive are:
		// last_name -> Customer last name 		
		// last_name2 -> Customer second last name 					
		// mail -> Customer mail 							
		// name -> Customer name
		// pass -> Password
		// curp -> Customer CURP
		// estadodep -> Customer state
		// municipiodep -> Customer municipality
		// colony -> Customer colony
		// addres -> Customer addres
		// num -> External number
		// num_int -> Internal number
		
	function save($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Save user
		$resp['result'] = $this -> usersModel -> save($objet);
		
	// User exists
		if($resp['result']['status'] == 2){
			echo json_encode($resp['result']);
			
			return;
		}
		
		session_start();
		$_SESSION['user'] = $_REQUEST;
		$_SESSION['user']['id'] = $resp['result'];
		$_SESSION['user']['nombre'] = $_REQUEST['name'];
		$_SESSION['user']['correo'] = $_REQUEST['mail'];
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END save							------ ************ //////////////////

///////////////// ******** ----						update								------ ************ //////////////////
//////// Call the function to update customer and schedules on the DB
	// The parameters that can receive are:
		// badge -> Number of badge customer 				// lu -> 1 -> Selected, 0 -> Not selected
		// clasification -> Customer clasification 			// ma -> 1 -> Selected, 0 -> Not selected
		// folio -> Customer folio 							// mi -> 1 -> Selected, 0 -> Not selected
		// job -> Customer job 								// ju -> 1 -> Selected, 0 -> Not selected
		// last_name -> Customer last name 					// vi -> 1 -> Selected, 0 -> Not selected
		// last_name2 -> Customer last name mom 			// sa -> 1 -> Selected, 0 -> Not selected
		// mail -> Customer mail 							// do -> 1 -> Selected, 0 -> Not selected
		// name -> Customer name
		// period -> Start date
		// period2 -> End date
		// schedule_end -> End schedulde
		// schedule_ini -> Start schedulde
		// sex -> 1 -> Man, 2-> Woman
		// sub_turn -> Customer sub turn
		// surface -> Local surface in metters
		// surface_type -> 1 -> Squares, 2-> Linear
		// Tel -> Customer phone number
		// turn -> Customer turn
		// ubication -> Local ubication
		// zone -> Local zone
		
		
	function update($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Save customer
		$resp['result'] = $this -> usersModel -> update($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END update						------ ************ //////////////////

///////////////// ******** ----							 add							------ ************ //////////////////
//////// Loaded the view to add a customer
	// The parameters that can receive are:
		// div -> Div where the content is loaded
	
	function add($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		if($objet['edit'] == 1){
			$customer = $this -> usersModel -> list_users($objet);
			$customer = $customer['rows'][0];
		}
		
		
		require ('views/users/add.php');
	}
	
///////////////// ******** ----						END add								------ ************ //////////////////

///////////////// ******** ----						list_users						------ ************ //////////////////
////////Check the users and loaded the view
	// The parameters that can receive are:
		// name -> Customer name
	
	function list_users($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		$users = $this -> usersModel -> list_users($objet);
		$users = $users['rows'];
		
		require ('views/users/list_users.php');
	}
	
///////////////// ******** ----						END list_users					------ ************ //////////////////

///////////////// ******** ----							signin								------ ************ //////////////////
////////Check the users and loaded the view
	// The parameters that can receive are:
		// name -> Customer name
	
	function signin($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Check info
		$user = $this -> usersModel -> list_users($objet);
		$user = $user['rows'][0];
	
	// No data
		if(empty($user)){
			$resp['status'] = 2;
			echo json_encode($resp);
			
			return;
		}
		
		session_start();
		$_SESSION['user'] = $user;
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END signin							------ ************ //////////////////

///////////////// ******** ----						send_recovery						------ ************ //////////////////
////////Check the users and loaded the view
	// The parameters that can receive are:
		// name -> Customer name
	
	function send_recovery($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Check info
		$user = $this -> usersModel -> list_users($objet);
		$user = $user['rows'][0];
		
	// No data
		if(empty($user)){
			$resp['status'] = 2;
			echo json_encode($resp);
			
			return;
		}
		
		$objet['id'] = $user['id'];
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
	// Si el objeto viene vacio(llamado desde el index) se le asigna el $_REQUEST que manda el Index
	// Si no conserva su valor normal
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
	// Valida si viene del local host
		$url = ($objet['localhost'] == 1) ? 'http://localhost/casapp/' : 'http://c0260330.ferozo.com/' ;

		require("plugins/phpmailerlibs/class.phpmailer.php");
		require("plugins/phpmailerlibs/class.smtp.php");

		$correom = $objet['mail'];

		$mail = new PHPMailer();
		$mail->IsSMTP();
		// $mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->Username = "tekviaprogramacion@gmail.com";
		$mail->Password = "tekvia123";

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
								href='".$url."ajax.php?c=users&f=new_pass&id=".$objet['id']."&pass=".$objet['pass']."'
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
		
		$update = $this -> usersModel -> new_pass($objet);
		
		if(!empty($update)){
			echo "	<script>
						alert('Tu contraseña ha sido cambiada');
						location.href='index.php';
					</script>";	
		}else{
			echo "	<script>
						alert('Problema al cambiar la contraseña, intentalo de nuevo');
						location.href='index.php';
					</script>";	
		}
		
	}
	
///////////////// ******** ----						END new_pass						------ ************ //////////////////

///////////////// ******** ----						view_profile						------ ************ //////////////////
//////// Loaded the view profile
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// mail -> User mail
	
	function view_profile($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		$user = $this -> usersModel -> list_users($objet);
		$user = $user['rows'][0];
		
		require ('views/users/view_profile.php');
	}
	
///////////////// ******** ----						END view_profile					------ ************ //////////////////

///////////////// ******** ----						view_gafette						------ ************ //////////////////
//////// Loaded the view gafette
	// The parameters that can receive are:
		// div -> Div where the content is loaded
		// mail -> User mail
	
	function view_gafette($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		$user = $this -> usersModel -> list_users($objet);
		$user = $user['rows'][0];
		
		$places = $this -> usersModel -> list_places($objet);
		$places = $places['rows'];
		
		require ('views/users/view_gafette.php');
	}
	
///////////////// ******** ----						END view_gafette					------ ************ //////////////////

///////////////// ******** ----							 edit							------ ************ //////////////////
//////// Call the function to update user on the DB
	// The parameters that can receive are:
		// id -> User ID				
		// correo_cliente -> Customer mail 							
		// nombre_cliente -> Customer name					
		// celular_cliente -> Phone number name			
		// domicilio_cliente -> Addres name
		
	function edit($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Save user
		$resp['result'] = $this -> usersModel -> edit($objet);
		
		session_start();
		$_SESSION['user'] = $_REQUEST;
		$_SESSION['user']['nombre'] = $_REQUEST['nombre_cliente'];
		$_SESSION['user']['mail'] = $_REQUEST['correo_cliente'];
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END edit							------ ************ //////////////////

///////////////// ******** ----						view_insurance_policy				------ ************ //////////////////
//////// Loaded the insurance policy view
	// The parameters that can receive are:
		// mail -> User mail
	
	function view_insurance_policy($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		$user = $this -> usersModel -> list_users($objet);
		$user = $user['rows'][0];
		
		require ('views/users/view_insurance_policy.php');
	}
	
///////////////// ******** ----						END view_insurance_policy			------ ************ //////////////////

///////////////// ******** ----							 list_clients					------ ************ //////////////////
//////// Check the clients and return into a view
	// The parameters that can receive are:
		// tianguis_id -> Tianguis ID
	
	function list_clients($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		$clients = $this -> usersModel -> list_clients($objet);
		$clients = $clients['rows'];
		
		require ('views/users/list_users.php');
	}
	
///////////////// ******** ----						END list_clients					------ ************ //////////////////

///////////////// ******** ----						update_x_tianguis					------ ************ //////////////////
//////// Update the client infomation
	// The parameters that can receive are:
		// client_id -> Client ID
		// status -> Status to change
		// tianguis_id -> Tianguis ID
		
	function update_x_tianguis($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$resp['status'] = 1;
		
	// Save customer
		$resp['result'] = $this -> usersModel -> update_x_tianguis($objet);
		
		echo json_encode($resp);
	}
	
///////////////// ******** ----						END update_x_tianguis				------ ************ //////////////////

}

?>