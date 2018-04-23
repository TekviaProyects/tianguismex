<?php

// error_reporting(E_ALL);

require ('controllers/common.php');
require ("models/reports.php");

class reports extends Common {
	public $reportsModel;
	function __construct() {
		$this -> reportsModel = new reportsModel();
	}

///////////////// ******** ----							 view_periodic					------ ************ //////////////////
//////// Load a report periodic view
	// The parameters that can receive are:
	
	function view_periodic($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		
		require ('views/reports/view_periodic.php');
	}
	
///////////////// ******** ----						END view_periodic					------ ************ //////////////////

///////////////// ******** ----						list_periodic						------ ************ //////////////////
//////// Check the periodic report data and load a view
	// The parameters that can receive are:
		// range -> Range of dates
		// tianguis_id -> Tianguis ID
	
	function list_periodic($objet) {
	// If the object is empty (called from the ajax) it assigns $ _POST that is sent from the index
	// If not, take its normal value
		$objet = (empty($objet)) ? $_REQUEST : $objet;
		$data = array();
		
	// Explode date
		$date = explode(" - ", $objet['range']);
		$objet['f_ini'] = $date[0].' 00:00:01';
		$objet['f_end'] = $date[1].' 23:59:59';
		
		$rows = $this -> reportsModel -> list_periodic($objet);
		$rows = $rows['rows'];
		
		foreach ($rows as $key => $value) {
			$data[$value['client_id']][$value['status']] = $value['total'];
			$data[$value['client_id']]['name'] = $value['client_name'];
			$data[$value['client_id']]['mail'] = $value['client_mail'];
		}
		
		// echo "<pre>", print_r($data), "</pre>";
		
		require ('views/reports/list_periodic.php');
	}
	
///////////////// ******** ----						END list_periodic					------ ************ //////////////////

}

?>