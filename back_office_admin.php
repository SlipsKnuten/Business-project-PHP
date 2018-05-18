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
	<li class="navliback"><a class="navcontentback" href="back_office_admin.php">Admin</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_feedback.php">Feedback</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_logout.php">Logga ut </a></li>
</ul>
</header>



<div id="wrapper_backoffice" class="col-12-m">
<br>
<h1 id="header"> Lägg till användarkonto</h1>
<br><br>

<center><form method='POST'>
<div id="inloggadmin">
	<label>Välj användarnamn</label><br>
	<input class="input1" type="text" name="adminName" placeholder="tex. AL" /><br><br>
	<label>Välj lösenord</label><br>
	<input class="input1" type="text" name="adminPW" placeholder="tex. ABC123" /><br>
	<input type="submit" class="input" name="admin" value="Lägg till" />
	</div>
  </form>
</center>




<?php

session_start ();
include ("connection.php");


$pdo = new PDO('mysql:dbname=skidloppet_AB1;host=localhost;charset=utf8', 'sqllab', 'Tomten2009');
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$usr = $_SESSION['logged_in'];
	if($usr != true){
		echo "<script type='text/javascript'>alert('Du måste vara inloggad')</script>";
		echo "<script type='text/javascript'>window.location='back_office_login.php';</script>";
	}
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

		// var_dump($_SESSION['hashed_pw']);
		$sql2 = "INSERT INTO admin(adminName, adminPW) values('$name','$hashed')";
		$result = mysqli_query($dbc,$sql2);
		// var_dump($result);
}	
}
?>

<br>
<h1 id="header">Ta bort användarkonto</h1><br><br>
<?php
echo "<form method='POST'>";
	

echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Namn: </th>";


echo "<th class='tabellrad'>Ta bort: </th>";
foreach ($dbc->query("SELECT * from admin") as $row) {
		echo "<tr>";
			echo"<td class='tabellinfo'>".$row['adminName']."</td>";
			echo  "<td class='tabellinfo'><input type='submit' value='".$row['adminName']."' name='deleteadmin'/></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";

echo "</form>";



if (isset($_POST['deleteadmin'])) {
	$del=$_POST['deleteadmin']; 
	echo "<br>";
	
 //echo "Administratör ".$del." är nu borttagen";
                $sql  = "DELETE FROM admin WHERE adminName='$del'";
				$result = mysqli_query($dbc,$sql);
				echo"<script type='text/javascript'>window.location='back_office_admin.php';</script>";
				//echo $result;
	}

?>
<br><br>


</div>
</body>
<footer>  
<br><br>
Skidloppet AB Box 312 77076 Hedemora || info@skidloppetab.com || 0500-66666	
 </footer>
</html>
ml>
