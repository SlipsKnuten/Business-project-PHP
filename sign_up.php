<!DOCTYPE html>
<html>
<head>
	<script src="script.js"></script>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

<h1 id="titel">Registrering</h1>

<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga in</a></li>
</ul>
</header>
<div id="wrapper">
<br><br><br><br>
<center>
	<form method="post" action="">
			<h1>Välj användaruppgifter</h1><br>
		<div class="container">
		<label><b>Skriv in din mail</b></label><br>
		<p>Du kan bara registrera ett konto till en mailadress.<p>
		<input class="input1" type="text" placeholder="Skriv in e-mail" name="usrMail" required>
		<br><br>
		<label><b>Välj lösenord</b></label><br>
		<p>Lösenordet måste innehålla ett icke-alfanumeriska tecken<br> (specialtecken) (t.ex.!, $, #, %) och en siffra</p>
		<input class="input1" type="password" placeholder="Välj Lösenord" name="usrPw" id="pass1" required>
		<br><br>

	<div class="clearfix">
      <button type="submit" class="input" >Registrera</button>
    </div>
  </div>
</form></center>
<?php	
include("connection.php");
session_start();

if(isset($_POST['usrMail'],$_POST['usrPw'])){
	$mail = mysqli_real_escape_string($dbc,$_POST['usrMail']);
	$password = mysqli_real_escape_string($dbc,$_POST['usrPw']);
	
	
	$sql = "SELECT usrMail FROM users WHERE usrMail = '$mail'";
	$result = mysqli_query($dbc,$sql);
	$count = mysqli_num_rows($result);
	// print_r($_POST);
	// var_dump($password);
	$lel = strlen($password);

	// if(preg_match('/[A-Z]/', $password)){
 
	// Echo "hej";
	// }
	 
	if($count == 0) {
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$error2 = "Invalid mail adress";
			// echo "<script type='text/javascript'>alert('$error2');</script>";	
		}
	else{
		if($lel >= 8){
			if(preg_match('/[A-Z]/', $password)){
				if (preg_match('/[\'^£$%&*()}{@#~?><>,!|=_+¬-åäöÄÅÖ]/', $password)){
					// one or more of the 'special characters' found in $string
					$_SESSION['login_user'] = $mail;
					$options = [
						'cost' => 11,
					];
					$hashed = password_hash($password, PASSWORD_BCRYPT, $options);
					$_SESSION['hashed_pw'] = $hashed;
					// var_dump($_SESSION['hashed_pw']);
					$sql2 = "INSERT INTO users(usrMail, usrPw) values('$mail','$hashed')";
					$result = mysqli_query($dbc,$sql2);
					// var_dump($result);
					header("location: login.php");
				}
				else{
					 echo "<script type='text/javascript'>alert('Ditt lösenord uppfyller inte lösenordskraven');</script>";	
				}
			}
			else{
				 echo "<script type='text/javascript'>alert('Ditt lösenord uppfyller inte lösenordskraven');</script>";
			}		}
		else{
				 echo "<script type='text/javascript'>alert('Ditt lösenord uppfyller inte lösenordskraven');</script>";	
		}	
	}

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