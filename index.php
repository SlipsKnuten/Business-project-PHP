<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>
	<title>Home</title>
<title>Home</title>
</head>

<?php
session_start();
	if(isset($_SESSION['logged_in'])){
		$loggedIn = $_SESSION['logged_in'];
	}
?>

<body>
<h1 id="titel">Skidloppet AB</h1>

<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem/Anmälan</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga in</a></li>
	<li class="navli"><a href="index_en.php"><img border="0" alt="English Flag" src="pictures/english.jpg" width="35" height="25"></a></li>
</ul>
</header>



<div id="wrapper" class="col-12-m">

<?php
$_SESSION['tshirt_test'] = '7';
// echo $_SESSION['tshirt_test'];

// print_r($_SESSION['login_user']);
?>
<br>
<div id="textovanfor">
<p>Klicka på någon av bilderna för att välja typ av lopp</p>
</div>
	<ul class="pics">
		<li class="pic">
			<a href="booking_lopning.php">
				<div class="cards">
				<div class="centered">Löpning</div>
					<img src="pictures/lopning.jpeg" alt="Trolltunga Norway" class="imgfp"><h3>Löpning</h3>
				</div>	
			</a>
		</li>
		
		<li class="pic">
			<a href="booking_mtb.php">
				<div class="cards">
				<div class="centered">MTB</div>
					<img src="pictures/mtb.jpg" alt="Forest" class="imgfp"><h3>Mountainbike</h3>
				</div>
			</a>
		</li>
		
		<li class="pic">
			<a href="booking_skidor.php">
				<div class="cards">
				<div class="centered">Skidor</div>
					<img src="pictures/skidor.jpeg" alt="Northern Lights" class="imgfp"><h3>Skidåkning</h3>
				</div>
			</a>
		</li>
	</ul>
	
<center><table id="loppformstart"><br><br>

<br><h4>Information om kommande skidlopp</h4><br>
  <tr>
    <th>Loppnamn --- Typ --- Pris</th>
    <th> Starttid</th>
  </tr>

  <tr>
    <td>Dalloppet --- Öppet spår --- 500kr / €50</td>
    <td>2018-01-07 08:00:00</td>
  </tr>
  <tr>
    <td>Dalloppet  Halv  250kr / €25</td>
    <td>2018-01-08 08:00:00</td>
  </tr>
  <tr>
    <td>Dalloppet  Tredjedel  125kr/ €12,5</td>
    <td>2018-01-08 08:00:00</td>
  </tr>
  <tr>
    <td>Stafetten  Full  1000kr / €100</td>
    <td>2018-01-08 08:00:00</td>
  </tr>
  <tr>
    <td>Faluloppet  Full  500kr / €50</td>
    <td>2018-12-14 08:00:00</td>
  </tr>
  </table>
  </center>
  
<center><table id="loppformstart"><br>

<h4>Information om kommande MTBlopp</h4><br>
  <tr>
    <th>Loppnamn --- Typ --- Pris</th>
    <th> Starttid</th>
  </tr>

  <tr>
    <td>Dalloppet  Kvart  100kr / €10</td>
    <td>2018-07-07 08:00:00</td>
  </tr>
  <tr>
    <td>Dalloppet  Halv  200kr / €20</td>
    <td>2018-07-07 08:00:00</td>
  </tr>
  <tr>
    <td>Dalloppet  Full  400kr / €40</td>
    <td>2018-07-08 08:00:00</td>
  </tr>
    <tr>
    <td>Stafetten  Full  400kr / €40</td>
    <td>2018-07-08 08:00:00</td>
  </tr>
  <tr>
    <td>Halloppet  Full  400kr / €40</td>
    <td>2018-12-14 08:00:00</td>
  </tr>
  </table>
  </center>
  
  	<center><table id="loppformstart"><br>

<h4>Information om kommande löplopp</h4><br>
  <tr>
    <th>Loppnamn --- Typ --- Pris</th>
    <th> Starttid</th>
  </tr>

  <tr>
    <td>Dalloppet  Full  400kr / €40</td>
    <td>2018-05-07 08:00:00</td>
  </tr>
  <tr>
    <td>Dalloppet  Halv  200kr / €20</td>
    <td>2018-05-07 08:00:00</td>
  </tr>
  <tr>
    <td>Dalloppet  Kvart  100kr / €10</td>
    <td>2018-05-08 08:00:00</td>
  </tr>
  <tr>
    <td>Stafetten  Full  400kr / €40</td>
    <td>2018-05-08 08:00:00</td>
  </tr>
  <tr>
    <td>Kalloppet  Full  400kr / €40</td>
    <td>2018-12-14 08:00:00</td>
  </tr>
  </table>
  </center>
  
	<div id="map">
		<img src="pictures/karta.jpg.svg">
	</div>
<h3>Karta över loppet</h3>
</div>

</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>