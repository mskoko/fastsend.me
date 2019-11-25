<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  files.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class Files {

	public function FileByID($fID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `files` WHERE `id` = :fID");
		$DataBase->Bind(':fID', $fID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function IsPinCode($fID) {
		global $Files;

		if(isset($_SESSION['file_pp_'.$fID])) {
			if ($_SESSION['file_pp_'.$fID] == $fID) {
				$return = true;
			} else {
				$return = false;
			}
		} else {
			$return = false;
		}

		return $return;
	}

	public function UnlockThisFile($fID) {
		if (empty($fID)||$fID == '') {
			$return = false;
		} else {
			$_SESSION['file_pp_'.$fID] = $fID;
		}
	}

	public function MyFiles($userID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `files` WHERE `userID` = :userID");
		$DataBase->Bind(':userID', $userID);
		$DataBase->Execute();

		return $DataBase->ResultSet();
	}

	public function FileSave($userID, $fTitle, $fPinCode, $fLink) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `files` (`id`, `userID`, `fTitle`, `fLink`, `fPinCode`, `Date`, `Time`) VALUES (NULL, :userID, :fTitle, :fLink, :fPinCode, :Date, :Time);");
		$DataBase->Bind(':userID', $userID);
		$DataBase->Bind(':fTitle', $fTitle);
		$DataBase->Bind(':fLink', $fLink);
		$DataBase->Bind(':fPinCode', $fPinCode);
		$DataBase->Bind(':Date', date('d.m.Y'));
		$DataBase->Bind(':Time', date('h:i'));

		return $DataBase->Execute();
	}

	public function ViewsThisFile($fID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `file_view` WHERE `file_id` = :fID");
		$DataBase->Bind(':fID', $fID);
		$DataBase->Execute();

		return $DataBase->RowCount();
	}

	public function isViewThisFile($fID, $userID, $userIP, $userHost) {
		global $DataBase;
		global $User;

		if (!($User->IsLoged()) == false) {
			$DataBase->Query("SELECT * FROM `file_view` WHERE `file_id` = :fID AND `user_id` = :userID");
			$DataBase->Bind(':fID', $fID);
			$DataBase->Bind(':userID', $userID);
		} else {
			$DataBase->Query("SELECT * FROM `file_view` WHERE `file_id` = :fID AND `user_ip` = :userIP AND `user_host` = :userHost");
			$DataBase->Bind(':fID', $fID);
			$DataBase->Bind(':userIP', $userIP);
			$DataBase->Bind(':userHost', $userHost);
		}

		$DataBase->Execute();

		return $DataBase->RowCount();
	}


	public function ViewThisFile($fID, $userID, $userIP, $userHost) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `file_view` (`id`, `file_id`, `user_id`, `user_ip`, `user_host`, `Date`) VALUES (NULL, :fID, :userID, :userIP, :userHost, :Date);");
		$DataBase->Bind(':fID', $fID);
		$DataBase->Bind(':userID', $userID);
		$DataBase->Bind(':userIP', $userIP);
		$DataBase->Bind(':userHost', $userHost);
		$DataBase->Bind(':Date', date('d.m.Y, H:ia'));
		
		return $DataBase->Execute();
	}

	public function DetectFileExt($fID) {
		global $Files;

		$FileLink = $Files->FileByID($fID)['fLink'];
		$Ext = strtolower(pathinfo($FileLink, PATHINFO_EXTENSION));

		$inFolder = $Files->returnFolderNameExt($Ext);

		return $inFolder;

	}

	public function returnFolderNameExt($Ext) {
		if ($Ext == 'mp4'||$Ext == 'avi') {
			$return = 'v';
		} else if ($Ext == 'jpeg'||$Ext == 'jpg'||$Ext == 'png'||$Ext == 'gif') {
			$return = 'i';
		} else if ($Ext == 'rar'||$Ext == 'zip'||$Ext == 'gz'||$Ext == 'tar') {
			$return = 'f';
		} else if ($Ext == 'doc'||$Ext == 'txt') {
			$return = 'd';
		}

		return $return;
	}




}