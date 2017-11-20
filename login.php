<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<<<<<<< HEAD
	<script src="script.js"></script>
</head>
<body>
<ul>
  <li><a href="my_page.php">Mina Sidor</a></li>
  <li><a href="index.php">Bokningar</a></li>
  <li><a href="about_us.php">Om oss</a></li>
  <li><a href="sign_up.php">Registrera</a></li>
  <li><a href="login.php">Logga in</a></li>
</ul>
=======
	
</head>
<body>

>>>>>>> 62183ce3ebc2644cadc11a1b8c3b256c7efb29e3
<h1 id="header" align="center">Login</h1>

<form method="post" action="">
  <div class="container">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="usrMail" required>
	
	<label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="usrPw" required>
     
	<div class="clearfix">
      <button type="submit" class="signupbtn">Login</button>
    </div>
  </div>
</form>

<?php
<<<<<<< HEAD
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
	// header("location: my_page.php");
	$_SESSION['logged_in'] = true;
	$test = $_SESSION['logged_in'];
	$js_out = json_encode($test);
	// var_dump($js_out);
	$_SESSION['login_user'] = $mail;
	$users = "SELECT * FROM users WHERE usrMail = '$mail'";
	$result = mysqli_query($dbc,$users);	
	// var_dump($result);
	$test = mysqli_fetch_array($result);	
	// echo "<pre>";var_dump($test);
	// echo "</pre>";
	$_SESSION['userInfo'] = $test;
	$users = $_SESSION['userInfo'];
	echo "<pre>";
	var_dump($users);
	echo "</pre>";
	}
	
	else{
		echo "<script type='text/javascript'>alert('Invalid password')</script>";
=======
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
			$test = $_SESSION['logged_in'];
			$js_out = json_encode($test);
			// var_dump($js_out);
			$_SESSION['login_user'] = $mail;
			$users = "SELECT * FROM users WHERE usrMail = '$mail'";
			$result = mysqli_query($dbc,$users);	
			// var_dump($result);
			$test = mysqli_fetch_array($result);	
			// echo "<pre>";var_dump($test);
			// echo "</pre>";
			$_SESSION['userInfo'] = $test;
			$users = $_SESSION['userInfo'];
			// var_dump($users);
			}
		else{
			echo "Invalid password";
		}
>>>>>>> 62183ce3ebc2644cadc11a1b8c3b256c7efb29e3
	}
}
?>
</body>
</html>