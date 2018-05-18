<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>
	<title>Home</title>
<title>Home</title>
</head>
<body>
<h1 id="titel">Skidloppet AB</h1>

<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem/anmälan</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina Sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga in</a></li>
</ul>
</header>


<div id="wrapper" class="col-12-m">
<br>
	<h1 id="header" align="center">Återställ Lösenord</h1>
	<br>
	<form action="resetPwmockup.php">
	  <center><div class="container">
	
		
		<input id="inputmail" type="text" class="input1" placeholder="Skriv in e-mail" name="usrMail" required>
		
		<!--<label><b>Confirm e-mail</b></label>
		<input type="password" placeholder="Re-enter mail" name="usrMail" required>-->
		 
		<br><div class="clearfix">
		<br>
		<button onclick="testfunc()" type="submit" class="input">Återställ Lösenord</button>
		</div>
		
	  </div></center>
	</form>

<?php	
// require_once("Exception.php");
// require_once("PHPMailer.php");


// $included_files = get_included_files();

// foreach ($included_files as $filename) {
    // echo "$filename\n";
// }
// print_r($_POST);
session_start();
include("connection.php");
if(isset($_POST['usrMail'])){
	$mail = $_POST['usrMail'];
	
	// echo $mail;
	$sql = "SELECT usrPw FROM users WHERE usrMail='$mail'";
	
	$result = mysqli_query($dbc, $sql);
	// var_dump($result);
	$array = mysqli_fetch_array($result);
	// var_dump($array);
	$password = $array['usrPw'];
	$count = mysqli_num_rows($result);
	 // var_dump($count);
	
	if($count == 1){
		// echo "hej";
		// header("location: index.php");
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		  // echo "Invalid email format"; 
		}
		else{
			// echo "Valid email";
		}
		
		
		$to      = $mail; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject 
		$message = '

		Thanks for signing up!
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

		------------------------
		Username: '.$mail.'
		Password: '.$password.'
		------------------------

		Please click this link to activate your account:
		http://wwwwlab.iit.his.se/a15gusbe/Grupp5/resetPw.php'.$mail.'&hash='.$password.'

		'; // Our message above including the link
				 
		$headers = 'From:noreply@grupp5.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email
		
		if(@mail($to, $subject, $message, $headers))
		{
			echo "Mail Sent Successfully";
		}else{
			echo "Mail Not Sent";
		}

	}
	else{
		// echo "nej";
	}
}
?>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>

</html>
