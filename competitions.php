<?php
	
	/*
	Plugin Name: Competitions
	Plugin URI: http://zakoduje.com.pl
	Description: Wtyczka do konkursów organizowanych przez 19Południk
	Version: 1.0
	Author: mateuszwitkowski
	Author URI: http://zakoduje.com.pl
	License: MIT
	*/
	
	require_once ('config.php');
	require_once ('inc/API.php');
	require_once ('inc/submissions.php');
	require_once ('inc/callbacks.php');
	
	use competitions\API;
	
	$api = new API();
	$api->createAPI();
	
	