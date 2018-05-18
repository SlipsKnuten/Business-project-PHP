<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>
	<title>Home</title>

</head>


<body><br>
<h1 id="titel">Skidloppet AB Backoffice</h1>
<br><br>
<header>
<ul id="navback">
	<li class="navliback"><a class="navcontentback" href="back_office_login.php">Login</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_nyalopp.php">Nya lopp</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_nyatillval.php">Tillval</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_tillval_skidlopp.php">Skidlopp</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_tillval_loplopp.php">Löplopp</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_tillval_mtb.php">MTB</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_deltagare.php">Loppdeltagare</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_feedback.php">Feedback</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_admin.php">Admin</a></li>
</ul>
</header>

<div id="wrapper" class="col-12-m">
<br><br><br><br><br><br>
<center>
	<h1 align="center" id="header">Registrera Administratör</h1><br><br>
<form method="post" action="">
	<div class="container">
		<label><b>AdminNamn</b></label><br>
		<input type="text" class="backofficeinput" placeholder="Skriv in namn" name="adminName" required>
		<br><br>
		<label><b>Lösenord</b></label><br>
		<input type="password" class="backofficeinput" placeholder="Skriv in lösenord" name="adminPW" required>
		<br><br>
		<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p><br>
			<div class="clearfix">
				<button type="submit" class="signupbtn">Registrera</button>
			</div>
	</div>
</form>
</center>
<?php	
include("connection.php");
session_start();


if(isset($_POST['adminName'],$_POST['adminPW'])){
	$name = mysqli_real_escape_string($dbc,$_POST['adminName']);
	$password = mysqli_real_escape_string($dbc,$_POST['adminPW']);	
	

	
	
	$sql = "SELECT * FROM admin WHERE adminName = '$name'";
	$result = mysqli_query($dbc,$sql);
	$count = mysqli_num_rows($result);
	 
	if($count == 0) {
		// $msg = "Kör hit";
		$_SESSION['login_user'] = $name;
		$options = [
			'cost' => 11,
		];
		$hashed = password_hash($password, PASSWORD_BCRYPT, $options);
		$_SESSION['hashed_pw'] = $hashed;

		 //var_dump($_SESSION['hashed_pw']);
		$sql2 = "INSERT INTO admin(adminName, adminPW) values('$name','$hashed')";
		$result = mysqli_query($dbc,$sql2);
		// var_dump($result);
		 header("location: back_office_login.php");
		
	} else {
		$error = "Your Login Name or Password is invalid";
		echo "<script type='text/javascript'>alert('$error');</script>";	
	}
}
?>
</div>
</body>
<footer>  
Skidloppet AB Box 312 77076 Hedemora || info@skidloppetab.com || 0500-66666		
 </footer>

</html>	
