<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  process.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');


////////////////////////////////////////////////////////


if (isset($_GET['file_upload'])) {

	//File upload dir;
	$Putanja 		= 'file/DetectExt/';
	//File Name
	$fFileName 		= $Secure->SecureTxt(basename($Video['name']));
	//File Extensions
	$Ext 			= strtolower(pathinfo($fFileName, PATHINFO_EXTENSION));

	$VideoLink 		= $Secure->linkVideo(20);

	//Save to DB;
	$fullLink 		= $Putanja.$VideoLink.'.'.$Ext;
}





if (isset($_GET['unlock_file'])) {
	//Zastiti input;
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$FileID 	= $Secure->SecureTxt($POST['fID']);
	$PinCode 	= $Secure->SecureTxt($POST['PinCode']);

	if (empty($PinCode)||$PinCode == '') {
		$Alert->SaveAlert('Da biste vidjeli ovaj file morate ukucati pin kod.', 'error');
		header('Location: /file/'.$FileID);
		die();
	}

	if (!($Files->FileByID($FileID)['fPinCode'] == $PinCode) == false) {

		//Unlock
		$Files->UnlockThisFile($FileID);

		//Print message
		$Alert->SaveAlert('Uspesno!', 'success');
		header('Location: /file/'.$FileID);
		die();
	} else {
		$Alert->SaveAlert('Pin kod je pogresan!', 'error');
		header('Location: /file/'.$FileID);
		die();
	}

}