<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>Bokningar</title>




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

<h1 class="statictext" id="header">Tillval</h1>
<div class="tab_bokningar" id ="wrapper">
<h5>Nedan finns information angående din bokning så här långt</h5>
<?php
Session_start();
Include("connection.php");
$loginuser = $_SESSION['userInfo'];
// $kundNr = $loginuser['0'];
// var_dump($loginuser);
$lopp = $_SESSION['choosenLopp'];
$sql = "SELECT * FROM skidlopp WHERE ordningsnr = '$lopp'";
$result = mysqli_query($dbc,$sql);
$array = mysqli_fetch_array($result);	
$ordningsnr = $array['0'];
$_POST['test'] = $ordningsnr;

$userid = $loginuser['2'];
$kundnr1 = "SELECT kundnr FROM users WHERE usrMail = '$userid'";
$result = mysqli_query($dbc,$kundnr1);
$kundnr = mysqli_fetch_array($result);
$kundNr = $kundnr['0'];

$sql = "SELECT startnr FROM loppanmalan WHERE kundnr = '$kundNr' AND ordningsnr = '$lopp'";
$result = mysqli_query($dbc,$sql);
$startbevis = mysqli_fetch_array($result);
$startnr = $startbevis['0'];

echo "<div id ='summarize'>";
	echo "<ul>";
		echo "<li>".$loginuser['3']."</li><br>";
		echo "<li>".$loginuser['4']."</li><br>";
		echo "<li>".$loginuser['1']."</li><br>";
		echo "<li>".$loginuser['5']."</li><br>";
		echo "<li>".$array['1']." - ".$array['5']."</li>";
	echo "<ul";
echo "</div>";

echo "<div id ='extras'>";
echo "<h5>I nedanstående fält gör du dina tillval till dina lopp</h5>";
	echo "<form method='post'>";

		echo "<ul>";
			echo "<li>Ingen valla</li><input type='radio' name='Valla' value='0' checked='checked' value='0'</input><br>";
			echo "<li>Valla 1</li><input type='radio' name='Valla' value='1'</input><br>";
			echo "<li>Valla 2</li><input type='radio' name='Valla' value='2'</input><br>";
			echo "<li>Valla 3</li><input type='radio' name='Valla' value='3'</input><br>";
			echo "<li>Valla 4</li><input type='radio' name='Valla' value='4'</input><br>";
			echo "<li>Valla 5</li><input type='radio' name='Valla' value='5'</input><br>";
		echo "</ul>";

		echo "<ul>";
			echo "<li>Ingen langning</li><input type='radio' name='Langning' checked='checked' value='0'</input><br>";
			echo "<li>Langning 1</li><input type='radio' name='Langning' value='1'</input><br>";
			echo "<li>Langning 2</li><input type='radio' name='Langning' value='2'</input><br>";
			echo "<li>Langning 3</li><input type='radio' name='Langning' value='3'</input><br>";
			echo "<li>Langning 4</li><input type='radio' name='Langning' value='4'</input><br>";
			echo "<li>Langning 5</li><input type='radio' name='Langning' value='5'</input><br>";
		echo "</ul>";

		echo "<ul>";
			echo "<li>Ingen försäkring</li><input type='radio' name='Forsakring' checked='checked' value='0'</input><br>";
			echo "<li>Försäkring</li><input type='radio' name='Forsakring' value='1'</input><br>";
		echo "</ul>";

		echo "<ul>";
			echo "<li>Ingen bussbiljett</li><input type='radio' name='Bussbiljett' checked='checked' value='0'</input><br>";
			echo "<li>Bussbiljett</li><input type='radio' name='Bussbiljett' value='1'</input><br>";
		echo "</ul>";

		echo "<ul>";
			echo "<li>Inget diplom</li><input type='radio' name='Diplom' value='0' checked='checked'</input><br>";
			echo "<li>Diplom1</li><input type='radio' name='Diplom' value='1'</input><br>";
			echo "<li>Diplom2</li><input type='radio' name='Diplom' value='2'</input><br>";
			echo "<li>Diplom3</li><input type='radio' name='Diplom' value='3'</input><br>";
		echo "</ul>";
	// print_r($_POST);
		echo "<input type='submit' >";
	echo "</form>";
echo "</div>";
// $lel = $_SESSION['userInfo'];
// var_dump($lel);
	if(isset($_POST['Valla'])){
	$valla = $_POST['Valla'];
	$langning = $_POST['Langning'];
	$bussbiljett = $_POST['Bussbiljett'];
	$forsakring = $_POST['Forsakring'];
	$diplom = $_POST['Diplom'];
	$valla = $_POST['Valla'];
	$sql = "INSERT INTO tillval(kundnr, ordningsnr, startnr, diplom, forsakring, bussbiljett, valla, langning) VALUES('$kundNr', '$ordningsnr', '$startnr', '$diplom', '$forsakring', '$bussbiljett', '$valla', '$langning')";
	$result = mysqli_query($dbc,$sql);
	var_dump($result);
	}
	
?>
</body>

</html>
