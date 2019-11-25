<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('error_log', 'dev/logs/errors.log'); // Logging file path
	error_reporting(E_ALL | E_STRICT | E_NOTICE);
	
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	
	ob_start();

	date_default_timezone_set('Europe/Belgrade');

	// URL
	$url = $_SERVER['DOCUMENT_ROOT'];

	// Configuration Files
	include_once($url.'/core/inc/config.php');         			// MySQL Config File

	// Classes
	include_once($url.'/core/class/db.class.php'); 				// MySQL Managment Class
	include_once($url.'/core/class/user.class.php'); 			// User Managment Class
	include_once($url.'/core/class/secure.class.php');    		// Secure Managment Class
	include_once($url.'/core/class/site.class.php');    		// Site Managment Class
	include_once($url.'/core/class/upload.class.php');    		// Upload Managment Class
	include_once($url.'/core/class/api.class.php');    			// API Managment Class
	include_once($url.'/core/class/alert.class.php');    		// Alert Managment Class
	include_once($url.'/core/class/mail.class.php');    		// Mail Managment Class
	include_once($url.'/core/class/log.class.php');    			// Logs Managment Class
	include_once($url.'/core/class/files.class.php');    		// Files Managment Class
	
	// Lang Class
	include_once($url.'/core/class/lang.class.php'); 			// Lang Managment Class

	// Initializing Classes
	$DataBase 	= new Database();
	$User 		= new User();
	$Secure 	= new Secure();
	$Site 		= new Site();
	$Upload 	= new Upload();
	$API 		= new API();
	$Alert 		= new Alert();
	$onbrdMail 	= new onbrdMail();
	$Logs 		= new Logs();
	$Files 		= new Files();

	// PHPMailer
	require_once($url.'/core/inc/libs/PHPMailer-master/class.phpmailer.php');
	require_once($url.'/core/inc/libs/PHPMailer-master/class.smtp.php');

	$mail = new PHPMailer();

	// Email template
	//include_once($url.'/assets/php/email_tmp.php');



	/* Test */
	//echo $_SESSION['lang'];

	//print_r($_SESSION);
	//die();

	//var_dump(session_id());
	//print_r(session_status());
?>