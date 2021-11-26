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
	include ('classes/CPT/Submissions.php');
	include ('classes/CPT/EmailLog.php');
	include ('classes/admin/Columns.php');
	include ('classes/admin/ChangeStatus.php');
	include ('inc/callbacks.php');
	
	include ('helpers/extendedSearch.php');
	
	use competitions\API;
	use competitions\Submissions;
	use competitions\EmailLog;
	use competitions\Columns;
	use competitions\ChangeStatus;
	
	$api = new API();
	$api->createAPI();
	
	$submission = new Submissions();
	$emailLog = new EmailLog();
	
	$columns = new Columns();
	$changeStatus = new ChangeStatus();
	
