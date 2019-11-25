<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  site.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class Site {

	public function SiteConfig($id=1) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `site_settings` WHERE `id`=:ID");
		$DataBase->Bind(':ID', $id);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function createFolder($path) {
		global $Site;

	    if (is_dir($path)) return true;
	    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
	    $return = $Site->createFolder($prev_path);
	    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}

}

?>