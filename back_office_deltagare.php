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



<div id="wrapper_backoffice">

<br>
<h1 id="header"> Lista på alla deltagare</h1>
<br>


<?php
session_start ();
include ("connection.php");
			$usr = $_SESSION['logged_in'];
	if($usr != true){
		echo "<script type='text/javascript'>alert('Du måste vara inloggad')</script>";
		echo "<script type='text/javascript'>window.location='back_office_login.php';</script>";
	}
	echo "<center><form method=post>";
	echo '<select required id="dropdown" name="kon">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
	echo '<option value="">Män eller kvinnor?</option>';
	foreach($dbc->query( 'SELECT * FROM users GROUP BY kon') as $row){
		echo '<option value="'.$row['kon'].'">';
			echo $row['kon'];
		echo '</option>';
		}
		echo "</select>"; #dropdownmenyn i php	
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";
		
	echo "<center><form method=post>";
	echo '<select required id="dropdown" name="klubb">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
	echo '<option value="">Vilken klubb?</option>';
	foreach($dbc->query( 'SELECT * FROM users GROUP BY klubb') as $row){
		echo '<option value="'.$row['klubb'].'">';
			echo $row['klubb'];
		echo '</option>';
		}
		echo "</select>"; #dropdownmenyn i php	
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";
		
	echo "<center><form method=post>";
	echo '<select required id="dropdown" name="stad">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
	echo '<option value="">Vilken stad?</option>';
	foreach($dbc->query( 'SELECT * FROM users GROUP BY stad') as $row){
		echo '<option value="'.$row['stad'].'">';
			echo $row['stad'];
		echo '</option>';
		}
		echo "</select>"; #dropdownmenyn i php	
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";
		
	echo "<center><form method=post>";
	echo '<select required id="dropdown" name="land">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
	echo '<option value="">Vilket land?</option>';
		foreach($dbc->query( 'SELECT * FROM users GROUP BY land') as $row){
			echo '<option value="'.$row['land'].'">';
				echo $row['land'];
			echo '</option>';
		}
		echo "</select>"; #dropdownmenyn i php	
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";

	echo "<center><form method=post>";
		echo '<select id="dropdown" name="deltagare_alder">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Vilket åldersintervall är du intresserad av?</option>';
		echo '<option value="1">15-25</option>';
		echo '<option value="2">26-35</option>';
		echo '<option value="3">36-45</option>';
		echo '<option value="4">46-55</option>';
		echo '<option value="5">56-></option>';
		echo '</select>';
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";
		
		
		if(isset($_POST['klubb'])){		
			$klubb = $_POST['klubb'];
			
			$sql = "SELECT COUNT(klubb) FROM users WHERE klubb='$klubb'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_klubb = $convert['0'];
	
			echo "<br>";
			echo "<h4>Antal individer kommer från denna klubb är: ".$count_klubb." stycken.</h4>";
			echo "<br>";
				
			echo "</tabel>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * FROM users WHERE klubb = '$klubb'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
					echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
					echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
					echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
					echo "<td class='tabellinfo'>".$row['kon']."</td>";
					echo "<td class='tabellinfo'>".$row['alder']."</td>";
					echo "<td class='tabellinfo'>".$row['adress']."</td>";
					echo "<td class='tabellinfo'>".$row['stad']."</td>";
					echo "<td class='tabellinfo'>".$row['land']."</td>";
					echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
			}
			echo "</table>";
		}
		
		if(isset($_POST['stad'])){		
			$stad = $_POST['stad'];
			
			$sql = "SELECT COUNT(stad) FROM users WHERE stad='$stad'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4>Antal individer kommer från denna stad är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * FROM users WHERE stad = '$stad'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
					echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
					echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
					echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
					echo "<td class='tabellinfo'>".$row['kon']."</td>";
					echo "<td class='tabellinfo'>".$row['alder']."</td>";
					echo "<td class='tabellinfo'>".$row['adress']."</td>";
					echo "<td class='tabellinfo'>".$row['stad']."</td>";
					echo "<td class='tabellinfo'>".$row['land']."</td>";
					echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
			}
			echo "</table>";
		}
		
		
		if(isset($_POST['kon'])){		
			$kon = $_POST['kon'];
			
			$sql = "SELECT COUNT(kon) FROM users WHERE kon='$kon'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4>Antal individer: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * FROM users WHERE kon = '$kon'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
					echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
					echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
					echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
					echo "<td class='tabellinfo'>".$row['kon']."</td>";
					echo "<td class='tabellinfo'>".$row['alder']."</td>";
					echo "<td class='tabellinfo'>".$row['adress']."</td>";
					echo "<td class='tabellinfo'>".$row['stad']."</td>";
					echo "<td class='tabellinfo'>".$row['land']."</td>";
					echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
			}
			echo "</table>";
		}
		if(isset($_POST['land'])){		
			$land = $_POST['land'];
			
			$sql = "SELECT COUNT(land) FROM users WHERE land='$land'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4>Antal individer kommer från detta land är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * FROM users WHERE land = '$land'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
					echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
					echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
					echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
					echo "<td class='tabellinfo'>".$row['kon']."</td>";
					echo "<td class='tabellinfo'>".$row['alder']."</td>";
					echo "<td class='tabellinfo'>".$row['adress']."</td>";
					echo "<td class='tabellinfo'>".$row['stad']."</td>";
					echo "<td class='tabellinfo'>".$row['land']."</td>";
					echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
			}
			echo "</table>";
		}
			
		if(isset($_POST['deltagare_alder'])){
			$test = $_POST['deltagare_alder'];
			
			
			if($test==1){
				
				$sql = "SELECT COUNT(alder) FROM users WHERE alder >= 15 AND alder <= 25";
				$result = mysqli_query($dbc, $sql);
				$convert = mysqli_fetch_array($result);
				$count_feedback = $convert['0'];
				
				echo "<br>";
				echo "<h4>Antal individer i detta åldersintervall är: ".$count_feedback." stycken.</h4>";
				echo "<br>";
				echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

				foreach ($dbc->query("SELECT * FROM users WHERE alder >= 15 AND alder <= 25") as $row) {
					echo "<tr>";
						echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
						echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
						echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
						echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
						echo "<td class='tabellinfo'>".$row['kon']."</td>";
						echo "<td class='tabellinfo'>".$row['alder']."</td>";
						echo "<td class='tabellinfo'>".$row['adress']."</td>";
						echo "<td class='tabellinfo'>".$row['stad']."</td>";
						echo "<td class='tabellinfo'>".$row['land']."</td>";
						echo "<td class='tabellinfo'>".$row['klubb']."</td>";
						echo "</tr>";
				}
			echo "</table>";
			}
			
			else if($test==2){
				
				$sql = "SELECT COUNT(alder) FROM users WHERE alder >= 26 AND alder <= 35";
				$result = mysqli_query($dbc, $sql);
				$convert = mysqli_fetch_array($result);
				$count_feedback = $convert['0'];
				
				echo "<br>";
				echo "<h4>Antal individer i detta åldersintervall är: ".$count_feedback." stycken.</h4>";
				echo "<br>";
				echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

				foreach ($dbc->query("SELECT * FROM users WHERE alder >= 26 AND alder <= 35") as $row) {
					echo "<tr>";
						echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
						echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
						echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
						echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
						echo "<td class='tabellinfo'>".$row['kon']."</td>";
						echo "<td class='tabellinfo'>".$row['alder']."</td>";
						echo "<td class='tabellinfo'>".$row['adress']."</td>";
						echo "<td class='tabellinfo'>".$row['stad']."</td>";
						echo "<td class='tabellinfo'>".$row['land']."</td>";
						echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
				}
			echo "</table>";
			}
			
			else if($test==3){
				
				$sql = "SELECT COUNT(alder) FROM users WHERE alder >= 36 AND alder <= 45";
				$result = mysqli_query($dbc, $sql);
				$convert = mysqli_fetch_array($result);
				$count_feedback = $convert['0'];
				
				echo "<br>";
				echo "<h4>Antal individer i detta åldersintervall är: ".$count_feedback." stycken.</h4>";
				echo "<br>";
				echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

				foreach ($dbc->query("SELECT * FROM users WHERE alder >= 36 AND alder <= 45") as $row) {
					echo "<tr>";
						echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
						echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
						echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
						echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
						echo "<td class='tabellinfo'>".$row['kon']."</td>";
						echo "<td class='tabellinfo'>".$row['alder']."</td>";
						echo "<td class='tabellinfo'>".$row['adress']."</td>";
						echo "<td class='tabellinfo'>".$row['stad']."</td>";
						echo "<td class='tabellinfo'>".$row['land']."</td>";
						echo "<td class='tabellinfo'>".$row['klubb']."</td>";
						echo "</tr>";
				}
				echo "</table>";
			}
			
			else if($test==4){
				
				$sql = "SELECT COUNT(alder) FROM users WHERE alder >= 46 AND alder <= 55";
				$result = mysqli_query($dbc, $sql);
				$convert = mysqli_fetch_array($result);
				$count_feedback = $convert['0'];
				
				echo "<br>";
				echo "<h4>Antal individer i detta åldersintervall är: ".$count_feedback." stycken.</h4>";
				echo "<br>";
				echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

				foreach ($dbc->query("SELECT * FROM users WHERE alder >= 46 AND alder <= 55") as $row) {
					echo "<tr>";
						echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
						echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
						echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
						echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
						echo "<td class='tabellinfo'>".$row['kon']."</td>";
						echo "<td class='tabellinfo'>".$row['alder']."</td>";
						echo "<td class='tabellinfo'>".$row['adress']."</td>";
						echo "<td class='tabellinfo'>".$row['stad']."</td>";
						echo "<td class='tabellinfo'>".$row['land']."</td>";
						echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			
			else if($test==5){
				
				$sql = "SELECT COUNT(alder) FROM users WHERE alder >= 56";
				$result = mysqli_query($dbc, $sql);
				$convert = mysqli_fetch_array($result);
				$count_feedback = $convert['0'];
				
				echo "<br>";
				echo "<h4>Antal individer i detta åldersintervall är: ".$count_feedback." stycken.</h4>";
				echo "<br>";
				echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Kundnummer</th>";
					echo "<th class='tabellrad'>E-mail</th>";
					echo "<th class='tabellrad'>Fornamn</th>";
					echo "<th class='tabellrad'>Efternamn</th>";
					echo "<th class='tabellrad'>Kön</th>";
					echo "<th class='tabellrad'>Ålder</th>";
					echo "<th class='tabellrad'>Adress</th>";		
					echo "<th class='tabellrad'>Stad</th>";
					echo "<th class='tabellrad'>Land</th>";
					echo "<th class='tabellrad'>Klubb</th>";
				echo "</tr>";

				foreach ($dbc->query("SELECT * FROM users WHERE alder >= 56") as $row) {
					echo "<tr>";
						echo "<td class='tabellinfo'>".$row['kundnr']."</td>";
						echo "<td class='tabellinfo'>".$row['usrMail']."</td>";
						echo "<td class='tabellinfo'>".$row['fornamn']."</td>";
						echo "<td class='tabellinfo'>".$row['efternamn']."</td>";
						echo "<td class='tabellinfo'>".$row['kon']."</td>";
						echo "<td class='tabellinfo'>".$row['alder']."</td>";
						echo "<td class='tabellinfo'>".$row['adress']."</td>";
						echo "<td class='tabellinfo'>".$row['stad']."</td>";
						echo "<td class='tabellinfo'>".$row['land']."</td>";
						echo "<td class='tabellinfo'>".$row['klubb']."</td>";
					echo "</tr>";
				}
				echo "</table>";
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
