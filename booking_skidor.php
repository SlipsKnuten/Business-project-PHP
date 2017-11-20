<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Skidor</title>
</head>
<body>

<ul>
  <li><a href="my_page.php">Mina Sidor</a></li>
  <li><a href="index.php">Bokningar</a></li>
  <li><a href="about_us.php">Om oss</a></li>
  <li><a href="sign_up.php">Registrera</a></li>
  <li><a href="login.php">Logga in</a></li>
</ul>
<h1 class="statictext" id="header" onclick="home()">Skidor</h1>
<div class="tab_bokningar">
<h3> Nedan kan du se en lista på våra Skidlopp  <h3>

<?php
session_start();
include("connection.php");
echo "<form method='POST'>" ;
echo "<ul>";

foreach($dbc->query("SELECT * FROM skidlopp")as $row) {
	echo "<li name='ordnr'>".$row['namn']. " - " .$row['distans']."</li><input type='radio' name='ordnr' value=".$row['ordningsnr']."><br>";
}
echo "</ul>";
// print_r($_POST);

$loginuser = $_SESSION['userInfo'];
echo "<pre>";
var_dump($loginuser);
echo "</pre>";
	echo "Förnamn <input type='text' name='fornamn' class='statictext' value='".$loginuser['3']."'><br>";
	echo "Efternamn <input type='text' name='efternamn' class='statictext' value='".$loginuser['4']."'><br>";
	echo "Kön <input type='text' name='kon' class='statictext' value='".$loginuser['0']."'><br>";
	echo "Ålder <input type='text' class='statictext' name='alder' value='".$loginuser['1']."'><br>";
	echo "Mail <input type='text' class='statictext' name='mail' value='".$loginuser['2']."'><br>";
	echo "<input type='submit' >";
echo "</form>";
	
if(isset($_POST['ordnr'])){
	header("location: tillval.php");
	$ordnr = $_POST['ordnr'];
	$_SESSION['choosenLopp'] = $ordnr;
}

$usrMail = $loginuser['2']
$kundnr = "SELECT kundnr FROM users WHERE usrMail  = '$usrMail'";
$kundNr = mysqli_query($dbc,$kundnr);
$test2 = mysqli_fetch_array($kundNr);	
$mail = $test2['0'];

if(isset($_POST['ordnr'])){
	$sql = "INSERT INTO loppanmalan (kundnr, ordningsnr) VALUES ('$mail', '$ordnr')";
	$x = mysqli_query($dbc,$sql);
	// var_dump($x);
}
?> 
</ul>

<h1 class="statictext" id="header">Skidor</h1>
<div class="tab_bokningar">



<h3> Nedan kan du se en lista på våra Skidlopp  <h3>

<?php
 session_start();
 include("connection.php");
	echo "<form method='POST'>" ;
	echo "<ul>";
	 
	foreach($dbc->query("SELECT * FROM skidlopp")as $row) {
		 echo "<li name='ordnr'>".$row['namn']. " - " .$row['distans']."</li><input type='radio' name='ordnr' value=".$row['ordningsnr']."><br>";
		}
	echo "</ul>";
	// print_r($_POST);

	
	
$loginuser = $_SESSION['userInfo'];
// echo "<pre>";
// var_dump($loginuser);
// echo "</pre>";

		Echo "Förnamn <input type='text' name='fornamn' class='statictext' value='".$loginuser['3']."'><br>";
		echo "Efternamn <input type='text' name='efternamn' class='statictext' value='".$loginuser['4']."'><br>";
		echo "Kön <input type='text' name='kon' class='statictext' value='".$loginuser['0']."'><br>";
		echo "Ålder <input type='text' class='statictext' name='alder' value='".$loginuser['1']."'><br>";
		echo "Mail <input type='text' class='statictext' name='mail' value='".$loginuser['2']."'><br>";
			echo "<input type='submit' >";
	
	echo "</form>";
	
	if(isset($_POST['ordnr'])){
	header("location: tillval.php");
	$ordnr = $_POST['ordnr'];
	$_SESSION['choosenLopp'] = $ordnr;
	}
	$usrMail = $loginuser['2'];
	
	$kundnr = "SELECT kundnr FROM users WHERE usrMail  = '$usrMail'";
	$kundNr = mysqli_query($dbc,$kundnr);
	$test2 = mysqli_fetch_array($kundNr);	
	$mail = $test2['0'];
	if(isset($_POST['ordnr'])){
	$sql = "INSERT INTO loppanmalan (kundnr, ordningsnr) VALUES ('$mail', '$ordnr')";
	$x = mysqli_query($dbc,$sql);
	// var_dump($x);
	}
	
	
	?> 
</div> 
</body>
</html>
