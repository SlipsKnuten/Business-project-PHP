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
		
		$sql = "SELECT * FROM users WHERE usrMail = '$mail' and usrPw = '$password'";
		
		$result = mysqli_query($dbc,$sql);
		
		$count = mysqli_num_rows($result);
		 
		if($count == 0) {
			$_SESSION['login_user'] = $mail;
			
			$sql2 = "INSERT INTO users(usrMail, usrPw) values('$mail','$password')";
			$result = mysqli_query($dbc,$sql2);
			header("location: login.php");
			
			// $file = fopen("users.csv","u");
			
			// foreach ($mail as $line and $password as $line2)
			// {
				// fputcsv($file,explode(',',$line,$line2));
			// }
			// fclose($file);
			// echo "<pre>'$file'</pre>";
			
		} else {
			$error = "Your Login Name or Password is invalid";
			echo "<script type='text/javascript'>alert('$error');</script>";	
		}
	}

 
?>
</body>
</html>