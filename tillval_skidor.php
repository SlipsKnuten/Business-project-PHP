<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bokningar</title>
	<script src="script.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<h1 id="titel">Tillval</h1>
<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem/Anmälan</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina Sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga ut</a></li>
</ul>
</header>
<div id ="wrapper">

<?php

Session_start();
Include("connection.php");
$loginuser = $_SESSION['userInfo'];
$oldmail = $loginuser['4']; 

$loginuser = $_SESSION['userInfo'];
$oldmail = $loginuser['4']; 

$sql = "SELECT * FROM users WHERE usrMail = '$oldmail'";
$result = mysqli_query($dbc,$sql);
$convert = mysqli_fetch_array($result);

$lopp = $_SESSION['choosenLopp'];
$sql = "SELECT * FROM joint_lopp WHERE ordningsnr = '$lopp'";
$result = mysqli_query($dbc,$sql);
$array = mysqli_fetch_array($result);
$ordningsnr = $array['0'];
// print_r($array);

$userid = $_SESSION['login_user'];;
$kundnr1 = "SELECT kundnr FROM users WHERE usrMail = '$userid'";
$result = mysqli_query($dbc,$kundnr1);
$kundnr = mysqli_fetch_array($result);
$kundNr = $kundnr['0'];

$sql = "SELECT startnr FROM joint_anmalan WHERE kundnr = '$kundNr' AND ordningsnr = '$lopp'";
$result = mysqli_query($dbc,$sql);
$startbevis = mysqli_fetch_array($result);
$startnr = $startbevis['0'];
// var_dump($startnr);
echo "<br><br><div id='tillvalDiv'>";
	echo "<div id='summarize'>";
		echo "<h2>Här är ditt valda lopp</h2><br>";
		echo "<ul class='tillvalUsr'>";
			echo "<li class='usrInfoTillVal'>Typ av lopp: ".$array['3']." </li><br><br>";
			echo "<li class='usrInfoTillVal'>Loppnummer: ".$array['0']."</li><br><br>"; 
			echo "<li class='usrInfoTillVal'>Startnummer: ".$startnr."</li><br><br>";	
			echo "<li class='usrInfoTillVal'>Starttid: ".$array['2']."</li><br><br>"; 
			echo "<li class='usrInfoTillVal'>Pris: ".$array['6']."</li><br>";
		echo "</ul>";
	echo "</div><br><br>";
	


	echo "<div id ='row'>";
		echo "<form method='post'>";			
			echo "<p>Klicka på bilderna nedan för att lägga till de tillval du vill ha. Alla fält <u><b>måste</b></u> ha ett markerat val.</p>";
			echo "<br>";
			echo "<br>";
				$x = 0;
				echo "<h2><b>Välj ett langningspaket</b></h2><br>";
				
				echo "<center><table id='tillval_lop'>";
				echo "<tr class='tillvalLop1'>";
					foreach($dbc->query("SELECT * FROM artiklar_langning")as $row) {
						$x++;
						$L = 'l' . $x;
					
						echo "<td class='tillvalLop2'>";
						echo "<label id = 'test'>";							
							echo "<input type='radio' name='langning' value=".$row['id'].">";
							echo "<img class='imgs' src='pictures/$L.jpg'>";
						echo "</label>";
						echo "</td>";
						}
					echo "</tr>";
				
					echo "<tr>";
					foreach($dbc->query("SELECT * FROM artiklar_langning")as $row) {
						$x=0;
						$x++;
						$L = 'l' . $x;
						echo "<td><p class='items'>".$row['namn']." - ".$row['varde']." kr</p></td>";
						}
					echo "</tr>";
					$x=0;
					echo "<tr>";
					foreach($dbc->query("SELECT * FROM artiklar_langning")as $row) {
						
						$x++;
						$L = 'l' . $x;
						echo "<td class='beskrivning'><p class='items'><br>".$row['beskrivning']."</p></td>";
						}
					echo "</tr>";
				
				echo "</table>";
				
				echo "<br><br>";
				
				echo "<h2><b>Välj ett diplom</b></h2><br>";
				$x=0;
				echo "<center><table id='tillval_lop'>";
					echo "<tr>";
						foreach($dbc->query("SELECT * FROM artiklar_diplom")as $row) {
							$x++;
							$D = 'd' . $x;
							echo "<td>";
							echo "<label>";
								echo "<input type='radio' name='diplom' value=".$row['id'].">";
								echo "<img class='imgs' src='pictures/$D.jpg'>";
							echo "</label>";
							echo "</td>";
						}
					echo "</tr>";
				
				$x = 0;
				echo "<tr>";
								
				foreach($dbc->query("SELECT * FROM artiklar_diplom")as $row) {
					$x++;
					$D = 'd' . $x;
					echo "<td><p class='items'>".$row['namn']." - ".$row['varde']." kr</p></td>";
				}
				echo"</tr>";
				$x = 0;
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_diplom")as $row) {
					$x++;
					$D = 'd' . $x;
					echo "<td class='beskrivning'><p class='items'><br>".$row['beskrivning']."</p></td>";
				}
				echo"</tr>";
				
				echo "</table>";
						
				echo "<br><br>";
				
				echo "<h2><b>Försäkring</b></h2><br>";
				$x = 0;
				
				echo "<center><table id='tillval_lop'>";
				
				echo "<tr>";
					foreach($dbc->query("SELECT * FROM artiklar_forsakring")as $row) {
						$x++;
						$F = 'f' . $x;
						echo "<td>";
						echo "<label>";
						echo "<input type='radio' name='forsakring' value=".$row['id'].">";
						echo "<img class='imgs' src='pictures/$F.jpg'>";
						echo "</label>";
						echo "</td>";
					}
				echo "</tr>";

				$x = 0;
				echo "<tr>";
					foreach($dbc->query("SELECT * FROM artiklar_forsakring")as $row) {
						$x++;
						$D = 'd' . $x;
						echo "<td><p class='items'>".$row['namn']." - ". $row['varde']." kr</p>";
					}
				echo "</tr>";
				$x = 0;
				echo "<tr>";
					foreach($dbc->query("SELECT * FROM artiklar_forsakring")as $row) {
					$x++;
					$D = 'd' . $x;
					echo "<td class='beskrivning'><p class='items'><br>".$row['beskrivning']."</p></td>";
					}
				echo "</tr>";
				echo "</table>";
				
				echo "<br><br>";
				
								
				echo "<h2><b>Bussbiljett</b></h2><br>";
				$x = 0;
				echo "<center><table id='tillval_lop'>";
				
				echo "<tr>";
				
					foreach($dbc->query("SELECT * FROM artiklar_biljett")as $row) {
						$x++;
						$B = 'b' . $x;
						echo "<td>";
						echo "<label>";
							echo "<input type='radio' name='bussb' value=".$row['id'].">";
							echo "<img class='imgs' src='pictures/$B.jpg'>";
						echo "</label>";
						echo "</td>";
				}
				echo "</tr>";
				
				$x = 0;
				
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_biljett")as $row) {
					$x++;
					$B = 'b' . $x;
					echo "<td><p class='items'>".$row['namn']." - ".$row['varde']." kr</p></td>";
				}
				echo "</tr>";
				
				$x = 0;
				
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_biljett")as $row) {
					$x++;
					$B = 'b' . $x;
					echo "<td class='beskrivning'><p class='items'><br>".$row['beskrivning']."</p></td>";
				}
				echo "</tr>";
				echo "</table>";
								
				echo "<br><br>";
				
				
				
				echo "<h2><b>Välj ett vallapaket</b></h2><br>";
				$x = 0;
				
				echo "<center><table id='tillval_lop'>";
				
				echo "<tr>";
				
				foreach($dbc->query("SELECT * FROM artiklar_valla")as $row) {
					$x++;
					$V = 'v' . $x;
					echo "<td>";
					echo "<label>";
						
						echo "<input type='radio' name='valla' value=".$row['id']." '>";
						echo "<img class='imgs' src='pictures/$V.jpg'>";
					echo "</label>";
					echo "</td>";					
				}
				
				$x = 0;
				
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_valla")as $row) {
					$x++;
					$B = 'b' . $x;
					echo "<td><p class='items'>".$row['namn']." - ".$row['varde']." kr</p></td>";
				}
				echo "</tr>";
				
				$x = 0;
				
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_valla")as $row) {
					$x++;
					$B = 'b' . $x;
					echo "<td class='beskrivning'><p class='items'><br>".$row['beskrivning'],"</p></td>";
				}
				echo "</tr>";
				echo "</table>";
				echo "<br><br>";
				
				echo "<h2><b>T-shirts</b></h2><br>";
				$x = 0;
				echo "<center><table id='tillval_lop'>";
				
				echo "<tr>";
				
					foreach($dbc->query("SELECT * FROM artiklar_tshirt")as $row) {
						$x++;
						$T = 't' . $x;
						echo "<td>";
						echo "<label>";
							echo "<input type='radio' name='tshirt' value=".$row['id'].">";
							echo "<img class='imgs' src='pictures/$T.jpg'>";
						echo "</label>";
						echo "</td>";
				}
				echo "</tr>";
				
				$x = 0;
				
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_tshirt")as $row) {
					$x++;
					$t = 't' . $x;
					echo "<td><p class='items'>".$row['namn']." - ".$row['varde']." kr</p></td>";
				}
				echo "</tr>";
				
				$x = 0;
				
				echo "<tr>";
				foreach($dbc->query("SELECT * FROM artiklar_tshirt")as $row) {
					$x++;
					$T = 't' . $x;
					echo "<td class='beskrivning'><p class='items'><br>".$row['beskrivning']."</p></td>";
				}
				echo "</tr>";
				echo "</table>";
				
				echo "</div>"; //row
				echo "<br><br><br>";

				echo "<form method='post'>";	
			echo "<button id='valjknapp' class='next' type='submit' >Nästa  &raquo;</button>";
		echo "</form>";
	
