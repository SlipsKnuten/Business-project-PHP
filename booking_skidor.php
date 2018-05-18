<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Löpning</title>
</head>
<body>

<h1 id="titel">Skidlopp</h1>

<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem/anmälan</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina Sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga in</a></li>
</ul>
</header>
<?php
session_start();
include("connection.php");
if(isset($_SESSION['login_user'])){
	$loggedUsr = $_SESSION['login_user'];
	
$sql = "SELECT * FROM users WHERE usrMail = '$loggedUsr'";
$result = mysqli_query($dbc, $sql);
$convert = mysqli_fetch_array($result);
$mail = $_SESSION['login_user'];
$kundnr = $convert['0'];
$loggedIn = $_SESSION['logged_in'];
}
// print_r($_SESSION['login_user']);
// print_r($_SESSION['convert']);
// echo $kundnr;
		
	echo "<div id='wrapper'>";
		
		echo "<div id='tillval'>";
			
			echo "<div id='column'>";
				
			echo "<br><h1 id='våraLopp'>Våra Skidlopp</h1><br>";
			echo "<p><b>Välj ett lopp i listan nedanför</b></p>";
			echo "<center><form method='POST' id='bookingForm'>";
				echo "<table id='loppform'>";
					echo "<tr>";
						echo "<th class='tabellrad1'>Namn</th>";
						echo "<th class='tabellrad1'>Starttid</th>";
						echo "<th class='tabellrad1'>Distans</th>";
						echo "<th class='tabellrad1'>Föreningskrav</th>";
						echo "<th class='tabellrad1'>Pris (SEK)</th>";
						echo "<th>Välj</th><br>";
							foreach($dbc->query("SELECT * FROM skidlopp") as $row){
								echo "<tr>";	
									echo "<td class='tabellinfo1'>".$row['namn']."</td>";
									echo "<td class='tabellinfo1'>".$row['starttid']."</td>";
									echo "<td class='tabellinfo1'>".$row['distans']."</td>";
									echo "<td class='tabellinfo1'>".$row['klubbkrav']."</td>";
									echo "<td class='tabellinfo1'>".$row['pris']."</td>";
									echo "<td><input class='knapp1' name='ordnr' value='".$row['ordningsnr']."' type='radio'></td>";
								echo "</tr>";	
							}
					echo "</tr>";
				echo "</table>";
		echo "</div>"; //loppDiv
							
		if(isset($convert)){
			echo "<div id='column'>";
			echo "<br><h2 id='updInfo'>Fyll i dina uppgifter nedan</h2><br>";
				echo "Förnamn <br><input type='text' name='fornamn' class='input1' value='".$convert['3']."'><br>";
				echo "Efternamn <br><input type='text' name='efternamn' class='input1' value='".$convert['4']."'><br>";
				echo "Kön <br><input type='text' name='kon' class='input1' value='".$convert['6']."'><br>";
				echo "Ålder <br><input type='text' class='input1' name='alder' value='".$convert['7']."'><br>";
				echo "Mobilnummer <br><input type='text' class='input1' name='mobilnr' value='".$convert['5']."'><br>";
		echo "<input class='input' value='Boka' type='submit'>";
		echo "</div>";
		echo "</form></center>";
		}		
		echo "<form method='post'>";
			echo "<form method=post>";
					echo "<label id = 'test'>";							
						echo "<input class='knapp1' type='hidden' name='angra' value='1' checked>";
					echo "</label>";

					echo "<center><button class='input' input type='submit'>Ångra</button>";

				echo "</form>";
				
	echo "</div>"; //wrapper	
		
		if(isset($_POST['fornamn'])){
			$fornamn = $_POST['fornamn'];
			$efternamn = $_POST['efternamn'];
			$kon = $_POST['kon'];
			$alder = $_POST['alder'];
			$mobilnr = $_POST['mobilnr'];
			$sql = "UPDATE users SET kon ='$kon', alder = '$alder', fornamn = '$fornamn', efternamn = '$efternamn', mobilnr = '$mobilnr' WHERE usrMail = '$mail'";
			$result = mysqli_query($dbc,$sql);
			// var_dump($result);
		}


		if(isset($_POST['ordnr'])){
			$ordnr = $_POST['ordnr'];
			// echo $ordnr;
			if(isset($_SESSION['choosenLopp'])){
				$choosenLopp = $_SESSION['choosenLopp'];
			}
			$check = "SELECT * FROM loppanmalan_skidor WHERE kundnr = '$kundnr' AND ordningsnr = '$ordnr'";
			$result = mysqli_query($dbc,$check);
			$count = mysqli_num_rows($result);
			// var_dump($choosenLopp);
			
			if($count == 0){
				echo "hej";
				echo $kundnr;
				echo $ordnr;
				$sth = $dbc->prepare("CALL skidorseedning('$kundnr','$ordnr');");
					$sth->execute();
				
				if($loggedIn == true){
					header("location: tillval_skidor.php");
					$ordnr = $_POST['ordnr'];
					$_SESSION['choosenLopp'] = $ordnr;
				}
				else{
					echo "<script type='text/javascript'>alert('You are not logged in')</script>";
				}
			}
			else{
				echo "<script type='text/javascript'>alert('You have already entered the competition')</script>";
			}				
		}
		
		if(isset($_POST['angra'])){
	
		$sql = "DELETE FROM loppanmalan_lop WHERE startnr = '$startnr'";
		$result = mysqli_query($dbc,$sql);
		echo "<script type='text/javascript'>  window.location='index.php'; </script>";
}
?> 
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>el: 0500 - 666 66
</footer>
</html>