<?php
require ('controllers/common.php');
require ("models/local.php");

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

}

?>