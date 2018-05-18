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
<h1 id="header"> Alla artiklar</h1><br>

<center><form method='POST'>
<h3>Lägg till nya artiklar</h3>
<br>
<select id="dropdown" name = "val">
	<option value="1">Valla</option>
	<option value="2">Langning</option>
	<option value="3">Diplom</option>
	<option value="4">Försäkring</option>
	<option value="5">Bussbiljett</option>
	
	
</select><br><br>

	<label>Namn</label><br>
	<input class="input1"type="text" name="namn" placeholder="Artikelbenämning" /><br>
	<label>Värde</label><br>
	<input class="input1"type="text" name="varde" placeholder="Värde i kronor" /><br>
	<label>Beskrivning</label><br>
	<input class="input1"type="text" name="beskrivning" placeholder="Ange en beskrivning av artikeln" /><br>
	<input type="submit" class="input" name="nytt_lopp" value="Lägg till" />
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
	//print_r ($_POST);
if($_POST['val'] == '1'){
	$querystring='INSERT INTO artiklar_valla(namn, varde, beskrivning) VALUES(:namn, :varde, :beskrivning);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':varde', $_POST['varde']);
		$stmt->bindParam(':beskrivning', $_POST['beskrivning']);
		
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
	$querystring='INSERT INTO artiklar_langning(namn, varde, beskrivning) VALUES(:namn, :varde, :beskrivning);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':varde', $_POST['varde']);
		$stmt->bindParam(':beskrivning', $_POST['beskrivning']);
		
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
	
else if ($_POST['val'] == '3'){
	$querystring='INSERT INTO artiklar_diplom(namn, varde, beskrivning) VALUES(:namn, :varde, :beskrivning);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':varde', $_POST['varde']);
		$stmt->bindParam(':beskrivning', $_POST['beskrivning']);
		
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


else if ($_POST['val'] == '4'){
	$querystring='INSERT INTO artiklar_forsakring(namn, varde, beskrivning) VALUES(:namn, :varde, :beskrivning);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':varde', $_POST['varde']);
		$stmt->bindParam(':beskrivning', $_POST['beskrivning']);
		
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
	
else if ($_POST['val'] == '5'){
	$querystring='INSERT INTO artiklar_bussbiljett(namn, varde, beskrivning) VALUES(:namn, :varde, :beskrivning);';
	$stmt = $pdo->prepare($querystring);
		$stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':varde', $_POST['varde']);
		$stmt->bindParam(':beskrivning', $_POST['beskrivning']);
		
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
<h3>Nuvarande artiklar</h3><br>
<?php
// session_start ();
// include ("connection.php");

echo "<form method='POST'>";
	
echo "<h3>Valla</h3>";
echo "<br>";
echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Ordningsnummer: </th>";
echo "<th class='tabellrad'>Artikelbenämning: </th>";
echo "<th class='tabellrad'>Varde: </th>";
echo "<th class='tabellrad'>Beskrivning: </th>";
echo "<th class='tabellrad'>Ta bort: </th>";

foreach ($dbc->query("SELECT * FROM artiklar_valla") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['id']."</td>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo "<td class='tabellinfo'>".$row['beskrivning']."</td>";
			echo  "<td class='tabellinfo'><button type='submit' value='".$row['id']."' name='deletevalla' >Ta bort</button></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";
echo"<br>";
echo "</form>";


echo "<form method='POST'>";
echo "<h3>Diplom</h3>";
echo "<br>";	

echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Ordningsnummer: </th>";
echo "<th class='tabellrad'>Artikelbenämning: </th>";
echo "<th class='tabellrad'>Varde: </th>";
echo "<th class='tabellrad'>Beskrivning: </th>";
echo "<th class='tabellrad'>Ta bort: </th>";

foreach ($dbc->query("SELECT * FROM artiklar_diplom") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['id']."</td>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo "<td class='tabellinfo'>".$row['beskrivning']."</td>";
			echo  "<td class='tabellinfo'><button type='submit' value='".$row['id']."' name='deletediplom' >Ta bort</button></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";
echo"<br>";
echo "</form>";

echo "<form method='POST'>";
echo "<h3>Langning</h3>";
echo "<br>";		

echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Ordningsnummer: </th>";
echo "<th class='tabellrad'>Artikelbenämning: </th>";
echo "<th class='tabellrad'>Varde: </th>";
echo "<th class='tabellrad'>Beskrivning: </th>";
echo "<th class='tabellrad'>Ta bort: </th>";

foreach ($dbc->query("SELECT * FROM artiklar_langning") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['id']."</td>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo "<td class='tabellinfo'>".$row['beskrivning']."</td>";
			echo  "<td class='tabellinfo'><button type='submit' value='".$row['id']."' name='deletelangning' >Ta bort</button></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";
echo"<br>";
echo "</form>";

echo "<form method='POST'>";
echo "<h3>Försäkring</h3>";
echo "<br>";			

echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Ordningsnummer: </th>";
echo "<th class='tabellrad'>Artikelbenämning: </th>";
echo "<th class='tabellrad'>Varde: </th>";
echo "<th class='tabellrad'>Ta bort: </th>";

foreach ($dbc->query("SELECT * FROM artiklar_forsakring") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['id']."</td>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo  "<td class='tabellinfo'><button type='submit' value='".$row['id']."' name='deleteforsakring' >Ta bort</button></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";
echo"<br>";
echo "</form>";

echo "<form method='POST'>";
echo "<h3>Bussbiljett</h3>";
echo "<br>";				

echo "<table class='tabell'>";
echo "<tr>";
echo "<th class='tabellrad'>Ordningsnummer: </th>";
echo "<th class='tabellrad'>Artikelbenämning: </th>";
echo "<th class='tabellrad'>Varde: </th>";
echo "<th class='tabellrad'>Ta bort: </th>";


foreach ($dbc->query("SELECT * FROM artiklar_biljett") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['id']."</td>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo  "<td class='tabellinfo'><button type='submit' value='".$row['id']."' name='deletebiljett' >Ta bort</button></td>";
		echo "</tr>";
}
echo "</tr>";
echo "</table>";
echo"<br>";
echo "</form>";

if (isset($_POST['deletevalla'])) {
			$delvalla = $_POST['deletevalla'];
	
                $sql  = "DELETE FROM artiklar_valla WHERE id='$delvalla'";
				$result = mysqli_query($dbc,$sql);
					
		echo"<script type='text/javascript'>window.location='back_office_nyatillval.php';</script>";
	}
if (isset($_POST['deletediplom'])) {
			$deldiplom = $_POST['deletediplom'];
	
            $sql  = "DELETE FROM artiklar_diplom WHERE id='$deldiplom'";
			$result = mysqli_query($dbc,$sql);
					
		echo"<script type='text/javascript'>window.location='back_office_nyatillval.php';</script>";
	}
	
	if (isset($_POST['deletelangning'])) {
			$dellangning = $_POST['deletelangning'];
	
                $sql  = "DELETE FROM artiklar_langning WHERE id='$dellangning'";
				$result = mysqli_query($dbc,$sql);
					
		echo"<script type='text/javascript'>window.location='back_office_nyatillval.php';</script>";
	}
	
	if (isset($_POST['deleteforsakring'])) {
			$delforsakring = $_POST['deleteforsakring'];
	
                $sql  = "DELETE FROM artiklar_forsakring WHERE id='$delforsakring'";
				$result = mysqli_query($dbc,$sql);
					
		echo"<script type='text/javascript'>window.location='back_office_nyatillval.php';</script>";
	}
	
	if (isset($_POST['deletebiljett'])) {
			$delbiljett = $_POST['deletebiljett'];
	
                $sql  = "DELETE FROM artiklar_biljett WHERE id='$delbiljett'";
				$result = mysqli_query($dbc,$sql);
					
		echo"<script type='text/javascript'>window.location='back_office_nyatillval.php';</script>";
	}
	
	
	

?>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>