echo "</div>";
// print_r($_POST);
if(isset($_POST['langning'])){

	$langning = $_POST['langning'];
	$bussbiljett = $_POST['bussb'];
	// var_dump($bussbiljett);
	$forsakring = $_POST['forsakring'];
	$diplom = $_POST['diplom'];
	$valla = $_POST['valla'];
	$tshirt = $_POST['tshirt'];

	$sql = "SELECT varde FROM artiklar_valla WHERE id = '$valla'";
	$result = mysqli_query($dbc, $sql);
	$pvalla = mysqli_fetch_array($result);
	
	$sql = "SELECT varde FROM artiklar_biljett WHERE id = '$bussbiljett'";
	$result = mysqli_query($dbc, $sql);
	$pbil = mysqli_fetch_array($result);

	$sql = "SELECT varde FROM artiklar_diplom WHERE id = '$diplom'";
	$result = mysqli_query($dbc, $sql);
	$pdip = mysqli_fetch_array($result);

	$sql = "SELECT varde FROM artiklar_forsakring WHERE id = '$forsakring'";
	$result = mysqli_query($dbc, $sql);
	$pfor = mysqli_fetch_array($result);

	$sql = "SELECT varde FROM artiklar_langning WHERE id = '$langning'";
	$result = mysqli_query($dbc, $sql);
	$plang = mysqli_fetch_array($result);
	
	$sql = "SELECT varde FROM artiklar_tshirt WHERE id = '$tshirt'";
	$result = mysqli_query($dbc, $sql);
	$ptshirt = mysqli_fetch_array($result);
	
	$ordningsnr = $array[0];
	
	$sql = "SELECT pris FROM skidlopp WHERE ordningsnr = '$ordningsnr'";
	$result = mysqli_query($dbc, $sql);
	$plopp = mysqli_fetch_array($result);

	$items = $pbil[0] + $pdip[0] + $pfor[0] + $plang[0] + $pvalla[0] + $plopp[0] + $ptshirt[0];

	$_SESSION['Langning']= $langning;
	$_SESSION['Bussbiljett'] = $bussbiljett;
	$_SESSION['Forsakring'] = $forsakring;
	$_SESSION['Diplom'] = $diplom;
	$_SESSION['Valla'] = $valla;
	$_SESSION['Tshirt'] = $tshirt;
	$_SESSION['sum'] = $items;

	$sql = "INSERT INTO tillval_skidor(kundnr, ordningsnr, startnr, diplom, forsakring, valla, bussbiljett, langning) VALUES('$kundNr', '$lopp', '$startnr', '$diplom', '$forsakring', '$valla', '$bussbiljett', '$langning')";
	$result = mysqli_query($dbc,$sql);
	// var_dump($result);
	$_SESSION['startnr'] = $startnr;
	
	echo "<script type='text/javascript'>  window.location='betala_skidor.php'; </script>";
}


echo "<form method=post>";
echo "<center><label id = 'test'>";							
	echo "<input class='knapp1' type='hidden' name='angra' value='1' checked>";
echo "</label>";

echo "<button id='angraknapp' class='previous' type='submit'>&laquo; Föregående</button>";


echo "</form>";
 

if(isset($_POST['angra'])){
	
	$sql = "DELETE FROM loppanmalan_skidor WHERE startnr = '$startnr'";
	$result = mysqli_query($dbc,$sql);
	echo "<script type='text/javascript'>  window.location='booking_skidor.php'; </script>";
}


?>
</div>
	</center>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>
</html> 0500 - 666 66
</footer>
</html>
</html>