<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script src="script.js"></script>
	<meta charset="UTF-8">
</head>
<body>
<h1 id="titel">Logga in</h1>
<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem/Anmälan</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga in</a></li>
</ul>
</header>
<div id="wrapper" class="col-12-m">
<br><br><br><br><br><br>
<center>
	<form method="post" action="">
		<h1>Skriv in dina användaruppgifter</h1><br>
			<label><b>E-mail</b></label><br>
			<input class="input1" type="text" placeholder="E-mail" name="usrMail" required><br>
			<br><br>
			<label><b>Lösenord</b></label><br>
			<input class="input1" type="password" placeholder="Lösenord" name="usrPw" required><br>
			<br><br>
	<a href="resetPw.php">Glömt ditt lösenord?</a>
     <br><br>
	<div class="clearfix">
      <button type="submit" class="input">Logga in</button>
    
  </div>
</form></center>
</div>
<?php
include("connection.php");
session_start();

if(isset($_POST['usrMail'], $_POST['usrPw'])){
	$mail = mysqli_real_escape_string($dbc,$_POST['usrMail']);
	$password = mysqli_real_escape_string($dbc,$_POST['usrPw']);
	$sql = "SELECT * FROM users WHERE usrMail = '$mail'";
	$result = mysqli_query($dbc,$sql);	
	$result = mysqli_query($dbc,$sql);
	$pw = mysqli_fetch_array($result);	
	$currentpw = $pw['usrPw'];
		if(password_verify($password,$currentpw)){
			header("location: my_page.php");
			$_SESSION['logged_in'] = true;
			var_dump($_SESSION['logged_in']);
			$test = $_SESSION['logged_in'];
			
			// $js_out = json_encode($test);
			$_SESSION['login_user'] = $mail;
			$users = "SELECT fornamn, efternamn, kon, alder, usrMail, mobilnr FROM users WHERE usrMail = '$mail'";
			$result = mysqli_query($dbc,$users);	
			$test = mysqli_fetch_array($result);	
			$_SESSION['userInfo'] = $test;
			$users = $_SESSION['userInfo'];
		}
		else{
			echo "<script type='text/javascript'>alert('Felaktiga inloggningsuppgifter')</script>";
		}
}
?>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>l>