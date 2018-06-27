<?php
	error_reporting(E_ALL);
// Send text message
	// require_once('vendor/autoload.php');
	// use Twilio\Rest\Client;
	require __DIR__ . '/vendor/autoload.php';

	// Use the REST API Client to make requests to the Twilio REST API
	use Twilio\Rest\Client;



	$message = new Twilio\Rest\Client("AC8da101d6b7b794bbca955be47a01b8b4", "48703ac1820b5d2e13c21a393284d630");

	$res = array();

	echo "Todo bien :D <br/><pre>", print_r($res), "</pre>";
?>
