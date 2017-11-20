<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<script src="script.js"></script>



<?php
	include("connection.php");
	session_start();
	if(isset($_POST['usrName'])){
		$mail = $_POST['usrName'];
		$fornamn = $_POST['fornamn'];
		$efternamn = $_POST['efternamn'];
		$mobilnr = $_POST['mobilnr'];
		$kon =$_POST['kon'];
		$alder =$_POST['alder'];
		$oldmail = $_SESSION['login_user'];
		
		
		
		$sql = "UPDATE users SET kon ='$kon', alder = '$alder', usrMail = '$mail', fornamn = '$fornamn', efternamn = '$efternamn', mobilnr = '$mobilnr' WHERE usrMail = '$oldmail'";
		$sql1 = "SELECT kon, alder, usrMail, fornamn, efternamn, mobilnr FROM users WHERE usrMail = '$oldmail'";
		
		$result = mysqli_query($dbc,$sql);	
		$result1 = mysqli_query($dbc,$sql1);	
			$test = mysqli_fetch_array($result1);	
			// var_dump($test);
		$_SESSION['userInfo'] = $test;
		// var_dump($userInfo);
		$_SESSION['login_user'] = $mail; 
	}	
?>
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 300px;
	margin-top:100px;
	margin-left:130px;
	margin-bottom:1000px;
	padding-bottom:700px;
}

/* Style the buttons inside the tab */
div.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
	
	font-family: 'Raleway', sans-serif;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current "tab button" class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 50%;
    border-left: none;
    height: 300px;
	margin-top:100px;
	margin-bottom:1000px;
	padding-bottom:700px;
	color:#414051;
	font-family: 'Raleway', sans-serif;
	background-color:#fff;
	opacity:0.9;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
display: none; 
-webkit-appearance: none;
margin: 0; 
}
#update{
	margin-top:15px;
	padding:5px;
}
.statictext{
	color:#be8ea6;
}
input{
	color:#8e8ebe;
}
</style>
</head>
<body>
<ul>
  <li><a href="my_page.php">Mina Sidor</a></li>
  <li><a href="index.php">Bokningar</a></li>
  <li><a href="about_us.php">Om oss</a></li>
  <li><a href="sign_up.php">Registrera</a></li>
  <li><a href="login.php">Logga in</a></li>
</ul>
<h1 class="statictext" id="header">Dina sidor</h1>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Mina_sidor')" id="defaultOpen">Mina sidor</button>
  <button class="tablinks" onclick="openCity(event, 'Mina_köp')">Mina köp</button>
  <button class="tablinks" onclick="openCity(event, 'Min_statistik')">Min statistik</button>
</div>

<div id="Mina_sidor" class="tabcontent">
  <h3 class='statictext' onload= "home()" onclick="home()">Mina sidor</h3>
  <?php
	if(isset($_SESSION['logged_in'])){
		$usr = $_SESSION['login_user'];
		
		if(isset($_SESSION['hashed_pw'])){
			$pw = $_SESSION['hashed_pw'];
		}
	
		// var_dump($pw);
	echo "<form method='post' action='my_page.php'>";
	// echo "<script type='text/javascript'>alert('$msg');</script>";
	foreach($dbc->query( "SELECT * FROM users WHERE usrMail = '$usr'") as $row){
		echo "Mail: <input type='text' name='usrName' class='statictext' value='".$row['usrMail']."'><br>";
		echo "Förnamn <input type='text' name='fornamn' class='statictext' value='".$row['fornamn']."'><br>";
		echo "Efternamn <input type='text' name='efternamn' class='statictext' value='".$row['efternamn']."'><br>";
		echo "Kön <input type='text' name='kon' class='statictext' value='".$row['kon']."'><br>";
		echo "Ålder <input type='text' class='statictext' name='alder' value='".$row['alder']."'><br>";
		echo "Mobilnummer <input type='text' class='statictext' name='mobilnr' onkeypress='validate(event)' value='".$row['mobilnr']."'><br>"; /*Går inte att läsa av 0:or pga integer i databasen*/
	}
	echo "<input type='submit' value='Uppdatera' id='update'>";
	echo "</form>";
	}
  ?>
</div>

<div id="Mina_köp" class="tabcontent">
  <h3>Mina köp</h3>
  <p>Här kommer köp</p> 
</div>

<div id="Min_statistik" class="tabcontent">
  <h3>Min statistik</h3>
  <p>Här kommer köp</p>
</div>

<div id="Min_statistik" class="tabcontent">
  <h3>Min statistik</h3>
  <p>Här kommer köp</p>
</div>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html> 