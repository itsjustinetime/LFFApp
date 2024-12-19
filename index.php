<?php
include_once 'configuration.php';
include_once 'functions/functions.php';
//include_once 'logging.php';
//session_start();

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
	if ($loggedIn == 1) { header("location:list.php"); exit; } else { header("location:logout.php"); exit; }// redirect to logout to delete their cookie
} // end of if lffkey cookie is set
	
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
					<form class="form-signin" action="login.php" method="post">
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

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->

		<?php if ($error != '') { ?>
		<!-- Fire error modal -->
		<script>
			document.getElementById('errorModal').style.display="block";
        	document.getElementById('modalclosebtn').addEventListener("click", (function(){
			setTimeout(function() {
									document.getElementById('errorModal').style.display="none";
								  },500);
			}));
		</script>
	<?php } ?>
	
	

	</body>
</html>
