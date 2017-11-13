<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src = "/assets/js/frappe-web.min.js"></script>
	<script type="text/javascript" src = "/assets/js/erpnext-web.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
<h1 align="center" class="header">Sign up</h1>
<form method="post" action="">
  <div class="container">
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="usrMail" required>
	
	<label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="usrPw" required>

    <input type="checkbox" checked="checked"> Remember me
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
     
	<div class="clearfix">
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<?php	
	include("connection.php");
	session_start();

	
	if(isset($_POST['usrMail'],$_POST['usrPw'])){
		$mail = mysqli_real_escape_string($dbc,$_POST['usrMail']);
		$password = mysqli_real_escape_string($dbc,$_POST['usrPw']);
		
		// $options = [
			// 'cost' => 11,
			// 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		// ];
		// $password1 = password_hash($password, PASSWORD_BCRYPT, $options);
		// echo $password1;
		
		// echo password_hash($password, PASSWORD_DEFAULT);
		// $password1 = password_hash($password, PASSWORD_DEFAULT);
		// echo $password1;
		
		// $_SESSION['hash'] = $password1;
		
		
		
		$sql = "SELECT * FROM users WHERE usrMail = '$mail'";
		$result = mysqli_query($dbc,$sql);
		$count = mysqli_num_rows($result);
		
		 
		if($count == 0) {
			$msg = "Kör hit";
			
			$_SESSION['login_user'] = $mail;
			$options = [
			'cost' => 11,
			];
			$hashed = password_hash($password, PASSWORD_BCRYPT, $options);
			$_SESSION['hashed_pw'] = $hashed;
			var_dump($_SESSION['hashed_pw']);
			$sql2 = "INSERT INTO users(usrMail, usrPw) values('$mail','$hashed')";
			$result = mysqli_query($dbc,$sql2);
			var_dump($result);
			header("location: login.php");
			
		} else {
			$error = "Your Login Name or Password is invalid";
			echo "<script type='text/javascript'>alert('$error');</script>";	
		}
	}

 
?>
</body>
</html>