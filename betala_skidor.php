<!DOCTYPE HTML>
<html>
<head>
	<meta charset=UTF-8>
	<script src="script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$("#cardBtn").click(function(){
			$("#card").show();
			$("#swish").hide();
		});
	});
	
	$(document).ready(function(){
		$("#swishBtn").click(function(){
			$("#swish").show();
			$("#card").hide();
		});
	});

	</script>
	
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Skidor</title>
</head>
<body>
<div id="modal">
<h1 id="titel">Betala</h1>
<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem/Anmälan</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina Sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga in</a></li>
</ul>
</header>	
<div id="wrapper">
	
<?php
Session_start();
Include("connection.php");      

$loginuser = $_SESSION['userInfo'];
$mail = $loginuser[4];
$sql = "SELECT fornamn, efternamn FROM users WHERE usrMail = '$mail'";
$result = mysqli_query($dbc,$sql);
$convert = mysqli_fetch_array($result);

$tshirt_test=$_SESSION['tshirt_test'];

if($tshirt_test==1){
	$_SESSION['Tshirt']="";
}
$valla = $_SESSION['Valla'];
$langning = $_SESSION['Langning'];
$bussbiljett = $_SESSION['Bussbiljett'];
$forsakring = $_SESSION['Forsakring'];
$diplom = $_SESSION['Diplom'];
$tshirt = $_SESSION['Tshirt'];


$sql = "SELECT * FROM artiklar_valla WHERE id = '$valla'";
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_fetch_array($result);
$valla1 = $result1[1];
$vallaPris = $result1[2];

$sql = "SELECT * FROM artiklar_langning WHERE id = '$langning'";
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_fetch_array($result);
$langning1 = $result1[1];
$langningPris = $result1[2];

// var_dump($result);

$sql = "SELECT * FROM artiklar_biljett WHERE id = '$bussbiljett'";
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_fetch_array($result);
$bussbiljett1 = $result1[1];
$bussbiljettPris = $result1[2];

//var_dump($bussbiljett1);

$sql = "SELECT * FROM artiklar_forsakring WHERE id = '$forsakring'";
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_fetch_array($result);
$forsakring1 = $result1[1];
// print_r($result1);
$forsakringPris = $result1[2];

//var_dump($forsakring1);

$sql = "SELECT * FROM artiklar_diplom WHERE id = '$diplom'";
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_fetch_array($result);
$diplom1 = $result1[1];
$diplomPris = $result1[2];
// print_r($result1);

$sql = "SELECT * FROM artiklar_tshirt WHERE id = '$tshirt'";
$result = mysqli_query($dbc,$sql);
$result1 = mysqli_fetch_array($result);
$tshirt1 = $result1[1];
$tshirtPris = $result1[2];
//var_dump($diplom1);

$lopp = $_SESSION['choosenLopp'];
$sql = "SELECT * FROM joint_lopp WHERE ordningsnr = '$lopp'";
$result = mysqli_query($dbc,$sql);
$array = mysqli_fetch_array($result);
// print_r($array);	
$ordningsnr = $array['1'];   
$namn = $array['1'];   
$pris = $array['6'];   

$lopp = $_SESSION['choosenLopp'];
$sql = "SELECT * FROM joint_lopp WHERE ordningsnr = '$lopp'";
$result = mysqli_query($dbc,$sql);
$array = mysqli_fetch_array($result);	
$ordningsnr = $array['1'];                     

$summering = $_SESSION['sum'];
$startnr = $_SESSION['startnr'];
//var_dump($loginuser);
//var_dump($summering);

echo "<br><br><h2>Här är en sammanställning av de produkter du har valt</h2><br><br>";
echo "<center><table class='betalaTable'>";
	echo "<tr>";
		echo "<th>Produkt</th>";
		echo "<th>Pris</th>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>".$namn." - ".$array['2']."</td>";
		echo "<td> ".$pris." kr</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>".$valla1."</td>";
		echo "<td>".$vallaPris." kr</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>".$langning1."</td>";
		echo "<td>".$langningPris." kr</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>".$forsakring1."</td>";
		echo "<td>".$forsakringPris." kr</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>".$bussbiljett1."</td>";
		echo "<td>".$bussbiljettPris." kr</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>".$tshirt1."</td>";
		echo "<td>".$tshirtPris." kr</td>";
	echo "</tr>";
echo "</table></center>";
echo "<br><br><h2>Summa: ".$_SESSION['sum'].":-</h2>";
$sum = $_SESSION['sum'];

// echo $sum;
Echo "<br><br><h3>Vänligen välj betalningsmetod nedan</h3>";
$_SESSION['thshirt_test'] = '0';
?>

<script>
function sum(){
	var sum = '<?php echo $sum; ?>';
	alert("Du har precis blivit debiterad " + sum + " kronor");
	
}
</script>
<center>
<div class="payment">
<button class="tablinks" id="cardBtn">Kort</button>
<button class="tablinks" id="swishBtn">Swish</button>
<form id="card" action="index.php">
	<br>
	<input class="inputCard" placeholder="Kortnummer" type="text"><br>
	<br>
	<input class="inputCard" placeholder="Utgångsdatum" type="text"><br>
	<br>
	<input class="inputCard" placeholder="CVC" type="text"><br><br>
	<button type="submit" class="payBtn" onclick="sum()">Betala</button>
</form>
<form id="swish" action="index.php">
	<br><input class="inputCard" placeholder="Mobilnummer"type="text"><br>
	<br><button type="submit" class="payBtn" onclick="sum()">Betala</button>
</form>
</div>
</center>
<?php
echo "<br><br><br><br>";
echo "<br><br>";
echo "<form method=post>";
echo "<center><label id = 'test'>";							
echo "<input class='knapp1' type='hidden' name='angra' checked>";
echo "</label>";
echo "<button id='angraknapp' class='previous' type='submit'>&laquo; Föregående</button>";
echo "</form>";
 
if(isset($_POST['angra'])){
	$sql = "DELETE FROM tillval_skidor WHERE startnr = '$startnr'";
	$result = mysqli_query($dbc,$sql);
	echo "<script type='text/javascript'>  window.location='tillval_skidor.php'; </script>";	 
}
?>
</div>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>
<html>