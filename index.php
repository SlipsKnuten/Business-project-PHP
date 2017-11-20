<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>
	<title>Home page</title>
</head>

<?php
session_start();
	if(isset($_SESSION['logged_in'])){
		$fruit = $_SESSION['logged_in'];
	}
		if(isset($_SESSION['logged_in'])){
		$test = $_SESSION['logged_in'];
	}
?>

<script type="text/javascript">
    function Check(typ){
	// alert(typ);
	if(<?= $fruit; ?> == 1 && typ == "lop"){
		window.location = "http://wwwlab.iit.his.se/a16henme/webb_utv/booking_lopning.php";
			// alert("You are logged in!");
		}
	else if(<?= $fruit; ?> == 1 && typ == "mtb"){
		window.location = "http://wwwlab.iit.his.se/a16henme/webb_utv/booking_mtb.php";
	}
	else if(<?= $fruit; ?> == 1 && typ == "skid"){
		window.location = "http://wwwlab.iit.his.se/a16henme/webb_utv/booking_skidor.php";
	}
	else{
			alert("You are not logged in!");
		}
	}
</script>




<style>


	
</style>

<body>

<ul>
  <li><a href="my_page.php">Mina Sidor</a></li>
  <li><a href="index.php">Bokningar</a></li>
  <li><a href="about_us.php">Om oss</a></li>
  <li><a href="sign_up.php">Registrera</a></li>
  <li><a href="login.php">Logga in</a></li>
</ul>


<h1 id="header">Våra lopp</h1>

<div id="wrapper">
	<ul class="pics">
		<li class="pic">
		<a onclick="Check('lop')">
			<img src="pictures/lopning.jpeg" alt="Trolltunga Norway" class="imgfp">
		</a>
			<p class="desc">Klicka här för våra löplopp</p>
		</li>

		<li class="pic">
		<a href="booking_mtb.php" onclick="Check('mtb')">
			<img src="pictures/mtb.jpg" alt="Forest" class="imgfp">
		</a>
			<p class="desc">Klicka här för våra moutainbikelopp</p>
		</li>

		<li class="pic">
		<a onclick="Check('skid')">
			<img src="pictures/skidor.jpeg" alt="Northern Lights" class="imgfp">
		</a>
			<p class="desc">klicka för våra skidlopp</p>
		</li>
	</ul>
</div>
</body>

</html>
