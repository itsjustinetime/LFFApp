<?php
include_once 'configuration.php';
include_once 'functions/functions.php';
//start_session();
$timeDate = date("Y-m-d H:i:s");
$loggedIn=0;
$expired=0;
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
								if (empty($_POST['passcode'])){
																$error = "Passcode is not valid. Sorry.";
															  }
								else { $passcode=strtoupper($_POST['passcode']); }
}

if ($passcodeEnable) {
		$passcode = stripslashes($passcode);
		$passCodes = getPasscodesExpiry();
		foreach($passCodes as $pass) {
			if ($pass->passcodevalue == $passcode) {
				if ($pass->passcodeexpires > $timeDate) {
										setcookie("lffkey", $passcode, time()+ $maxCookieAge); // set the user's cookie so they stay logged in
										setcookie("lffID",uniqid(), time() + $maxCookieAge); // set a unique ID in a cookie
										header("location: list.php"); exit; // redirect em to the main page
										$loggedIn=1;
										break;
				} else { $expired=1; break; }
							
			}	
		}
		if ($expired==1) { header("location:expired.php"); exit;}
		if (!$loggedIn && $expired == 0 ) { header("location:index.php"); exit;} else { header("location:list.php"); exit;}

} else { header("location:list.php");exit; }
?>



