<?php

class openpayObject {
// Initialize vars
	private $id = "mngsvcdrvfxhfkedj98m";
	private $token = "sk_e9c168c23f464f7eb5a1c1c591d8c21e";
	private $production = 0;
	private $openpay;

// Initialize la api with the keys
	public function __construct() {
		$this -> openpay = Openpay::getInstance($this -> id, $this -> token);
		
	// false -> Test, true -> Production
		$test = ($this->production == 0) ? false : true ;
		
		Openpay::setProductionMode($test); 
	}

///////////////// ******** ---- 				create_charge				 		------ ************ //////////////////
//////// Generate a charge use Openpay
	// The parameters can receive:
		// amount -> Amount of the charge
		// description -> Description to the pay
		// due_date -> Data limit to pay
		// customer -> Array with the user info
		
	public function create_charge($objet) {
		$objet['method'] = 'store';
		$resp = $this -> openpay -> charges -> create($objet);
		
		return $resp;
	}
	
///////////////// ******** ---- 				END create_charge					------ ************ //////////////////

///////////////// ******** ---- 				add_customer				 		------ ************ //////////////////
//////// Create a customer
	// The parameters can receive:
		// name -> Customer name
		// email -> Customer mail
		// requires_account -> True -> Require that the user have acount, False -> No require
		
	public function add_customer($objet) {
		try {
			$resp['status'] = 1;
			$resp['result'] = $this -> openpay -> customers -> add($objet);
		} catch (OpenpayApiTransactionError $e) {
			$resp['status'] = 2;
			$resp['message'] = $e->getMessage();
			$resp['error_code'] = $e->getErrorCode();
			$resp['error_category'] = $e->getCategory();
			$resp['HTTP_code'] = $e->getHttpCode();
			$resp['request_ID'] = $e->getRequestId();
		} catch (OpenpayApiRequestError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the request: ' . $e->getMessage();
		} catch (OpenpayApiConnectionError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR while connecting to the API: ' . $e->getMessage();
		} catch (OpenpayApiAuthError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the authentication: ' . $e->getMessage();
		} catch (OpenpayApiError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the API: ' . $e->getMessage();
		} catch (Exception $e) {
			$resp['status'] = 2;
			$resp['message'] = 'Error on the script: ' . $e->getMessage();
		}
		
		return $resp;
	}
	
///////////////// ******** ---- 				END add_customer					------ ************ //////////////////

///////////////// ******** ---- 				get_customer				 		------ ************ //////////////////
//////// Get a customer information
	// The parameters can receive:
		// o_id -> Open pay ID customer
		
	public function get_customer($objet) {
		$resp['status'] = 1;
		
		try {
			$resp['result'] = $this -> openpay -> customers -> get($objet['o_id']);
		} catch (OpenpayApiTransactionError $e) {
			$resp['status'] = 2;
			$resp['message'] = $e->getMessage();
			$resp['error_code'] = $e->getErrorCode();
			$resp['error_category'] = $e->getCategory();
			$resp['HTTP_code'] = $e->getHttpCode();
			$resp['request_ID'] = $e->getRequestId();
		} catch (OpenpayApiRequestError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the request: ' . $e->getMessage();
			$resp['error_code'] = $e->getErrorCode();
		} catch (OpenpayApiConnectionError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR while connecting to the API: ' . $e->getMessage();
		} catch (OpenpayApiAuthError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the authentication: ' . $e->getMessage();
		} catch (OpenpayApiError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the API: ' . $e->getMessage();
		} catch (Exception $e) {
			$resp['status'] = 2;
			$resp['message'] = 'Error on the script: ' . $e->getMessage();
		}
		
		return $resp;
	}
	
///////////////// ******** ---- 				END get_customer					------ ************ //////////////////

///////////////// ******** ---- 				create_card_charge			 		------ ************ //////////////////
//////// Get a customer information
	// The parameters can receive:
		// o_id -> Open pay ID customer
		
	public function create_card_charge($objet) {
		$resp['status'] = 1;
		
		try {
			$resp['result'] = $this -> openpay -> charges -> create($objet);
		} catch (OpenpayApiTransactionError $e) {
			$resp['status'] = 2;
			$resp['message'] = $e->getMessage();
			$resp['error_code'] = $e->getErrorCode();
			$resp['error_category'] = $e->getCategory();
			$resp['HTTP_code'] = $e->getHttpCode();
			$resp['request_ID'] = $e->getRequestId();
		} catch (OpenpayApiRequestError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the request: ' . $e->getMessage();
		} catch (OpenpayApiConnectionError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR while connecting to the API: ' . $e->getMessage();
		} catch (OpenpayApiAuthError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the authentication: ' . $e->getMessage();
		} catch (OpenpayApiError $e) {
			$resp['status'] = 2;
			$resp['message'] = 'ERROR on the API: ' . $e->getMessage();
		} catch (Exception $e) {
			$resp['status'] = 2;
			$resp['message'] = 'Error on the script: ' . $e->getMessage();
		}
		
		return $resp;
	}
	
///////////////// ******** ---- 				END create_card_charge				------ ************ //////////////////

///////////////// ******** ---- 				list_customers				 		------ ************ //////////////////
//////// Check the customers and return into array
	// The parameters can receive:
		// f_ini -> Date start
		// f_end -> Date end
		
	public function list_customers($objet) {
		$findData = array(
			'creation[gte]' => $objet['f_ini'],
			'creation[lte]' => $objet['f_end'],
			'offset' => 0,
			'limit' => 999
		);
		$resp = $this -> openpay -> customers -> getList($findData);
		
		return $resp;
	}
	
///////////////// ******** ---- 				END list_customers					------ ************ //////////////////

}
?>