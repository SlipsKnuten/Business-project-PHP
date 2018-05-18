<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<?php
	include("connection.php");
	session_start();
	
	$usr = $_SESSION['logged_in'];
	if($usr != true){
		echo "<script type='text/javascript'>alert('You are not logged in')</script>";
		echo "<script type='text/javascript'>window.location='login.php';</script>";
	}
	
	
	if(isset($_POST['usrName'])){
		$mail = $_POST['usrName'];
		$fornamn = $_POST['fornamn'];
		$efternamn = $_POST['efternamn'];
		$mobilnr = $_POST['mobilnr'];
		$kon =$_POST['kon'];
		$alder =$_POST['alder'];
			$stad =$_POST['stad'];
			$land =$_POST['land'];
			$klubb =$_POST['klubb'];
		$oldmail = $_SESSION['login_user'];
		
		
		
		$sql = "UPDATE users SET kon ='$kon', alder = '$alder', usrMail = '$mail', fornamn = '$fornamn', efternamn = '$efternamn', mobilnr = '$mobilnr', stad = '$stad', land = '$land', klubb = '$klubb' WHERE usrMail = '$oldmail'";
		$sql1 = "SELECT fornamn, efternamn, kon, alder, stad, land, klubb usrMail FROM users WHERE usrMail = '$oldmail' OR usrMail = '$mail'";
		
		$result = mysqli_query($dbc,$sql);	
		$result1 = mysqli_query($dbc,$sql1);	
		$test = mysqli_fetch_array($result1);	
			// var_dump($test);
		$_SESSION['userInfo'] = $test;
		// var_dump($userInfo);
		$_SESSION['login_user'] = $mail; 
	}	
?>
</head>
<body onload="test()">

<h1 id="titel">Mina sidor</h1>
<header>
<ul id="nav">
	<li class="navli"><a class="navcontent" href="index.php">Hem</a></li>
	<li class="navli"><a class="navcontent" href="my_page.php">Mina sidor</a></li>
	<li class="navli"><a class="navcontent" href="about_us.php">Om oss</a></li>
	<li class="navli"><a class="navcontent" href="sign_up.php">Registrera</a></li>
	<li class="navli"><a class="navcontent" href="login.php">Logga ut</a></li>
</ul>
</header>
<div id="wrapper_my_page">
<div class="tab">
	<button class="tablinks" onclick="openCity(event, 'Mina_sidor')">Mina sidor</button>
	<button class="tablinks" onclick="openCity(event, 'Min_statistik')" id="defaultOpen">Min statistik</button>
	<button class="tablinks" onclick="openCity(event, 'Mina_köp')">Mina köp</button>
	<button class="tablinks" onclick="openCity(event, 'feedback')">Lämna feedback</button>
</div>


<div id="Min_statistik" class="tabcontent">
  
