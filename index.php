<?php
include_once 'configuration.php';
include_once 'functions/functions.php';
//include_once 'logging.php';
//session_start();
function logWrongPasscode($code) {
	file_put_contents('logs/wrongcodes.txt', "incorrect:".$code."\n", FILE_APPEND);
}

if((isset($_SESSION['lffkey']) && $_SESSION['lffkey'] ='') || ($passcodeEnable==0)){ header("location: list.php"); }
$timeDate = date("Y-m-d H:i:s");
$loggedIn=0;
$expired=0;
// test for cookie being a valid lff passcode
if(isset($_COOKIE['lffkey'])){
    $passcode = $_COOKIE['lffkey'];
    $passcode = stripslashes($passcode);
	$passCodes = getPasscodesExpiry();
		foreach ($passCodes as $pass) {
			if ($pass->passcodevalue == $passcode) {
				if ( $pass->passcodeexpires > $timeDate) {  $loggedIn=1; break; } else { $expired=1; break; }
			}
		}
	if ($expired) { header("location:expired.php"); exit;}	
	//if ($loggedIn == 1) { header("location:list.php"); exit; } else { header("location:logout.php"); exit; }// redirect to logout to delete their cookie
	if ($loggedIn) { include_once 'app.php'; }
} // end of if lffkey cookie is set

if (!$loggedIn) {	


$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
								if (empty($_POST['passcode'])){
																$error = "Passcode is not valid. Sorry.";
															  }
								else { $passcode=strtoupper($_POST['passcode']); $passcode=preg_replace( '/[\W]/', '', $passcode);}
}

if ($passcodeEnable) {
		$passcode = stripslashes($passcode);
		$passCodes = getPasscodesExpiry();
		foreach($passCodes as $pass) {
			if ($pass->passcodevalue == $passcode) {
				if ($pass->passcodeexpires > $timeDate) {
										setcookie("lffkey", $passcode, time()+ $maxCookieAge); // set the user's cookie so they stay logged in
										setcookie("lffID",uniqid(), time() + $maxCookieAge); // set a unique ID in a cookie
										header("location: ".$baseURL); exit; // redirect em to the main page
										$loggedIn=1;
										break;
				} else { $expired=1; break; }
							
			}	
		}
		if ($expired==1) { header("location:expired.php"); exit;}
		if (!$loggedIn && $passcode) {$error="That passcode was incorrect."; logWrongPasscode($passcode);}
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<!-- Favicon -->
<?php include_once('favicons.php'); ?>
<title>Leeds First Friday</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="css/mainstyle.css" rel="stylesheet">
</head>

	<body role="document">
		<div class="container" role="main">
			<div class="vcenter">
				<div class="loginlogo"><img src="images/lff_logo_2023.png" class="loginlogoimg"></div>
				<div class="account-wall">
					<form class="form-signin" action="index.php" method="post">
						<p class="logintext">Enter passcode</p>
						<input type="text" name="passcode" class="form-control" placeholder="PASSCODE" required autofocus>
						<button class="loginbtn" name="submit" type="submit">Continue</button>
					</form>
				</div>
				<div class="loginexplain">
					If you do not have a valid passcode please contact our admins via Facebook, Instagram or Discord.
				</div>
			</div>
		</div> <!-- /container -->
		<div id="errorModal" class="modal-body" style="display:none; position:fixed; top: 35vh; left:10vw; width:80vw; height:30vh; background:white; border:5px solid red; border-radius:15px; text-align:center;">
			<div class="loginbtn">Oh Dear</div>
			<p class="logintext"><?php echo $error; ?></p>
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->

		<?php if ($error != '') { ?>
		<!-- Fire error modal -->
		<script>
			document.getElementById('errorModal').style.display="block";
			setTimeout(function() {
									document.getElementById('errorModal').style.display="none";
								  },2000);
		
		</script>
	<?php } ?>
	
	

	</body>
</html>
<?php } ?>