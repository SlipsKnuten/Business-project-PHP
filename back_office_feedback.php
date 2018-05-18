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
	<li class="navliback"><a class="navcontentback" href="back_office_nyalopp.php">Nya lopp</a></li>
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
<h1 id="header"> Feedback</h1>
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
		echo '<select required id="dropdown" name="feed_drop_lop">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj lopp här</option>';
		foreach($dbc->query( 'SELECT * FROM feedback_lop group by lopp') as $row){
			echo '<option value="'.$row['lopp'].'">';
				echo $row['lopp'] . ' - ' . $row['namn'] . ' - ' . $row['distans'];
			echo '</option>';
		}
		foreach ($dbc->query ('SELECT * FROM feedback_skidor group by lopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['lopp']. " - " .$row['namn']." - " .$row['distans'];
			echo '</option>';
		}
		foreach ($dbc->query ('SELECT * FROM feedback_mtb group by lopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['lopp']. " - " .$row['namn']." - " .$row['distans'];
			echo '</option>';
		}
		echo "</select>"; #dropdownmenyn i php	
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		
		echo "</form>";
		
		echo "<center><form method=post>";
		echo '<select id="dropdown" name="feed_drop_fraga_1">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj svars alternativ på fråga 1</option>';
		echo '<option value="Mycket missnöjd">Mycket missnöjd</option>';
		echo '<option value="Missnöjd">Missnöjd</option>';
		echo '<option value="Nöjd">Nöjd</option>';
		echo '<option value="Mycket nöjd">Mycket nöjd</option>';
		echo '</select>';
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		
		echo "</form>";
		
		echo "<center><form method=post>";
		echo '<select id="dropdown" name="feed_drop_fraga_2">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj svars alternativ på fråga 1</option>';
		echo '<option value="Mycket missnöjd">Mycket missnöjd</option>';
		echo '<option value="Missnöjd">Missnöjd</option>';
		echo '<option value="Nöjd">Nöjd</option>';
		echo '<option value="Mycket nöjd">Mycket nöjd</option>';
		echo '</select>';
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";
		
		echo "<center><form method=post>";
		echo '<select id="dropdown" name="feed_drop_fraga_3">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj svars alternativ på fråga 1</option>';
		echo '<option value="Mycket missnöjd">Mycket missnöjd</option>';
		echo '<option value="Missnöjd">Missnöjd</option>';
		echo '<option value="Nöjd">Nöjd</option>';
		echo '<option value="Mycket nöjd">Mycket nöjd</option>';
		echo '</select>';
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		echo "</form>";
		
		echo "<center><form method=post>";
		echo '<select id="dropdown" name="feed_drop_fraga_4">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj svars alternativ på fråga 1</option>';
		echo '<option value="Mycket missnöjd">Mycket missnöjd</option>';
		echo '<option value="Missnöjd">Missnöjd</option>';
		echo '<option value="Nöjd">Nöjd</option>';
		echo '<option value="Mycket nöjd">Mycket nöjd</option>';
		echo '</select>';
		
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		
		echo "</form>";

		
		if(isset($_POST['feed_drop_lop'])){		
			$feedback_lop = $_POST['feed_drop_lop'];
			
			
			$sql = "SELECT COUNT(lopp) FROM feedback WHERE lopp='$feedback_lop'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4> Antal individer som gett denna feedback angpående detta lopp är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Feedbacknummer</th>";
					echo "<th class='tabellrad'>Lopp</th>";
					echo "<th class='tabellrad'>fråga 1</th>";
					echo "<th class='tabellrad'>fråga 2</th>";
					echo "<th class='tabellrad'>fråga 3</th>";
					echo "<th class='tabellrad'>fråga 4</th>";
					echo "<th class='tabellrad'>Kommentar</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * from feedback where lopp = '$feedback_lop'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['feedbacknr']."</td>";
					echo "<td class='tabellinfo'>".$row['lopp']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_1']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_2']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_3']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_4']."</td>";
					echo "<td class='tabellinfo'>".$row['kommentar']."</td>";
				echo "</tr>";
				}
			echo "</table>";
			}
			
			if(isset($_POST['feed_drop_fraga_1'])){		
			$feedback_lop = $_POST['feed_drop_fraga_1'];
			
			$sql = "SELECT COUNT(fraga_1) FROM feedback WHERE fraga_1='$feedback_lop'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4> Antal individer som gett denna feedback på fråga 1 är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Feedbacknummer</th>";
					echo "<th class='tabellrad'>Lopp</th>";
					echo "<th class='tabellrad'>fråga 1</th>";
					echo "<th class='tabellrad'>fråga 2</th>";
					echo "<th class='tabellrad'>fråga 3</th>";
					echo "<th class='tabellrad'>fråga 4</th>";
					echo "<th class='tabellrad'>Kommentar</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * from feedback where fraga_1 = '$feedback_lop'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['feedbacknr']."</td>";
					echo "<td class='tabellinfo'>".$row['lopp']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_1']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_2']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_3']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_4']."</td>";
					echo "<td class='tabellinfo'>".$row['kommentar']."</td>";
				echo "</tr>";
				}
			echo "</table>";
			}
			
			if(isset($_POST['feed_drop_fraga_2'])){		
			$feedback_lop = $_POST['feed_drop_fraga_2'];
			
			$sql = "SELECT COUNT(fraga_2) FROM feedback WHERE fraga_2='$feedback_lop'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4> Antal individer som gett denna feedback på fråga 2 är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Feedbacknummer</th>";
					echo "<th class='tabellrad'>Lopp</th>";
					echo "<th class='tabellrad'>fråga 1</th>";
					echo "<th class='tabellrad'>fråga 2</th>";
					echo "<th class='tabellrad'>fråga 3</th>";
					echo "<th class='tabellrad'>fråga 4</th>";
					echo "<th class='tabellrad'>Kommentar</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * from feedback where fraga_2 = '$feedback_lop'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['feedbacknr']."</td>";
					echo "<td class='tabellinfo'>".$row['lopp']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_1']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_2']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_3']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_4']."</td>";
					echo "<td class='tabellinfo'>".$row['kommentar']."</td>";
				echo "</tr>";
				}
			echo "</table>";
			}
			
			if(isset($_POST['feed_drop_fraga_3'])){		
			$feedback_lop = $_POST['feed_drop_fraga_3'];
			
			$sql = "SELECT COUNT(fraga_3) FROM feedback WHERE fraga_3='$feedback_lop'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4> Antal individer som gett denna feedback på fråga 3 är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Feedbacknummer</th>";
					echo "<th class='tabellrad'>Lopp</th>";
					echo "<th class='tabellrad'>fråga 1</th>";
					echo "<th class='tabellrad'>fråga 2</th>";
					echo "<th class='tabellrad'>fråga 3</th>";
					echo "<th class='tabellrad'>fråga 4</th>";
					echo "<th class='tabellrad'>Kommentar</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * from feedback where fraga_3 = '$feedback_lop'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['feedbacknr']."</td>";
					echo "<td class='tabellinfo'>".$row['lopp']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_1']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_2']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_3']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_4']."</td>";
					echo "<td class='tabellinfo'>".$row['kommentar']."</td>";
				echo "</tr>";
				}
			echo "</table>";
			}
			
			if(isset($_POST['feed_drop_fraga_4'])){		
			$feedback_lop = $_POST['feed_drop_fraga_4'];
			
			$sql = "SELECT COUNT(fraga_4) FROM feedback WHERE fraga_4='$feedback_lop'";
			$result = mysqli_query($dbc, $sql);
			$convert = mysqli_fetch_array($result);
			$count_feedback = $convert['0'];
			echo "<br>";
			echo "<h4> Antal individer som gett denna feedback på fråga 4 är: ".$count_feedback." stycken.</h4>";
			echo "<br>";
			echo "<table class='tabell'>";
				echo "<tr>";
					echo "<th class='tabellrad'>Feedbacknummer</th>";
					echo "<th class='tabellrad'>Lopp</th>";
					echo "<th class='tabellrad'>fråga 1</th>";
					echo "<th class='tabellrad'>fråga 2</th>";
					echo "<th class='tabellrad'>fråga 3</th>";
					echo "<th class='tabellrad'>fråga 4</th>";
					echo "<th class='tabellrad'>Kommentar</th>";
				echo "</tr>";

			foreach ($dbc->query("SELECT * from feedback where fraga_4 = '$feedback_lop'") as $row) {
				echo "<tr>";
					echo "<td class='tabellinfo'>".$row['feedbacknr']."</td>";
					echo "<td class='tabellinfo'>".$row['lopp']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_1']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_2']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_3']."</td>";
					echo "<td class='tabellinfo'>".$row['fraga_4']."</td>";
					echo "<td class='tabellinfo'>".$row['kommentar']."</td>";
				echo "</tr>";
				}
			echo "</table>";
			}
			
			
			
			
			
			
?>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>

</html>