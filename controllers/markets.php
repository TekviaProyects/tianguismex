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
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
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
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
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
		
		$local = $this -> marketsModel -> list_local($objet);
		$local = $local['rows'];
		
		require ('views/markets/list_local.php');
	}
	
///////////////// ******** ----						END list_local						------ ************ //////////////////

}

?>