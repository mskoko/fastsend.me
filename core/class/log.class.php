<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  log.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


class Logs {

	/*
	 * Save server error log
	*/
	public function ServerErrorLog($logName, $FileLink) {
		

	}

	/*
	 * Save client error log
	*/
	public function ClientErrorLog($logName, $FileLink, $userID, $CompanyID) {
		

	}


	///////////////////////////////////////////
	
	/*
	 *
	*/
	public function PrintLogs($File) {
		$fn = fopen($File, 'r');
		
		while(!feof($fn))  {
			$result = fgets($fn);
			echo $result.'<hr>';
		}

		fclose($fn);
	} 
}

?>