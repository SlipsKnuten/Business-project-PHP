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
<h1 id="header"> Alla lopp</h1><br>

<center><form method='POST'>
<h3>Lägg till nya lopp</h3>
<br>
<select id="dropdown" name = "val">
	<option value="1">Skidlopp</option>
	<option value="2">MTBlopp</option>
	<option value="3">Löplopp</option>
</select><br><br>

	<label>Ordningsnummer</label><br>
	<input class="input1"type="text" name="ordningsnr" placeholder="tex. s1" /><br>
	<label>Namn</label><br>
	<input class="input1"type="text" name="namn" placeholder="tex. Dalloppet" /><br>
	<label>Distans</label><br>
	<input class="input1" type="text" name="distans" placeholder="tex. Halv" /><br>
	<label>Starttid</label><br>
	<input class="input1"type="text" name="starttid" placeholder="2017-11-07 08:00:00 AM" /><br>
	<label>Klubbkrav</label> <br>
	<input class="input1"type="text" name="klubbkrav" placeholder="Ja/Nej" /><br>
	<label>Pris</label> <br>
	<input class="input1"type="text" name="pris" placeholder="SEK" /><br>
	
	<input type="submit" class="input" name="nytt_lopp" value="Lägg till" /> <br>
	<input type="reset" class="input" value="Ångra"/>
  
</form>
</center>
<?php



session_start ();
include ("connection.php");
$pdo = new PDO('mysql:dbname=skidloppet_AB1;host=localhost;charset=utf8', 'sqllab', 'Tomten2009');
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
					$usr = $_SESSION['logged_in'];
	if($usr != true){
		echo "<script type='text/javascript'>alert('Du måste vara inloggad')</script>";
		echo "<script type='text/javascript'>window.location='back_office_login.php';</script>";
	}
if (isset($_POST['val'])) {
	
if($_POST['val'] == '1'){
	$querystring='INSERT INTO skidlopp(ordningsnr, namn, distans, starttid, klubbkrav, pris) VALUES(:ordningsnr, :namn, :distans, :starttid, :klubbkrav, :pris);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':ordningsnr', $_POST['ordningsnr']);
        $stmt->bindParam(':namn', $_POST['namn']);
		$stmt->bindParam(':distans', $_POST['distans']);
        $stmt->bindParam(':starttid', $_POST['starttid']);
        $stmt->bindParam(':klubbkrav', $_POST['klubbkrav']);
		$stmt->bindParam(':pris', $_POST['pris']);
		
		 try{ 
            $stmt->execute();                  
        }catch (PDOException $e){
            if($e->getCode()=="23000"){
                echo "Namn måste vara unikt";
            }else{
                echo $e->getMessage();
            }
        }
	}

else if ($_POST['val'] == '2'){
	$querystring='INSERT INTO mtblopp(ordningsnr, namn, distans, starttid, klubbkrav, pris) VALUES(:ordningsnr, :namn, :distans, :starttid, :klubbkrav, :pris);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':ordningsnr', $_POST['ordningsnr']);
        $stmt->bindParam(':namn', $_POST['namn']);
		$stmt->bindParam(':distans', $_POST['distans']);
        $stmt->bindParam(':starttid', $_POST['starttid']);
        $stmt->bindParam(':klubbkrav', $_POST['klubbkrav']);
        $stmt->bindParam(':pris', $_POST['pris']);
		
		 try{ 
            $stmt->execute();                  
        }catch (PDOException $e){
            if($e->getCode()=="23000"){
                echo "Namn måste vara unikt";
            }else{
                echo $e->getMessage();
            }
        }
	}


else{ 
	$querystring='INSERT INTO loplopp(ordningsnr, namn, distans, starttid, klubbkrav, pris) VALUES(:ordningsnr, :namn, :distans, :starttid, :klubbkrav, :pris);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':ordningsnr', $_POST['ordningsnr']);
        $stmt->bindParam(':namn', $_POST['namn']);
		$stmt->bindParam(':distans', $_POST['distans']);
        $stmt->bindParam(':starttid', $_POST['starttid']);
        $stmt->bindParam(':klubbkrav', $_POST['klubbkrav']);
        $stmt->bindParam(':pris', $_POST['pris']);
		
		 try{ 
            $stmt->execute();                  
        }catch (PDOException $e){
            if($e->getCode()=="23000"){
                echo "Namn måste vara unikt";
            }else{
                echo $e->getMessage();
            }
        }
	}
}

?>
<br>
<h3>Nuvarande lopp</h3><br>
<?php
// session_start ();
// include ("connection.php");

echo "<form method='POST'>";
	

echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Ordningsnummer: </th>";
echo "<th class='tabellrad'>Namn: </th>";
echo "<th class='tabellrad'>Distans: </th>";
echo "<th class='tabellrad'>Starttid: </th>";
echo "<th class='tabellrad'>Klubbkrav: </th>";
echo "<th class='tabellrad'>Pris: </th>";
echo "<th class='tabellrad'>Ta bort: </th>";

foreach ($dbc->query("SELECT * from joint_lopp") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['ordningsnr']."</td>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['distans']."</td>";
			echo "<td class='tabellinfo'>".$row['starttid']."</td>";
			echo "<td class='tabellinfo'>".$row['klubbkrav']."</td>";
			echo "<td class='tabellinfo'>".$row['pris']."</td>";
			echo  "<td class='tabellinfo'><button type='submit' value='".$row['ordningsnr']."' name='deletelopp' >Ta bort</button></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";
echo"<br>";
echo "</form>";


if (isset($_POST['deletelopp'])) {
			$del = $_POST['deletelopp'];
	
                $sql  = "DELETE FROM skidlopp WHERE ordningsnr='$del'";
				$result = mysqli_query($dbc,$sql);
				
				$sql  = "DELETE FROM loplopp WHERE ordningsnr='$del'";
				$result = mysqli_query($dbc,$sql);
				
				$sql  = "DELETE FROM mtblopp WHERE ordningsnr='$del'";
				$result = mysqli_query($dbc,$sql);
				
				echo"<script type='text/javascript'>window.location='back_office_nyalopp.php';</script>";
		//ovanstående kodrad uppdaterar direkt vid borttagning/tillägg
				}
	

?>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>
