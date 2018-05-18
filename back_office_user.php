<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
<title>Backoffice</title>
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
<h1 id="header"> Användare</h1>
<div id="wrapper_backoffice">

<?php
session_start ();
include ("connection.php");
				$usr = $_SESSION['logged_in'];
	if($usr != true){
		echo "<script type='text/javascript'>alert('Du måste vara inloggad')</script>";
		echo "<script type='text/javascript'>window.location='back_office_login.php';</script>";
	}


echo "<table border='1' align='center'>";
echo "<tr>";
echo "<th>Kundnummer</th>";
echo "<th>E-mail</th>";
echo "<th>Fornamn</th>";
echo "<th>Efternamn</th>";
echo "<th>Kön</th>";
echo "<th>Ålder</th>";

foreach ($dbc->query("SELECT * from users") as $row) {
		echo "<tr>";
		echo "<td>".$row['kundnr']."</td>";
		echo "<td>".$row['usrMail']."</td>";
		echo "<td>".$row['fornamn']."</td>";
		echo "<td>".$row['efternamn']."</td>";
		echo "<td>".$row['kon']."</td>";
		echo "<td>".$row['alder']."</td>";

		echo "</tr>";
}
echo "</tr>";
echo "</table>";



?>
</div>
</body>

</html>
l>
