<?php
include_once 'configuration.php';
include_once 'functions/functions.php';
//start_session();
$timeDate = date("Y-m-d H:i:s");
$loggedIn=0;
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
								if (empty($_POST['passcode'])){
																$error = "Passcode is not valid. Sorry.";
															  }
								else { $passcode=strtoupper($_POST['passcode']); }
}

if ($passcodeEnable) {
		$passcode = stripslashes($passcode);
		$passCodes = getPasscodes();
		foreach($passCodes as $pass) {
			if ($pass == $passcode) {
										setcookie("lffkey", $passcode, time()+ $maxCookieAge); // set the user's cookie so they stay logged in
										setcookie("lffID",uniqid(), time() + $maxCookieAge); // set a unique ID in a cookie
										header("location: list.php"); // redirect em to the main page
										$loggedIn=1;
										break;
				} else {
						setcookie("lffkey", "", time() - 3600);
						header("location: index.php");
						}	
			}		
		}

		if (!$loggedIn) { header("location:index.php"); } else { header("location:list.php"); }


?>