<?php
	if(isset($_SESSION['logged_in'])){
	$usr = $_SESSION['login_user'];
	}
	if(isset($_SESSION['hashed_pw'])){
		$pw = $_SESSION['hashed_pw'];
	}
	
	echo "<ul>";
		foreach($dbc->query( "SELECT * FROM users WHERE usrMail = '$usr'") as $row){
			echo "<li>Namn: " .$row['fornamn']. " ".$row['efternamn']."</li><br>";
			echo "<li>Ålder: " .$row['alder']. "</li><br>";
			echo "<li>Kön: " .$row['kon']. "</li><br>";
			
			$kundnr = $row['kundnr'];
			$_SESSION['fornamn'] = $row['fornamn'];
			$_SESSION['efternamn'] = $row['efternamn'];
		}
	echo "</ul>";	
	echo "<form method = post>";
	echo "<select id='dropdown' name = 'ordningsnr'>";
		foreach($dbc->query( "SELECT * FROM splits_alla_lopp WHERE kundnr = '$kundnr'") as $row){
		echo "<option value = " .$row['ordningsnr']. "> ". $row['ordningsnr'] ." - ". $row['namn']. " - ". $row['distans']."</option>";
		}
	echo "</select>";
	echo "<input type='submit'>";
	echo "</form>";
	
	if(isset($_POST['ordningsnr'])){
		$ordningsnr = $_POST['ordningsnr'];
		$_SESSION['ordningsnr'] = $ordningsnr;
		// echo $_SESSION['ordningsnr'];
		// echo $ordningsnr;
		echo "<br>";
		echo "<table class ='tabell_my_page'>";
			
		foreach($dbc->query( "SELECT * FROM splitar WHERE ordningsnr = '$ordningsnr' AND  kundnr ='$kundnr'") as $row){
			
			$_SESSION['hedemora'] = $row['hedemora'];
			$_SESSION['norrhyttan'] = $row['norrhyttan'];
			$_SESSION['bondhyttan'] = $row['bondhyttan'];
			$_SESSION['bommansbo'] = $row['bommansbo'];
			$_SESSION['smedjebacken'] = $row['smedjebacken'];
			$_SESSION['bjorsjo'] = $row['bjorsjo'];
			$_SESSION['grangesberg'] = $row['grangesberg'];
				
				echo "<tr class = 'tabellrad'>";
					echo "<th class = 'table_head_my_page'>Hedemora</th>";
					echo "<th class = 'table_head_my_page'>Norrhyttan</th>";
					echo "<th class = 'table_head_my_page'>Bondhyttan</th>";
					echo "<th class = 'table_head_my_page'>Bommansbo</th>";
					echo "<th class = 'table_head_my_page'>Smedjebacken</th>";
					echo "<th class = 'table_head_my_page'>Björsjö</th>";
					echo "<th class = 'table_head_my_page'>Grängesberg</th>";
				echo "</tr>";
			
				echo "<tr>";
					echo "<td class='tabellinfo_my_page'>Hedemora: ".$row['hedemora']."</td>";
					echo "<td class='tabellinfo_my_page'>Norrhyttan: ".$row['norrhyttan']."</td>";
					echo "<td class='tabellinfo_my_page'>Bondhyttan: ".$row['bondhyttan']."</td>";
					echo "<td class='tabellinfo_my_page'>Bommansbo: ".$row['bommansbo']."</td>";
					echo "<td class='tabellinfo_my_page'>Smedjebacken: ".$row['smedjebacken']."</td>";
					echo "<td class='tabellinfo_my_page'>Björsjö: ".$row['bjorsjo']."</td>";
					echo "<td class='tabellinfo_my_page'>Grängesberg: ".$row['grangesberg']."</td>";
				echo "</tr>";
			}
			
			
		}
		echo "</table>";
		echo "<p>Med hjälp av nedanstående ruta kan du välja motståndare att jämföra dig med.</p>";
		echo "<form method=post>";
		echo "<select id='dropdown' name='motstandare'>";
		
		foreach($dbc->query( "SELECT * FROM opponent WHERE ordningsnr = '$ordningsnr'") as $row){
		echo "<option value = " .$row['kundnr']. "> ". $row['fornamn']. "  ".$row['efternamn']."</option>";
		}

		echo"</select>";
		echo"<input type='submit'>";

		if(isset($_POST['motstandare'])){
			$opponent = $_POST['motstandare'];
			$_SESSION['opponent'] = $opponent;
			
			echo "</form>";
			
			echo "<ul>";
						foreach($dbc->query( "SELECT * FROM users WHERE kundnr = '$opponent'") as $row){
						echo "<li>Förnamn: ".$row['fornamn']."</li><br>"; 
						echo "<li>Efternamn: ".$row['efternamn']."</li><br>"; 
						echo "<li>Ålder: ".$row['alder']."</li><br>"; 
						echo "<li>Kön: ".$row['kon']."</li>"; 
						$_SESSION['test'] = $row['fornamn'];
						}
			echo "</ul>";
			echo "<br>";
			echo "<br>";
			
			
			echo "<table class ='tabell_my_page'>";
				echo "<tr class = 'tabellrad'>";
					echo "<th class = 'table_head_my_page'>Hedemora</th>";
					echo "<th class = 'table_head_my_page'>Norrhyttan</th>";
					echo "<th class = 'table_head_my_page'>Bondhyttan</th>";
					echo "<th class = 'table_head_my_page'>Bommansbo</th>";
					echo "<th class = 'table_head_my_page'>Smedjebacken</th>";
					echo "<th class = 'table_head_my_page'>Björsjö</th>";
					echo "<th class = 'table_head_my_page'>Grängesberg</th>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['hedemora']."</td>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['norrhyttan']."</td>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['bondhyttan']."</td>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['bommansbo']."</td>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['smedjebacken']."</td>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['bjorsjo']."</td>";
					echo "<td class='tabellinfo_my_page'>".$_SESSION['grangesberg']."</td>";
				echo "</tr>";
			echo "</table>";

			
				

		
			echo"<table class ='tabell_my_page'>";
				echo "<tr class = 'tabellrad'>";
					echo "<th class = 'table_head_my_page'>Hedemora</th>";
					echo "<th class = 'table_head_my_page'>Norrhyttan</th>";
					echo "<th class = 'table_head_my_page'>Bondhyttan</th>";
					echo "<th class = 'table_head_my_page'>Bommansbo</th>";
					echo "<th class = 'table_head_my_page'>Smedjebacken</th>";
					echo "<th class = 'table_head_my_page'>Björsjö</th>";
					echo "<th class = 'table_head_my_page'>Grängesberg</th>";
				echo "</tr>";
		
				foreach($dbc->query( "SELECT * FROM splitar WHERE ordningsnr = '$_SESSION[ordningsnr]' AND  kundnr ='$_SESSION[opponent]'") as $row){
					echo"<tr>";
						echo"<td class='tabellinfo_my_page'>".$row['hedemora']."</td>";
						echo"<td class='tabellinfo_my_page'>".$row['norrhyttan']."</td>";
						echo"<td class='tabellinfo_my_page'>".$row['bondhyttan']."</td>";
						echo"<td class='tabellinfo_my_page'>".$row['bommansbo']."</td>";
						echo"<td class='tabellinfo_my_page'>".$row['smedjebacken']."</td>";
						echo"<td class='tabellinfo_my_page'>".$row['bjorsjo']."</td>";
						echo"<td class='tabellinfo_my_page'>".$row['grangesberg']."</td>";
						                    
						$_SESSION['opponent_hedemora'] = $row['hedemora'];
						$_SESSION['opponent_norrhyttan'] = $row['norrhyttan'];
						$_SESSION['opponent_bondhyttan'] = $row['bondhyttan'];
						$_SESSION['opponent_bommansbo'] = $row['bommansbo'];
						$_SESSION['opponent_smedjebacken'] = $row['smedjebacken'];
						$_SESSION['opponent_bjorsjo'] = $row['bjorsjo'];
						$_SESSION['opponent_grangesberg'] = $row['grangesberg'];
					echo"</tr>";
				}
			echo"</table>";
			
					$hedemora = (explode(".",$_SESSION['hedemora']));
					$_SESSION['sum_hedemora'] = $hedemora['0']*60+$hedemora['1'];
				
					$norrhyttan = (explode(".",$_SESSION['norrhyttan']));
					$_SESSION['sum_norrhyttan'] = $norrhyttan['0']*60+$norrhyttan['1'];
					
					$bondhyttan = (explode(".",$_SESSION['bondhyttan']));
					$_SESSION['sum_bondhyttan'] = $bondhyttan['0']*60+$bondhyttan['1'];
								
					$bommansbo = (explode(".",$_SESSION['bommansbo']));
					$_SESSION['sum_bommansbo'] = $bommansbo['0']*60+$bommansbo['1'];
					
					$smedjebacken = (explode(".",$_SESSION['smedjebacken']));
					$_SESSION['sum_smedjebacken'] = $smedjebacken['0']*60+$smedjebacken['1'];
					
					$bjorsjo = (explode(".",$_SESSION['bjorsjo']));
					$_SESSION['sum_bjorsjo'] = $bjorsjo['0']*60+$bjorsjo['1'];
					
					$grangesberg = (explode(".",$_SESSION['grangesberg']));
					$_SESSION['sum_grangesberg'] = $grangesberg['0']*60+$grangesberg['1'];
					
					$hedemora_opponent = (explode(".",$_SESSION['opponent_hedemora']));
					$_SESSION['sum_opponent_hedemora'] = $hedemora_opponent['0']*60+$hedemora_opponent['1'];
						
					$norrhyttan_opponent = (explode(".",$_SESSION['opponent_norrhyttan']));
					$_SESSION['sum_opponent_norrhyttan'] = $norrhyttan_opponent['0']*60+$norrhyttan_opponent['1'];
						
					$bondhyttan_opponent = (explode(".",$_SESSION['opponent_bondhyttan']));
					$_SESSION['sum_opponent_bondhyttan'] = $bondhyttan_opponent['0']*60+$bondhyttan_opponent['1'];
						
					$bommansbo_opponent = (explode(".",$_SESSION['opponent_bommansbo']));
					$_SESSION['sum_opponent_bommansbo'] = $bommansbo_opponent['0']*60+$bommansbo_opponent['1'];
						
					$smedjebacken_opponent = (explode(".",$_SESSION['opponent_smedjebacken']));
					$_SESSION['sum_opponent_smedjebacken'] = $smedjebacken_opponent['0']*60+$smedjebacken_opponent['1'];
						
					$bjorsjo_opponent = (explode(".",$_SESSION['opponent_bjorsjo']));
					$_SESSION['sum_opponent_bjorsjo'] = $bjorsjo_opponent['0']*60+$bjorsjo_opponent['1'];
						
					$grangesberg_opponent = (explode(".",$_SESSION['opponent_grangesberg']));
					$_SESSION['sum_opponent_grangesberg'] = $grangesberg_opponent['0']*60+$grangesberg_opponent['1'];
					}			
		
		
			echo "<form method = post>";
			echo "<p>Med hjälp av nedanstående ruta kan du få uträkningar på snittider på ditt valda lopp</p>";
			echo "<select id='dropdown' name = 'kon'>";
			
				echo "<option value = '1'> man</option>";
				echo "<option value = '2'> kvinna</option>";
				echo "<option value = '3'> alla</option>";
			
			echo "</select>";
			echo "<input type='submit'>";
			echo "</form>";
			if(isset($_POST['kon'])){
			if ($_POST['kon'] == '1'){
				foreach($dbc->query( "SELECT ROUND(AVG(hedemora),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_hedemora'] = $row['ROUND(AVG(hedemora),2)'];
							}
				
				foreach($dbc->query( "SELECT ROUND(AVG(norrhyttan),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_norrhyttan'] = $row['ROUND(AVG(norrhyttan),2)'];
							}
							
				foreach($dbc->query( "SELECT ROUND(AVG(bjorsjo),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_bjorsjo'] = $row['ROUND(AVG(bjorsjo),2)'];
							}
							
				foreach($dbc->query( "SELECT ROUND(AVG(bondhyttan),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_bondhyttan'] = $row['ROUND(AVG(bondhyttan),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(bommansbo),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_bommansbo'] = $row['ROUND(AVG(bommansbo),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(smedjebacken),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_smedjebacken'] = $row['ROUND(AVG(smedjebacken),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(grangesberg),2) FROM users_splitar_man WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_man_grangesberg'] = $row['ROUND(AVG(grangesberg),2)'];
							}		
				$hedemora = (explode(".",$_SESSION['kon_man_hedemora']));
				$_SESSION['sum_kon_man_hedemora'] = ($hedemora['0']*60)+$hedemora['1'];
				
				$norrhyttan = (explode(".",$_SESSION['kon_man_norrhyttan']));
				$_SESSION['sum_kon_man_norrhyttan'] = $norrhyttan['0']*60+$norrhyttan['1'];
					
				$bondhyttan = (explode(".",$_SESSION['kon_man_bondhyttan']));
				$_SESSION['sum_kon_man_bondhyttan'] = $bondhyttan['0']*60+$bondhyttan['1'];
								
				$bommansbo = (explode(".",$_SESSION['kon_man_bommansbo']));
				$_SESSION['sum_kon_man_bommansbo'] = $bommansbo['0']*60+$bommansbo['1'];
					
				$smedjebacken = (explode(".",$_SESSION['kon_man_smedjebacken']));
				$_SESSION['sum_kon_man_smedjebacken'] = $smedjebacken['0']*60+$smedjebacken['1'];
					
				$bjorsjo = (explode(".",$_SESSION['kon_man_bjorsjo']));
				$_SESSION['sum_kon_man_bjorsjo'] = $bjorsjo['0']*60+$bjorsjo['1'];
					
				$grangesberg = (explode(".",$_SESSION['kon_man_grangesberg']));
				$_SESSION['sum_kon_man_grangesberg'] = $grangesberg['0']*60+$grangesberg['1'];
				
				
				?>		<canvas id='avg_man_chart' style = 'width=50% height=50%' ></canvas></scrip>
							<canvas id="avg_kvinna_chart" style = "width=50% height=50%" ></canvas>	
							<canvas id="avg_alla_chart" style = "width=50% height=50%" ></canvas>
								
				<?php		
					
						
				
			}
			else if ($_POST['kon'] == '2'){
				echo "kvinna";
				foreach($dbc->query( "SELECT ROUND(AVG(hedemora),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_hedemora'] = $row['ROUND(AVG(hedemora),2)'];
							}
				
				foreach($dbc->query( "SELECT ROUND(AVG(norrhyttan),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_norrhyttan'] = $row['ROUND(AVG(norrhyttan),2)'];
							}
							
				foreach($dbc->query( "SELECT ROUND(AVG(bjorsjo),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_bjorsjo'] = $row['ROUND(AVG(bjorsjo),2)'];
							}
							
				foreach($dbc->query( "SELECT ROUND(AVG(bondhyttan),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_bondhyttan'] = $row['ROUND(AVG(bondhyttan),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(bommansbo),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_bommansbo'] = $row['ROUND(AVG(bommansbo),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(smedjebacken),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_smedjebacken'] = $row['ROUND(AVG(smedjebacken),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(grangesberg),2) FROM users_splitar_kvinna WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_kvinna_grangesberg'] = $row['ROUND(AVG(grangesberg),2)'];
							}		
				$hedemora = (explode(".",$_SESSION['kon_kvinna_hedemora']));
				$_SESSION['sum_kon_kvinna_hedemora'] = ($hedemora['0']*60)+$hedemora['1'];
				
				$norrhyttan = (explode(".",$_SESSION['kon_kvinna_norrhyttan']));
				$_SESSION['sum_kon_kvinna_norrhyttan'] = $norrhyttan['0']*60+$norrhyttan['1'];
					
				$bondhyttan = (explode(".",$_SESSION['kon_kvinna_bondhyttan']));
				$_SESSION['sum_kon_kvinna_bondhyttan'] = $bondhyttan['0']*60+$bondhyttan['1'];
								
				$bommansbo = (explode(".",$_SESSION['kon_kvinna_bommansbo']));
				$_SESSION['sum_kon_kvinna_bommansbo'] = $bommansbo['0']*60+$bommansbo['1'];
					
				$smedjebacken = (explode(".",$_SESSION['kon_kvinna_smedjebacken']));
				$_SESSION['sum_kon_kvinna_smedjebacken'] = $smedjebacken['0']*60+$smedjebacken['1'];
					
				$bjorsjo = (explode(".",$_SESSION['kon_kvinna_bjorsjo']));
				$_SESSION['sum_kon_kvinna_bjorsjo'] = $bjorsjo['0']*60+$bjorsjo['1'];
					
				$grangesberg = (explode(".",$_SESSION['kon_kvinna_grangesberg']));
				$_SESSION['sum_kon_kvinna_grangesberg'] = $grangesberg['0']*60+$grangesberg['1'];
							
			}
			else if ($_POST['kon'] == '3'){
				echo "alla";
				foreach($dbc->query( "SELECT ROUND(AVG(hedemora),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_hedemora'] = $row['ROUND(AVG(hedemora),2)'];
							}
				
				foreach($dbc->query( "SELECT ROUND(AVG(norrhyttan),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_norrhyttan'] = $row['ROUND(AVG(norrhyttan),2)'];
							}
							
				foreach($dbc->query( "SELECT ROUND(AVG(bjorsjo),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_bjorsjo'] = $row['ROUND(AVG(bjorsjo),2)'];
							}
							
				foreach($dbc->query( "SELECT ROUND(AVG(bondhyttan),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_bondhyttan'] = $row['ROUND(AVG(bondhyttan),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(bommansbo),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_bommansbo'] = $row['ROUND(AVG(bommansbo),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(smedjebacken),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_smedjebacken'] = $row['ROUND(AVG(smedjebacken),2)'];
							}	
							
				foreach($dbc->query( "SELECT ROUND(AVG(grangesberg),2) FROM users_splitar_alla WHERE ordningsnr = '$_SESSION[ordningsnr]'") as $row){
							$_SESSION['kon_alla_grangesberg'] = $row['ROUND(AVG(grangesberg),2)'];
							}		
				$hedemora = (explode(".",$_SESSION['kon_alla_hedemora']));
				$_SESSION['sum_kon_alla_hedemora'] = ($hedemora['0']*60)+$hedemora['1'];
				
				$norrhyttan = (explode(".",$_SESSION['kon_alla_norrhyttan']));
				$_SESSION['sum_kon_alla_norrhyttan'] = $norrhyttan['0']*60+$norrhyttan['1'];
					
				$bondhyttan = (explode(".",$_SESSION['kon_alla_bondhyttan']));
				$_SESSION['sum_kon_alla_bondhyttan'] = $bondhyttan['0']*60+$bondhyttan['1'];
								
				$bommansbo = (explode(".",$_SESSION['kon_alla_bommansbo']));
				$_SESSION['sum_kon_alla_bommansbo'] = $bommansbo['0']*60+$bommansbo['1'];
					
				$smedjebacken = (explode(".",$_SESSION['kon_alla_smedjebacken']));
				$_SESSION['sum_kon_alla_smedjebacken'] = $smedjebacken['0']*60+$smedjebacken['1'];
					
				$bjorsjo = (explode(".",$_SESSION['kon_alla_bjorsjo']));
				$_SESSION['sum_kon_alla_bjorsjo'] = $bjorsjo['0']*60+$bjorsjo['1'];
					
				$grangesberg = (explode(".",$_SESSION['kon_alla_grangesberg']));
				$_SESSION['sum_kon_alla_grangesberg'] = $grangesberg['0']*60+$grangesberg['1'];
				
			}
		}			
?>


<canvas id="myChart" style = "width=50% height=50%" ></canvas>


	

	
	<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Hedemora", "Norrhyttan", "Bondhyttan", "Bommansbo", "Smedjebacken", "Björsjö", "Grängesberg"],
        datasets: [{
            label: <?php
            echo '"' . $_SESSION['fornamn'] . '"';
            ?>,
            backgroundColor: '#36a2eb',
            borderColor: '#36a2eb',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_hedemora'] . ",";
			echo $_SESSION['sum_norrhyttan'] . ",";
			echo $_SESSION['sum_bondhyttan'] . ",";
			echo $_SESSION['sum_bommansbo'] . ",";
			echo $_SESSION['sum_smedjebacken'] . ",";
			echo $_SESSION['sum_bjorsjo'] . ",";
			echo $_SESSION['sum_grangesberg'] . ",";
			?>
			],
			},
			{
            label: "Motståndare",
            backgroundColor: '#ffce56',
			borderColor: '#ffce56',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_opponent_hedemora'] . ",";
			echo $_SESSION['sum_opponent_norrhyttan'] . ",";
			echo $_SESSION['sum_opponent_bondhyttan'] . ",";
			echo $_SESSION['sum_opponent_bommansbo'] . ",";
			echo $_SESSION['sum_opponent_smedjebacken'] . ",";
			echo $_SESSION['sum_opponent_bjorsjo'] . ",";
			echo $_SESSION['sum_opponent_grangesberg'] . ",";
			?>
			],
			}
			]
    },
    options: {
		
        scales: {
            yAxes: [{
                ticks: {
					
								beginAtZero: true,
                                steps: 60,
                                stepValue: 60,
                                max: 500
                }
				
            }]
        }
    }
});
</script>
<script>
var ctx = document.getElementById("avg_man_chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Hedemora", "Norrhyttan", "Bondhyttan", "Bommansbo", "Smedjebacken", "Björsjö", "Grängesberg"],
        datasets: [{
            label: <?php
            echo '"' . $_SESSION['fornamn'] . '"';
            ?>,
            backgroundColor: '#36a2eb',
            borderColor: '#36a2eb',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_hedemora'] . ",";
			echo $_SESSION['sum_norrhyttan'] . ",";
			echo $_SESSION['sum_bondhyttan'] . ",";
			echo $_SESSION['sum_bommansbo'] . ",";
			echo $_SESSION['sum_smedjebacken'] . ",";
			echo $_SESSION['sum_bjorsjo'] . ",";
			echo $_SESSION['sum_grangesberg'] . ",";
			?>
			],
			},
			{
            label: "Avg_man",
            backgroundColor: '#ffce56',
			borderColor: '#ffce56',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_kon_man_hedemora'] . ",";
			echo $_SESSION['sum_kon_man_norrhyttan'] . ",";
			echo $_SESSION['sum_kon_man_bondhyttan'] . ",";
			echo $_SESSION['sum_kon_man_bommansbo'] . ",";
			echo $_SESSION['sum_kon_man_smedjebacken'] . ",";
			echo $_SESSION['sum_kon_man_bjorsjo'] . ",";
			echo $_SESSION['sum_kon_man_grangesberg'] . ",";
			?>
			],
			}
			]
    },
    options: {
		
        scales: {
            yAxes: [{
                ticks: {
					
								beginAtZero: true,
                                steps: 60,
                                stepValue: 60,
                                max: 500
                }
				
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("avg_alla_chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Hedemora", "Norrhyttan", "Bondhyttan", "Bommansbo", "Smedjebacken", "Björsjö", "Grängesberg"],
        datasets: [{
            label: <?php
            echo '"' . $_SESSION['fornamn'] . '"';
            ?>,
            backgroundColor: '#36a2eb',
            borderColor: '#36a2eb',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_hedemora'] . ",";
			echo $_SESSION['sum_norrhyttan'] . ",";
			echo $_SESSION['sum_bondhyttan'] . ",";
			echo $_SESSION['sum_bommansbo'] . ",";
			echo $_SESSION['sum_smedjebacken'] . ",";
			echo $_SESSION['sum_bjorsjo'] . ",";
			echo $_SESSION['sum_grangesberg'] . ",";
			?>
			],
			},
			{
            label: "Avg_alla",
            backgroundColor: '#ffce56',
			borderColor: '#ffce56',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_kon_alla_hedemora'] . ",";
			echo $_SESSION['sum_kon_alla_norrhyttan'] . ",";
			echo $_SESSION['sum_kon_alla_bondhyttan'] . ",";
			echo $_SESSION['sum_kon_alla_bommansbo'] . ",";
			echo $_SESSION['sum_kon_alla_smedjebacken'] . ",";
			echo $_SESSION['sum_kon_alla_bjorsjo'] . ",";
			echo $_SESSION['sum_kon_alla_grangesberg'] . ",";
			?>
			],
			}
			]
    },
    options: {
		
        scales: {
            yAxes: [{
                ticks: {
					
								beginAtZero: true,
                                steps: 60,
                                stepValue: 60,
                                max: 500
                }
				
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("avg_kvinna_chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Hedemora", "Norrhyttan", "Bondhyttan", "Bommansbo", "Smedjebacken", "Björsjö", "Grängesberg"],
        datasets: [{
            label: <?php
            echo '"' . $_SESSION['fornamn'] . '"';
            ?>,
            backgroundColor: '#36a2eb',
            borderColor: '#36a2eb',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_hedemora'] . ",";
			echo $_SESSION['sum_norrhyttan'] . ",";
			echo $_SESSION['sum_bondhyttan'] . ",";
			echo $_SESSION['sum_bommansbo'] . ",";
			echo $_SESSION['sum_smedjebacken'] . ",";
			echo $_SESSION['sum_bjorsjo'] . ",";
			echo $_SESSION['sum_grangesberg'] . ",";
			?>
			],
			},
			{
            label: "Avg_kvinna",
            backgroundColor: '#ffce56',
			borderColor: '#ffce56',
            fill:false,
            borderWidth: 1,
			data: [<?php
			echo $_SESSION['sum_kon_kvinna_hedemora'] . ",";
			echo $_SESSION['sum_kon_kvinna_norrhyttan'] . ",";
			echo $_SESSION['sum_kon_kvinna_bondhyttan'] . ",";
			echo $_SESSION['sum_kon_kvinna_bommansbo'] . ",";
			echo $_SESSION['sum_kon_kvinna_smedjebacken'] . ",";
			echo $_SESSION['sum_kon_kvinna_bjorsjo'] . ",";
			echo $_SESSION['sum_kon_kvinna_grangesberg'] . ",";
			?>
			],
			}
			]
    },
    options: {
		
        scales: {
            yAxes: [{
                ticks: {
					
								beginAtZero: true,
                                steps: 60,
                                stepValue: 60,
                                max: 500
                }
				
            }]
        }
    }
});
</script>


</div>


<center><div id="Mina_sidor" class="tabcontent">
  <h3>Mina sidor</h3>
  <br>
  <?php
	if(isset($_SESSION['logged_in'])){
		$usr = $_SESSION['login_user'];
		
		if(isset($_SESSION['hashed_pw'])){
			$pw = $_SESSION['hashed_pw'];
		}
	
	echo "<div id='my_page_upd'>";
	echo "<form method='post' >";
	foreach($dbc->query( "SELECT * FROM users WHERE usrMail = '$usr'") as $row){
		echo "E-mail <br><input class='input'  type='text' name='usrName' class='statictext' value='".$row['usrMail']."'><br>";
		echo "Förnam <br><input class='input'  type='text' name='fornamn' class='statictext' value='".$row['fornamn']."'><br>";
		echo "Efternamn <br><input class='input'  type='text' name='efternamn' class='statictext' value='".$row['efternamn']."'><br>";
		echo "Kön <br><input class='input'  type='text' name='kon' class='statictext' value='".$row['kon']."'><br>";
		echo "Ålder <br><input class='input'  type='text' class='statictext' name='alder' value='".$row['alder']."'><br>";
		echo "Stad <br><input class='input'  type='text' class='statictext' name='stad' value='".$row['stad']."'><br>";
		echo "Land <br><input class='input'  type='text' class='statictext' name='land' value='".$row['land']."'><br>";
		echo "Klubb <br><input class='input'  type='text' class='statictext' name='klubb' value='".$row['klubb']."'><br>";
		echo "Mobilnummer <br><input class='input'  type='text' class='statictext' name='mobilnr' onkeypress='validate(event)' value='".$row['mobilnr']."'><br>"; /*Går inte att läsa av 0:or pga integer i databasen*/
	}
	echo "<input type='submit' value='Uppdatera' id='update'>";
	echo "</form>";
	echo "</div>";
	}
  ?>
</div>
</center>

<div id="Mina_köp" class="tabcontent">
  <?php
		$info = $_SESSION['userInfo'];
		$usr = $info[4];

		$sql1 = "SELECT kundnr FROM users WHERE usrMail = '$usr'";
		$result = mysqli_query($dbc, $sql1);
		$kundnr = mysqli_fetch_array($result);
		$kundnr1 = $kundnr['0'];
				
		$sql2 = "SELECT * FROM joint_anmalan WHERE kundnr = '$kundnr1'";
		echo "<center><h1>Mina lopp</h1>";
		echo "<p>I nedanstående lista kan du se din historiska loppanmälningar samt tillköpta tillval. </p>";
		
		$sql3 = "SELECT * FROM joint_tillval WHERE kundnr = '$kundnr1'";
		echo "<table id='minaLopp'>";
			echo "<tr>";
			echo "<th>Kundnr</th>";
			echo "<th>Ordningsnr</th>";
			echo "<th>Startnr</th>";
			echo "<th>Diplom</th>";
			echo "<th>Försäkring</th>";
			echo "<th>Bussbiljett</th>";
			echo "<th>Valla</th>";
			echo "<th>Langning</th>";
		
			foreach($dbc->query($sql3) as $row){
				$diplom = $row['diplom'];
				$forsakring = $row['forsakring'];
				$bussbiljett = $row['bussbiljett'];
				$valla = $row['valla'];
				$langning = $row['langning'];
					
				$sql1 = "SELECT namn FROM artiklar_diplom WHERE id = '$diplom'";
				$result = mysqli_query($dbc, $sql1);
				$diplom = mysqli_fetch_array($result);
				$diplom1 = $diplom['0'];
			
				$sql1 = "SELECT namn FROM artiklar_forsakring WHERE id = '$forsakring'";
				$result = mysqli_query($dbc, $sql1);
				$forsakring = mysqli_fetch_array($result);
				$forsakring1 = $forsakring['0'];
			
				$sql1 = "SELECT namn FROM artiklar_biljett WHERE id = '$bussbiljett'";
				$result = mysqli_query($dbc, $sql1);
				$bussbiljett = mysqli_fetch_array($result);
				$bussbiljett1 = $bussbiljett['0'];
			
				$sql1 = "SELECT namn FROM artiklar_valla WHERE id = '$valla'";
				$result = mysqli_query($dbc, $sql1);
				$valla = mysqli_fetch_array($result);
				$valla1 = $valla['0'];
			
				$sql1 = "SELECT namn FROM artiklar_langning WHERE id = '$langning'";
				$result = mysqli_query($dbc, $sql1);
				$langning = mysqli_fetch_array($result);
				$langning1 = $langning['0'];
					
				echo "<tr>";
					echo "<td>".$row['kundnr']."</td>";
					echo "<td>".$row['ordningsnr']."</td>";
					echo "<td>".$row['startnr']."</td>";
					echo "<td>".$diplom1."</td>";
					echo "<td>".$forsakring1."</td>";
					echo "<td>".$bussbiljett1."</td>";
					echo "<td>".$valla1."</td>";
					echo "<td>".$langning1."</td>";
				echo "</tr>";
		}	
		echo "</table>";
echo "<br>";
echo "<h2>Uppdatera tillval </h2>";
echo "<br>";
echo "<br>";
echo "<p><b>I nedanstående formulär kan du uppdatera dina tillval</b></p>";
echo "<br>";
echo "<div id='my_page_upd'>";
echo "<form method='POST'>";
	echo "<select id ='dropdown' name='lopp_val'>";
	echo "<option value='1'>MTB</option>";
	echo "<option value='2'>Löpning</option>";
	echo "<option value='3'>Skidor</option>";
	
	echo "</select><br>";

	echo "<input type='text' name='kundnr' class='input' value='Kundnr: ".$kundnr1."'><br>";
	echo "<input type='text' placeholder='Ordningsnr' name='ordningsnr' class='input' value=''><br>";
	echo "<input type='text' placeholder='Startnr' name='startnr' class='input' value=''><br>";
	echo"<br>";
	echo "<div id='mainselection'>";
		echo "<select id ='dropdown_mypage' name='langning'>";
			foreach($dbc->query("SELECT * FROM artiklar_langning")as $row) {
				echo "<option class='tillvalDrop' value=".$row['id'].">".$row['namn']."</option>";
				$langning_id = $row['id'];
			}
		echo "</select><br>";
	echo "</div>";	
		echo "<br>";
	echo "<div id='mainselection'>";
		echo "<select id ='dropdown_mypage' name='diplom'>";
			foreach($dbc->query("SELECT * FROM artiklar_diplom")as $row) {
				echo "<option value=".$row['id'].">".$row['namn']."</option>";
				$diplom_id= $row['id'];
			}
		echo "</select>";
	echo "</div>";
		echo "<br>";
	echo "<div id='mainselection'>";
		echo "<select id ='dropdown_mypage' name='forsakring'>";
			foreach($dbc->query("SELECT * FROM artiklar_forsakring")as $row) {
				echo "<option value=".$row['id'].">".$row['namn']."</option>";
				$forsakring_id= $row['id'];
			}
		echo "</select>";
	echo "</div>";
		echo "<br>";
	echo "<div id='mainselection'>";
		echo "<select id ='dropdown_mypage' name='bussb'>";
			foreach($dbc->query("SELECT * FROM artiklar_biljett")as $row) {
				echo "<option value=".$row['id'].">".$row['namn']."</option>";
				$bussb_id = $row['id'];
				}
		echo "</select>";
	echo "</div>";
		echo "<br>";
	echo "<div id='mainselection'>";
		echo "<select id ='dropdown_mypage' name='valla'>";
			foreach($dbc->query("SELECT * FROM artiklar_valla")as $row) {
				echo "<option value=".$row['id'].">".$row['namn']."</option>";
				$valla_id = $row['id'];
			}
		echo "</select>";
	echo "</div>";
echo "</div>";	
			

if(isset($_POST['ordningsnr'])){
	$ordningsnr = $_POST['ordningsnr'];
	$diplom = $_POST['diplom'];
	$forsakring = $_POST['forsakring'];
	$bussbiljett = $_POST['bussb'];
	$valla = $_POST['valla'];
	$langning = $_POST['langning'];
	$lopp = $_POST['lopp_val'];
	
	if(isset($_POST['lopp_val'])){
		if($lopp == '1'){
	
		foreach($dbc->query("SELECT * FROM tillval_mtb WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'") as $row){
			$test_lang = $row['langning'];
			$test_dip = $row['diplom'];
			$test_bil = $row['bussbiljett'];
			$test_for = $row['forsakring'];
			$test_val = $row['valla'];
			}
			$sql = "SELECT varde FROM artiklar_langning where id = '$test_lang'";
			$result = mysqli_query($dbc, $sql);
			$tid_lang= mysqli_fetch_array($result);
				
			$sql = "SELECT varde FROM artiklar_diplom where id = '$test_dip'";
			$result = mysqli_query($dbc, $sql);
			$tid_dip = mysqli_fetch_array($result);
						
			$sql = "SELECT varde FROM artiklar_biljett where id = '$test_bil'";
			$result = mysqli_query($dbc, $sql);
			$tid_bil = mysqli_fetch_array($result);
				
			$sql = "SELECT varde FROM artiklar_forsakring where id = '$test_for'";
			$result = mysqli_query($dbc, $sql);
			$tid_for = mysqli_fetch_array($result);
	
			$sql = "SELECT varde FROM artiklar_valla where id = '$test_val'";
			$result = mysqli_query($dbc, $sql);
			$tid_val = mysqli_fetch_array($result);
					
			$tid_items = $tid_bil[0] + $tid_dip[0] + $tid_for[0] + $tid_lang[0] + $tid_val[0];
	
			$sql = "SELECT varde FROM artiklar_valla WHERE id = '$valla'";
			$result = mysqli_query($dbc, $sql);
			$pval = mysqli_fetch_array($result);
	
			$sql = "SELECT varde FROM artiklar_langning WHERE id = '$langning'";
			$result = mysqli_query($dbc, $sql);
			$plang = mysqli_fetch_array($result);
			
			$sql = "SELECT varde FROM artiklar_biljett WHERE id = '$bussbiljett'";
			$result = mysqli_query($dbc, $sql);
			$pbil = mysqli_fetch_array($result);
	
			$sql = "SELECT varde FROM artiklar_forsakring WHERE id = '$forsakring'";
			$result = mysqli_query($dbc, $sql);
			$pfor = mysqli_fetch_array($result);
			
			$sql = "SELECT varde FROM artiklar_diplom WHERE id = '$diplom'";
			$result = mysqli_query($dbc, $sql);
			$pdip = mysqli_fetch_array($result);

			$items = $pbil[0] + $pdip[0] + $pfor[0] + $plang[0] + $pval[0];
			$items_bet = $items - $tid_items;
		
			$_SESSION['Langning']= $langning;
			$_SESSION['Bussbiljett'] = $bussbiljett;
			$_SESSION['Forsakring'] = $forsakring;
			$_SESSION['Diplom'] = $diplom;
			$_SESSION['Valla'] = $valla;
			$_SESSION['sum'] = $items_bet;
	
		}
		
		
		else if($lopp == '2'){
	
			foreach($dbc->query("SELECT * FROM tillval_lop WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'") as $row){
				$test_lang = $row['langning'];
				$test_dip = $row['diplom'];
				$test_bil = $row['bussbiljett'];
				$test_for = $row['forsakring'];
				$test_val = $row['valla'];
				}
				
				$sql = "SELECT varde FROM artiklar_langning where id = '$test_lang'";
				$result = mysqli_query($dbc, $sql);
				$tid_lang= mysqli_fetch_array($result);
				
				$sql = "SELECT varde FROM artiklar_diplom where id = '$test_dip'";
				$result = mysqli_query($dbc, $sql);
				$tid_dip = mysqli_fetch_array($result);
				
				$sql = "SELECT varde FROM artiklar_biljett where id = '$test_bil'";
				$result = mysqli_query($dbc, $sql);
				$tid_bil = mysqli_fetch_array($result);
				
				$sql = "SELECT varde FROM artiklar_forsakring where id = '$test_for'";
				$result = mysqli_query($dbc, $sql);
				$tid_for = mysqli_fetch_array($result);
	
				$sql = "SELECT varde FROM artiklar_valla where id = '$test_val'";
				$result = mysqli_query($dbc, $sql);
				$tid_val = mysqli_fetch_array($result);
	
				$tid_items = $tid_bil[0] + $tid_dip[0] + $tid_for[0] + $tid_lang[0] + $tid_val[0];
	
				$sql = "SELECT varde FROM artiklar_valla WHERE id = '$valla'";
				$result = mysqli_query($dbc, $sql);
				$pval = mysqli_fetch_array($result);
	
				$sql = "SELECT varde FROM artiklar_langning WHERE id = '$langning'";
				$result = mysqli_query($dbc, $sql);
				$plang = mysqli_fetch_array($result);
			
				$sql = "SELECT varde FROM artiklar_biljett WHERE id = '$bussbiljett'";
				$result = mysqli_query($dbc, $sql);
				$pbil = mysqli_fetch_array($result);
	
				$sql = "SELECT varde FROM artiklar_forsakring WHERE id = '$forsakring'";
				$result = mysqli_query($dbc, $sql);
				$pfor = mysqli_fetch_array($result);
			
				$sql = "SELECT varde FROM artiklar_diplom WHERE id = '$diplom'";
				$result = mysqli_query($dbc, $sql);
				$pdip = mysqli_fetch_array($result);

				$items = $pbil[0] + $pdip[0] + $pfor[0] + $plang[0] + $pval[0];
				$items_bet = $items - $tid_items;
	
				$_SESSION['Langning']= $langning;
				$_SESSION['Bussbiljett'] = $bussbiljett;
				$_SESSION['Forsakring'] = $forsakring;
				$_SESSION['Diplom'] = $diplom;
				$_SESSION['Valla'] = $valla;
				$_SESSION['sum'] = $items_bet;
	
		}
	
	
	else{
	
			foreach($dbc->query("SELECT * FROM tillval_skidor WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'") as $row){
				$test_lang = $row['langning'];
				$test_dip = $row['diplom'];
				$test_bil = $row['bussbiljett'];
				$test_for = $row['forsakring'];
				$test_val = $row['valla'];
				}
				
				$sql = "SELECT varde FROM artiklar_langning where id = '$test_lang'";
				$result = mysqli_query($dbc, $sql);
				$tid_lang= mysqli_fetch_array($result);
				
				$sql = "SELECT varde FROM artiklar_diplom where id = '$test_dip'";
				$result = mysqli_query($dbc, $sql);
				$tid_dip = mysqli_fetch_array($result);
				
				$sql = "SELECT varde FROM artiklar_biljett where id = '$test_bil'";
				$result = mysqli_query($dbc, $sql);
				$tid_bil = mysqli_fetch_array($result);
				
				$sql = "SELECT varde FROM artiklar_forsakring where id = '$test_for'";
				$result = mysqli_query($dbc, $sql);
				$tid_for = mysqli_fetch_array($result);
	
				$sql = "SELECT varde FROM artiklar_valla where id = '$test_val'";
				$result = mysqli_query($dbc, $sql);
				$tid_val = mysqli_fetch_array($result);
	
				$tid_items = $tid_bil[0] + $tid_dip[0] + $tid_for[0] + $tid_lang[0] + $tid_val[0];
	
				$sql = "SELECT varde FROM artiklar_valla WHERE id = '$valla'";
				$result = mysqli_query($dbc, $sql);
				$pval = mysqli_fetch_array($result);
	
				$sql = "SELECT varde FROM artiklar_langning WHERE id = '$langning'";
				$result = mysqli_query($dbc, $sql);
				$plang = mysqli_fetch_array($result);
			
				$sql = "SELECT varde FROM artiklar_biljett WHERE id = '$bussbiljett'";
				$result = mysqli_query($dbc, $sql);
				$pbil = mysqli_fetch_array($result);
	
				$sql = "SELECT varde FROM artiklar_forsakring WHERE id = '$forsakring'";
				$result = mysqli_query($dbc, $sql);
				$pfor = mysqli_fetch_array($result);
			
				$sql = "SELECT varde FROM artiklar_diplom WHERE id = '$diplom'";
				$result = mysqli_query($dbc, $sql);
				$pdip = mysqli_fetch_array($result);

				$items = $pbil[0] + $pdip[0] + $pfor[0] + $plang[0] + $pval[0];
				$items_bet = $items - $tid_items;
	
				$_SESSION['Langning']= $langning;
				$_SESSION['Bussbiljett'] = $bussbiljett;
				$_SESSION['Forsakring'] = $forsakring;
				$_SESSION['Diplom'] = $diplom;
				$_SESSION['Valla'] = $valla;
				$_SESSION['sum'] = $items_bet;
	
		}
		
	}
	if(isset($_POST['lopp_val'])){
	if($lopp == '1'){
		foreach($dbc->query("SELECT * FROM tillval_mtb WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'") as $row){
			$_SESSION['test_diplom'] = $row['diplom'];
			$_SESSION['test_forsakring'] = $row['forsakring'];
			$_SESSION['test_bussbiljett'] = $row['bussbiljett'];
			$_SESSION['test_langning'] = $row['langning'];
					
			if ($diplom >= $_SESSION['test_diplom'] and $forsakring >= $_SESSION['test_forsakring'] and $bussbiljett >= $_SESSION['test_bussbiljett'] and $langning >= $_SESSION['test_langning']){
				$sql = "UPDATE tillval_mtb SET diplom='$diplom', forsakring='$forsakring', bussbiljett='$bussbiljett', langning='$langning' WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'";
				$result = mysqli_query($dbc, $sql);
		
				echo "<script type='text/javascript'>  window.location='betala.php'; </script>";	
			}
				
			else if ($diplom < $_SESSION['test_diplom'] and $forsakring < $_SESSION['test_forsakring'] and $bussbiljett < $_SESSION['test_bussbiljett'] and $langning < $_SESSION['test_langning']) {		
				echo "<script type='text/javascript'>alert('Du kan tyvärr inte nedgradera dina tillval till din loppbokning.')</script>";
				echo "<script type='text/javascript'>  window.location='my_page.php'; </script>";
			}
		}
	}
		
	else if($lopp == '2'){
		foreach($dbc->query("SELECT * FROM tillval_lop WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'") as $row){
			$_SESSION['test_diplom'] = $row['diplom'];
			$_SESSION['test_forsakring'] = $row['forsakring'];
			$_SESSION['test_bussbiljett'] = $row['bussbiljett'];
			$_SESSION['test_langning'] = $row['langning'];
		
			if ($diplom >= $_SESSION['test_diplom'] and $forsakring >= $_SESSION['test_forsakring'] and $bussbiljett >= $_SESSION['test_bussbiljett'] and $langning >= $_SESSION['test_langning']){
				$sql2 = "UPDATE tillval_lop SET diplom='$diplom', forsakring='$forsakring', bussbiljett='$bussbiljett', langning='$langning' WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'";
				$result2 = mysqli_query($dbc, $sql2);
				echo "<script type='text/javascript'>  window.location='betala.php'; </script>";
			}
			
			else if ($diplom < $_SESSION['test_diplom'] and $forsakring < $_SESSION['test_forsakring'] and $bussbiljett < $_SESSION['test_bussbiljett'] and $langning < $_SESSION['test_langning']) {
				echo "<script type='text/javascript'>alert('Du kan tyvärr inte nedgradera dina tillval till din loppbokning.')</script>";
				echo "<script type='text/javascript'>  window.location='my_page.php'; </script>";
			}
		}
	}	
	
	else{
		foreach($dbc->query("SELECT * FROM tillval_skidor WHERE kundnr = '$kundnr1' AND ordningsnr = '$ordningsnr'") as $row){
			$_SESSION['test_diplom'] = $row['diplom'];
			$_SESSION['test_forsakring'] = $row['forsakring'];
			$_SESSION['test_bussbiljett'] = $row['bussbiljett'];
			$_SESSION['test_langning'] = $row['langning'];
			$_SESSION['test_valla'] = $row['valla'];
		
				if ($diplom >= $_SESSION['test_diplom'] and $forsakring >= $_SESSION['test_forsakring'] and $bussbiljett >= $_SESSION['test_bussbiljett'] and $langning >= $_SESSION['test_langning'] and $valla >= $_SESSION['test_valla']){
					$sql3 = "UPDATE tillval_skidor SET diplom = '$diplom', forsakring =  '$forsakring', bussbiljett = '$bussbiljett', valla = '$valla', langning = '$langning' WHERE kundnr = '$kundnr1' and ordningsnr = '$ordningsnr'";
					$result3 = mysqli_query($dbc, $sql3);
					echo "<script type='text/javascript'>  window.location='betala_skidor.php'; </script>";		
				}
				
				else if ($diplom < $_SESSION['test_diplom'] and $forsakring < $_SESSION['test_forsakring'] and $bussbiljett < $_SESSION['test_bussbiljett'] and $langning < $_SESSION['test_langning'] and $valla < $_SESSION['test_valla']) {
							
						echo "<script type='text/javascript'>alert('Du kan tyvärr inte nedgradera dina tillval till din loppbokning.')</script>";
						echo "<script type='text/javascript'>  window.location='my_page.php'; </script>";
				}
			}
		}
	}
	}

echo "<input class='submit' type='submit'>";
echo "</form>";
echo "</center>";
echo "<br>";
echo "<br>";
echo "<h2>Sälj din biljett</h2>";
echo "<br>";
echo "<center><form method = 'post'>";
	echo "<select id ='dropdown' name='del_val'>";
	echo "<option value='1'>MTB</option>";
	echo "<option value='2'>Löpning</option>";
	echo "<option value='3'>Skidor</option>";
	echo "</select><br>";
	echo "<br>";
	echo "Ordningsnr <br><input type='text' name='del_ord' class='input' value=''><br>";
	echo "Startnr <br><input type='text' name='del_start' class='input' value=''><br>";

	echo "<input type='submit'>";
	echo "</center>";
	
	if(isset($_POST['del_val'])){
	$del_val1 = $_POST['del_val'];
	$del_startnr1 = $_POST['del_start'];
	$ordningsnr = $_POST['del_ord'];
		if($del_val1 == '1'){
			$sql = "DELETE FROM loppanmalan_mtb WHERE kundnr= '$kundnr1' and ordningsnr='$ordningsnr' and startnr='$del_startnr1'";
			$result = mysqli_query($dbc, $sql);
			echo "<script type='text/javascript'>window.location='my_page.php';</script>";
		}
		
		else if ($del_val1 =='2'){
			$sql = "DELETE FROM loppanmalan_lop WHERE kundnr='$kundnr1' and ordningsnr='$ordningsnr' and startnr='$del_startnr1'";
			$result = mysqli_query($dbc, $sql);
			echo "<script type='text/javascript'>window.location='my_page.php';</script>";
		}
		
		else {
			$sql ="DELETE FROM loppanmalan_skidor WHERE kundnr='$kundnr1' and ordningsnr='$ordningsnr' and startnr='$del_startnr1'";
			$result = mysqli_query($dbc, $sql);
			echo "<script type='text/javascript'>window.location='my_page.php';</script>";
		}
	}

echo "</form>";


?>
</div>
<div id="feedback" class="tabcontent">
<div class="content">
	<h1>Feedbackformulär för genomfört lopp</h1><br>
	<div class="main">
	<!-- action="testmodul.html"-->
		<form method="post">

		 <?php
		// $input = $_POST['value'];
		//session_start();
		$pdo = new PDO('mysql:dbname=skidloppet_AB1;host=localhost;charset=utf8', 'sqllab', 'Tomten2009'); #databasens namn i SQL
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,false);
		echo '<select required id="dropdown" name="drop">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj lopp här</option>';
		foreach ($pdo->query ('SELECT * FROM loplopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['typ']. " - " .$row['namn']." - " .$row['distans'];
			echo '</option>';
		}
		foreach ($pdo->query ('SELECT * FROM skidlopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['typ']. " - " .$row['namn']." - " .$row['distans'];
			echo '</option>';
		}
		foreach ($pdo->query ('SELECT * FROM mtblopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['typ']. " - " .$row['namn']." - " .$row['distans'];
			echo '</option>';
		}
		
		echo "</select>"; #dropdownmenyn i php	
		// $_SESSION['choosenLopp'] = $row['namn']; 
		?><br>

		<br> <h5>Vad tyckte du loppet?</h5>
			<div class="radio-btns">
					<div class="swit">								
						<div class="check_box_one"> <div class="radio"> <label><input type="radio" name="radio" value="Mycket missnöjd"><i></i>Mycket missnöjd</label> </div></div>
                        <div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" value="Missnöjd"><i></i>Missnöjd</label> </div></div>
						<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" value="Nöjd"><i></i>Nöjd</label> </div></div>
						<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" value="Mycket nöjd" checked=""><i></i>Mycket nöjd</label> </div></div>
						<div class="clear"></div>
					</div>
			</div>
			<br>	
		<h5> Hur stor är sannolikheten att du kommer delta igen?</h5>
			<div class="radio-btns">
					<div class="swit">								
						<div class="check_box_one"> <div class="radio1"> <label><input type="radio" name="radio1" value="Mycket missnöjd"><i></i>Mycket missnöjd</label> </div></div>
                        <div class="check_box"> <div class="radio1"> <label><input type="radio" name="radio1" value="Missnöjd"><i></i>Missnöjd</label> </div></div>
						<div class="check_box"> <div class="radio1"> <label><input type="radio" name="radio1" value="Nöjd"><i></i>Nöjd</label> </div></div>
						<div class="check_box"> <div class="radio1"> <label><input type="radio" name="radio1" value="Mycket nöjd" checked=""><i></i>Mycket nöjd</label> </div></div>
						<div class="clear"></div>
					</div>
			</div>
			<br>
		<h5>Tyckte du evenemangets var välstrukturerat?</h5>
			<div class="radio-btns">
					<div class="swit">								
						<div class="check_box_one"> <div class="radio2"> <label><input type="radio" name="radio2" value="Mycket missnöjd" ><i></i>Mycket missnöjd</label> </div></div>
                        <div class="check_box"> <div class="radio2"> <label><input type="radio" name="radio2" value="Missnöjd"><i></i>Missnöjd</label> </div></div>
						<div class="check_box"> <div class="radio2"> <label><input type="radio" name="radio2" value="Nöjd"><i></i>Nöjd</label> </div></div>
						<div class="check_box"> <div class="radio2"> <label><input type="radio" name="radio2" value="Mycket nöjd" checked=""><i></i>Mycket nöjd</label> </div></div>
						<div class="clear"></div>
					</div>
			</div>
			<br>
		<h5>Vad tyckte du om tillvalen?</h5>
			<div class="radio-btns">
					<div class="swit">								
						<div class="check_box_one"> <div class="radio3"> <label><input type="radio" name="radio3" value="Mycket missnöjd"><i></i>Mycket missnöjd</label> </div></div>
                        <div class="check_box"> <div class="radio3"> <label><input type="radio" name="radio3" value="Missnöjd"><i></i>Missnöjd</label> </div></div>
						<div class="check_box"> <div class="radio3"> <label><input type="radio" name="radio3" value="Nöjd"><i></i>Nöjd</label> </div></div>
						<div class="check_box"> <div class="radio3"> <label><input type="radio" name="radio3" value="Mycket nöjd" checked=""><i></i>Mycket nöjd</label> </div></div>
						<div class="clear"></div>
					</div>
			</div>
			<br>
			<h5>Något annat att tillägga som kan hjälpa oss att förbättra evenemanget? </h5><br>
				<textarea rows="8" cols="62" name="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}">Skriv här</textarea>
				<br><br>
				<input type="submit" value="Skicka formulär">
		</form>
	</div>
	
</div>
<?php
	//include("connection.php");
	
// if (isset($_POST['Skicka formulär'])) {
	// $q1=$_POST['radio']; 
	// $q1=$_POST['radio1']; 
	// $q1=$_POST['radio2']; 
	// $q1=$_POST['radio3']; 
	// $q1=$_POST['radio4'];
	// $q1=$_POST['text']; 
	// $q1=$_POST['drop']; 
	// }
	if(isset($_POST['drop'])){
	$q1 = $_POST['radio'];
	$q2 = $_POST['radio1'];
	$q3 = $_POST['radio2'];
	$q4 = $_POST['radio3'];
	$q5 = $_POST['text'];
	$q6 = $_POST['drop'];
	
	
	
	if(isset($q1)){
		$sql = "INSERT INTO feedback(fraga_1,fraga_2,fraga_3,fraga_4,kommentar,lopp) VALUES('$q1','$q2','$q3','$q4','$q5','$q6')";
		//var_dump($sql);
		$result = mysqli_query($dbc,$sql);
		//var_dump($result);
	}	
	}
?>
</div>
</div>
</body>
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
document.getElementById("defaultOpen").click();
</script>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>
</html>