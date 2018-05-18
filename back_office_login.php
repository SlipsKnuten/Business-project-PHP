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
	<li class="navliback"><a class="navcontentback" href="back_office_nyalopp.php">Lopp</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_nyatillval.php">Tillval</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_tillval_skidlopp.php">Skidlopp</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_tillval_loplopp.php">Löplopp</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_tillval_mtb.php">MTB</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_deltagare.php">Deltagare</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_logout.php">Feedback</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_admin.php">Admin</a></li>
</ul>
</header>



<div id="wrapper" class="col-12-m">
<br><br><br><br><br><br><br>
<h1 id="header" align="center">Logga in på Backoffice</h1>
<br>
<form method="post" action="">
  <div class="container-back-office-login">
    <label><b>Användarnamn</b></label><br>
    <input class="backofficeinput" type="text" placeholder="Skriv in användarnamn" name="adminName">
	<br>
	<br>
	<label><b>Lösenord</b></label><br>
    <input class="backofficeinput" type="password" placeholder="Skriv in lösenord" name="adminPW">
    
	<div class="clearfix">
	<br>
      <input type="submit" class="input" value="Logga in">
    </div>
	<div class="clearfix">

    </div>
  </div>
</form>


<?php

include("connection.php");
session_start();

	
if(isset($_POST['adminName'], $_POST['adminPW'])){
	$name = mysqli_real_escape_string($dbc,$_POST['adminName']);
	$password = mysqli_real_escape_string($dbc,$_POST['adminPW']);

	$sql = "SELECT * FROM admin WHERE adminName = '$name'";
	$result = mysqli_query($dbc,$sql);	
	$pw = mysqli_fetch_array($result);
	$count = mysqli_num_rows($result);

	$currentpw = $pw['adminPW'];
	
	if(password_verify($password,$currentpw)){
		header("location: back_office_nyalopp.php");
		$_SESSION['logged_in'] = true;
		// var_dump($_SESSION['logged_in']);
		// $test = $_SESSION['logged_in'];
		// print_r($test);
		$_SESSION['login_user'] = $name;
		$users = "SELECT * FROM admin WHERE adminName = '$name'";
		$result = mysqli_query($dbc,$users);	
		// var_dump($result);
		$test = mysqli_fetch_array($result);	
		// echo "<pre>";var_dump($test);
		// echo "</pre>";
		$_SESSION['userInfo'] = $test;
		var_dump($_SESSION['userInfo']);
		$users = $_SESSION['userInfo'];
		// echo "<pre>";
		// var_dump($users);
		// echo "</pre>";
	}
	
	else{
		echo "<script type='text/javascript'>alert('Invalid password')</script>";
		$_SESSION['logged_in'] = false;
		// var_dump($_SESSION['logged_in']);
	}
}
echo "</br>";
?>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>	
>	
