<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  user.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class User {

	public function LogIn($Email, $Password) {
		global $DataBase;
		global $Core;
		global $Alert;

		$DataBase->Query("SELECT id, Email, Password FROM `users` WHERE `Email` = :Email");
		$DataBase->Bind(':Email', $Email);
		$DataBase->Execute();

		$UserData 	= $DataBase->Single();
		$UserCount 	= $DataBase->RowCount();

		if($UserCount == true && md5($Password) == $UserData['Password']) {
			$_SESSION['UserLogin']['ID']	 	= $UserData['id'];

			$Alert->SaveAlert('Uspesno ste se ulogovali!', 'success');
			header("Location: /home?Success_login");
			exit();
		} else {
			$Alert->SaveAlert('Uneli ste netačne podatke. Pokušajte ponovo!', 'error');
			header("Location: /login?login");
			exit();
		}
	}

	public function IsLoged() {
		if(isset($_SESSION['UserLogin'])) {
			return true;
		} else {
			return false;
		}
	}

	public function UserData() {
		global $DataBase;

		if(isset($_SESSION['UserLogin'])) {
			$DataBase->Query("SELECT * FROM `users` WHERE `id` = :uID");
			$DataBase->Bind(':uID', $_SESSION['UserLogin']['ID']);
			$DataBase->Execute();

			return $DataBase->Single();
		} else {
			return false;
		}
	}

	public function UserDataByID($uID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `id` = :uID");
		$DataBase->Bind(':uID', $uID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function userIP() {
		
		return 'ip';
	}

	public function userHost() {
		
		return 'host';
	}

}

?>