<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<?php
	include("connection.php");
	session_start();
	$msg = "asd";
	if(isset($_POST['usrName'])){
		$mail = $_POST['usrName'];
		$fornamn = $_POST['fornamn'];
		$efternamn = $_POST['efternamn'];
		$mobilnr = $_POST['mobilnr'];
		$oldmail = $_SESSION['login_user'];
		$sql = "UPDATE users SET usrMail = '$mail', fornamn = '$fornamn', efternamn = '$efternamn', mobilnr = '$mobilnr' WHERE usrMail = '$oldmail'";
		// echo "<script type='text/javascript'>alert('$msg');</script>";
		mysqli_query($dbc,$sql);
		$_SESSION['login_user'] = $mail; 
		// var_dump($_SESSION['login_user']);
		
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
	margin-top:300px;
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
	margin-top:300px;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
display: none; 
-webkit-appearance: none;
margin: 0; 
}
</style>
</head>
<body>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Mina_sidor')" id="defaultOpen">Mina sidor</button>
  <button class="tablinks" onclick="openCity(event, 'Mina_köp')">Mina köp</button>
  <button class="tablinks" onclick="openCity(event, 'Min_statistik')">Min statistik</button>
</div>

<div id="Mina_sidor" class="tabcontent">
  <h3>Mina sidor</h3>
  <?php
	
	$usr = $_SESSION['login_user'];
	$pw = $_SESSION['hashed_pw'];
	// var_dump($pw);
	echo "<form method='post' action='my_page.php'>";
	// echo "<script type='text/javascript'>alert('$msg');</script>";
	foreach($dbc->query( "SELECT * FROM users WHERE usrMail = '$usr' and usrPw = '$pw'") as $row){
		echo "Mail: <input type='text' name='usrName'  value='".$row['usrMail']."'><br>";
		// $password = $_POST['usrPw'];
		// var_dump($password);
		// $hashed = password_hash($password, PASSWORD_DEFAULT);
		// $sql = "UPDATE users SET usrPw = '$hashed' WHERE usrPw = '$pw'";
		// mysqli_query($dbc, $sql);
		echo "Förnamn: <input type='text' name='fornamn' value='".$row['fornamn']."'><br>";
		echo "Efternamn: <input type='text' name='efternamn' value='".$row['efternamn']."'><br>";
		echo "Mobilnummer: <input type='number' name='mobilnr' onkeypress='validate(event)' value='".$row['mobilnr']."'><br>"; /*Går inte att läsa av 0:or pga integer i databasen*/
	}
	echo "<input type='submit' value='Skicka'>";
	echo "</form>";
	

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