<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  api.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class API {

	public function GetUsersFromDB() {
		global $DataBase;

		$DataBase->Query("SELECT `Email`, `Name`, `Lastname`, `bDay`, `reg_token` FROM `users`");
		$DataBase->Execute();

		return $DataBase->ResultSet();
	}

	public function UserByKEy($uKey) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `reg_token` = :uKey");
		$DataBase->Bind(':uKey', $uKey);
		$DataBase->Execute();

		return $DataBase->Single();
	}

}

?>