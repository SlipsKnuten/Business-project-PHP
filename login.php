<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
</head>
<body>
<h1 class="header" align="center">Login</h1>
<form method="post" action="#">
  <div class="container">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="usrMail" id="inputs" required>
	
	<label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="usrPw" id="inputs" required>
	<button type="submit" class="signupbtn">Sign Up</button>
<?php
	include("connection.php");
	session_start();

	
	if(isset($_POST['usrMail'], $_POST['usrPw'])){
		$mail = mysqli_real_escape_string($dbc,$_POST['usrMail']);
		$password = mysqli_real_escape_string($dbc,$_POST['usrPw']);
		
		$sql = "SELECT * FROM users WHERE usrMail = '$mail' and usrPw = '$password'";
		$result = mysqli_query($dbc,$sql);
		
		$count = mysqli_num_rows($result);
		 
		if($count == 1) {
			$_SESSION['login_user'] = $mail;
			$_SESSION['password_user'] = $password;
			header("location: my_page.php");
		} else {
			$error = "Your Login Name or Password is invalid";
			echo "<script type='text/javascript'>alert('$error');</script>";	
		}
	}
?>
</body>
</html>