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
	
	include ('classes/API.php');
	include ('classes/Submissions.php');
	include ('classes/EmailLog.php');

	include ('inc/callbacks.php');
	include ('admin/columns.php');

	use competitions\API;
	use competitions\Submissions;
	use competitions\EmailLog;
	
	
	$api = new API();
	$api->createAPI();
	
	$submission = new Submissions();
	$emailLog = new EmailLog();