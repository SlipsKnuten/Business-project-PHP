<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>Bokningar</title>


<?php
include("connection.php");
session_start();

?>

<style>

.test {
		list-style-type: none;
		margin: 0;
		padding: 0;
		}

.test1 {
		display: inline;
		}
		
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border-radius: 50%;
	height:50px;
	width:50px;
	background-image:url(pictures/info.png);
	}



 
	
</style>
</head>
<body>


    

  

<ul class ="test">
  <li class = "test1"><a href="my_page.php">Mina Sidor</a></li>
  <li class = "test1"><a href="index.php">Bokningar</a></li>
  <li class = "test1"><a href="about_us.php">Om oss</a></li>
  <li class = "test1"><a href="sign_up.php">Registrera</a></li>
</ul>

<h1 class="statictext" id="header">Här gör du dina tillval</h1>

<div class="tab_bokningar">

<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Här kommer det komma information om diplom</p>
        
      </div>
    </div>
  </div>
  
  <div id="id02" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Här kommer det komma mer information om försäkringar</p>
        
      </div>
    </div>
  </div>
  
  <div id="id03" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Här kommer det komma mer information om Bussbiljetter</p>
        
      </div>
    </div>
  </div>
  
  <div id="id04" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id04').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Invärmning av LF Flourvalla, sicklas, borstas</p>
        
      </div>
    </div>
  </div>

  <div id="id05" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id05').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Invärmning av HF Flourvalla, sicklas, borstas.</p>
        
      </div>
    </div>
  </div>
  
  <div id="id06" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id06').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Vallning av glid + fäste</p>
		<p>Invärmning av LF Flourvalla, sicklas, borstas.</p>
		<p>Ruggning av fästzon, HF Fästvalla efter behov.</p>
        
      </div>
    </div>
  </div>
  
  <div id="id07" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id07').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Glid med HF valla i 2 lager, sicklas, borstas.</p>
		<p>Samma som ovan fast det bästa som finns på marknaden. I form av pulver/fluid.</p>
		<p>I fästzonen HF valla i flera lager. </p>
		<p>Endast det bästa är gott nog.</p>
        
      </div>
    </div>
  </div>
  
  <div id="id08" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id08').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Här kommer det komma mer information om Bussbiljetter</p>
        
      </div>
    </div>
  </div>

<?php 


$result = $_SESSION['typ'];
$result1 = $_SESSION['namn'];

echo "<h1>Du har bokat dig på: $result1 - $result distans</h1>";


?>
			
			<div class="w3-container"><li>ENDAST GLIDVALLNING LF<button onclick="document.getElementById('id04').style.display='block'" class="button"></button></div></li>
			<div class="w3-container"><li>ENDAST GLIDVALLNING H<button onclick="document.getElementById('id05').style.display='block'" class="button"></button></div></li>
			<div class="w3-container"><li>KOMPLETT VALLNING LF<button onclick="document.getElementById('id06').style.display='block'" class="button"></button></div></li>
			<div class="w3-container"><li>KOMPLETT HÖGFLOURVALLNING<button onclick="document.getElementById('id07').style.display='block'" class="button"></button></div></li>
		<div class="w3-container">	<li>VÄRSTINGVALLA FLOURPULVER<button onclick="document.getElementById('id08').style.display='block'" class="button"></button></div></li>
		</ul>

<form action="booking_skidor.php">




<input type="submit" name="bokning_status" value="bokning"></input>

</form>

<form action="index.php">
<input type="submit" name="bokning_status" value="index"></input>

</div>


</body>

</html>
