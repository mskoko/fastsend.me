<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*   file                 :  download.php
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*   author               :  Muhamed Skoko - info@mskoko.me
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (isset($_GET['id'])) {
	$FileID = $Secure->SecureTxt($_GET['id']);

	//File provera
	if (empty($Files->FileByID($FileID)['id'])) {
		header("Location: /home");
	}
} else {
	header("Location: /home");
}

if (empty($Secure->SecureTxt($Files->FileByID($FileID)['fPinCode'])) || !($Files->IsPinCode($FileID)) == false || $Files->FileByID($FileID)['userID'] == $User->UserData()['id']) {

	//Add view on file download
	if ($Files->isViewThisFile($FileID, $User->UserData()['id'], $User->userIP(), $User->userHost()) == 0) {
		$Files->ViewThisFile($FileID, $User->UserData()['id'], $User->userIP(), $User->userHost());
	}

	ignore_user_abort(true);
	set_time_limit(0); // disable the time limit for this script

	//Build absolute file path
	$fPath = $Secure->SecureTxt($_SERVER['DOCUMENT_ROOT'].'/'.$Files->FileByID($FileID)['fLink']);

	//Check if file exists
	if (!file_exists($fPath)) {
		die('Ovaj fajl ne postoji na nasim serverima!');
	}

	//Check if file is readable
	if (!is_readable($fPath)) {
		die('Ovaj fajl se ne moze skinuti!');
	}

	# detect MIME type (http://stackoverflow.com/a/32092523/1800854)
	$fInfo = finfo_open(FILEINFO_MIME_TYPE);
	header('Content-Type: ' . finfo_file($fInfo, $fPath));
	$fInfo = finfo_open(FILEINFO_MIME_ENCODING);
	header('Content-Transfer-Encoding: ' . finfo_file($fInfo, $fPath)); 
	header('Content-disposition: attachment; filename="' . basename($fPath) . '"'); 

	//Preuzim file;
	if (!readfile($fPath)) {
		$Alert->SaveAlert('Doslo je do nepoznate greske! Nas support je obavesten o ovome!', 'error');
		header('Location: /file/'.$FileID);
		die();
	} else {
		//$Alert->SaveAlert('File se preuzima!', 'success');
		//header('Refresh: 1; /file/'.$FileID);
		die();
	}
} else {
	$Alert->SaveAlert('Ovaj file je zasticen sifrom!', 'error');
	header('Location: /file/'.$FileID);
	die();
}


?>