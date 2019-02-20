<!DOCTYPE html>
<html lang="en">
<head>
	<title>SMS Sender</title>
	<meta charset="UTF-8">
	<meta name="description" content="Arcade - Architecture Template">
	<meta name="keywords" content="arcade, architecture, onepage, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.png" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}
</style>

<body>
	<!-- Page Preloder -->
	<center><div id="preloder">
	
		<div class="col-lg-3 col-md-6 pt100">
						<div class="circle-progress">
							<div id="progress1" class="prog-circle"></div>
						</div>
					</div>
	</div></center>


	<!-- Intro section start -->
	<section class="intro-section pt50 pb50">
		<div style="background-color:#D5DBDB;padding:20px;border:2px solid #2E4053" class="container">
			<div class="row">
				<div class="col-lg-7 intro-text mb-5 mb-lg-0">
					<h2 class="sp-title">SMS<span>Sender</span></h2>
					<form method="POST" action="index.php">
					Sender Name <font color="red">*</font><br>
					<input  class="form-control" type="text" name="sender" required></input><br>
					Recipient's Phone Number <font color="red">*</font><br>
					<input  class="form-control" type="number" name="phone" required></input><br>
					Message <font color="red">*</font><br>
					<textarea  style="margin-bottom:10px;resize: none" class="form-control" rows="5" cols="60" type="text" name="message" required></textarea>
					<input style="cursor:pointer;" type="submit" value="Send" name="btn_send" class="site-btn sb-solid-dark"></input>
					</form>
	
	<?php
	// Authorisation details.
	if(isset($_POST['btn_send'])){
	$username = "m.amanullahkhan@yahoo.com";
	$hash = "f0bf6251d938af11ecc4a0185d7d0566c81f781526091fa4e4068780464621da";
	$pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

	// Config variables. Consult http://api.txtlocal.com/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = $_POST['sender']; // This is who the message appears to be from.
	$numbers = $_POST['phone']; // A single number or a comma-seperated list of numbers
	$message = $_POST['message'];
	$match = preg_match($pattern,$numbers);
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.txtlocal.com/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	
	if($match == false)
	{
		$message = "Sorry, the number is not Valid!";
	}
	elseif($result == curl_exec($ch) && $match != false)
	{
		$message = "Message Sent!";
	}
	else {
		$message = "Sorry, the message is not Delivered!";
	}
	curl_close($ch);
	echo "<div id='result' style='color:#2E4053;margin-top:10px;' class='text-left'>";
	echo "<b>".$message."</b>";
	echo "</div>";
	}
?>

				</div>
				<div class="col-lg-5 pt-4">
					<img src="img/sms.jpg" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->




	<!--====== Javascripts & Jquery ======-->
	<script>
	setTimeout(function() { $("#result").hide(); }, 5000);
	</script>
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/isotope.pkgd.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.owl-filter.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
