<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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




<div id="wrapper_backoffice"><br>
<h1 id="header"> Statistik för tillval skidlopp</h1><br>


	<!-- action="testmodul.html"-->

<?php
$ordningsnr = "";
include ("connection.php");
		// $input = $_POST['value'];
		session_start();
		$pdo = new PDO('mysql:dbname=skidloppet_AB;host=localhost;charset=utf8', 'sqllab', 'Tomten2009'); #databasens namn i SQL
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,false);
						$usr = $_SESSION['logged_in'];
	if($usr != true){
		echo "<script type='text/javascript'>alert('Du måste vara inloggad')</script>";
		echo "<script type='text/javascript'>window.location='back_office_login.php';</script>";
	}
		
		echo "<center><form method='POST'>";
		echo '<select required id="dropdown" name="ordningsnr">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Skidlopp - Loppnamn - Distans - Klubbkrav</option>';
		foreach ($pdo->query ('SELECT * FROM skidlopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['typ']. " - " .$row['namn']." - " .$row['distans']." - ".$row['klubbkrav'];
				// $ordningsnr = $row['ordningsnr'];
			echo '</option>';
			echo '</center>';
		}
		
		
		
		// echo $ordningsnr;
		echo "</select>"; #dropdownmenyn i php
		echo "<button class='BO_valjknapp' type='submit'>Välj</button>";
		// $_SESSION['choosenLopp'] = $row['namn']; 
		echo "</form>";
		// print_r($_POST);
		if(isset($_POST['ordningsnr'])){
		$ordningsnr = $_POST['ordningsnr'];
		// echo $ordningsnr;
		}
		echo "<br>";
			echo "<table class='tabell'>";
			echo "<th colspan='3'>Valla</th>"; 
			echo "<tr>";

			echo "<th class='tabellrad'>Tillvalstyp</th>";
			echo "<th class='tabellrad'>Pris</th>";
			echo "<th class='tabellrad'>Antal sålda</th>";
			$valla = array();
			$i='0';
			$x='0';
			$_SESSION['valla_' . $x] = 0;
			$x='1';
			$_SESSION['valla_' . $x] = 0;
			$x='2';
			$_SESSION['valla_' . $x] = 0;
			$x='3';
			$_SESSION['valla_' . $x] = 0;
			$x='4';
			$_SESSION['valla_' . $x] = 0;
			$x='5';
			$_SESSION['valla_' . $x] = 0;
			$x=0;
//loopen hämtar ut tillvalstypen valla, dess pris och antal sålda enheter. 
		foreach ($dbc->query("SELECT artiklar_valla.namn, artiklar_valla.varde, COUNT(tillval_skidor.valla) as total from artiklar_valla, tillval_skidor WHERE tillval_skidor.valla=artiklar_valla.id AND tillval_skidor.ordningsnr = '$ordningsnr' group by artiklar_valla.id;") as $row) {
			echo "<tr>";
				echo "<td class='tabellinfo'>".$row['namn']."</td>";
				echo "<td class='tabellinfo'>".$row['varde']."</td>";
				echo "<td class='tabellinfo'>".$row['total']."</td>";
				$valla[$i]=$row['total'];
				$_SESSION['valla_' . $x]=$valla[$i];
				$i++;
				$x++;
				
			echo "</tr>";
			}
			echo"</table>";
			// print_r($_SESSION);
					
			echo "<br>";
		?>
		<canvas id='tillval_diagram_valla';></canvas>
		

		<?php
		echo "<table class='tabell'>";
		echo "<th colspan='3'>Langning</th>"; 
		echo "<tr>";

		echo "<th class='tabellrad'>Tillvalstyp</th>";
		echo "<th class='tabellrad'>Pris</th>";
		echo "<th class='tabellrad'>Antal sålda</th>";
		echo "</tr>";

			$langning = array();
			$a='0';
			$b='0';
			$_SESSION['langning_' . $b] = 0;
			$b='1';
			$_SESSION['langning_' . $b] = 0;
			$b='2';
			$_SESSION['langning_' . $b] = 0;
			$b='0';		
//loopen hämtar ut tillvalstypen langning, dess pris och antal sålda enheter. 
		foreach ($dbc->query("SELECT artiklar_langning.namn, artiklar_langning.varde, COUNT(tillval_skidor.langning) as total from artiklar_langning, tillval_skidor where tillval_skidor.langning=artiklar_langning.id AND tillval_skidor.ordningsnr = '$ordningsnr' group by artiklar_langning.id;") as $row) {
			echo "<tr>";
				echo "<td class='tabellinfo'>".$row['namn']."</td>";
				echo "<td class='tabellinfo'>".$row['varde']."</td>";
				echo "<td class='tabellinfo'>".$row['total']."</td>";
				$langning[$a]=$row['total'];
				$_SESSION['langning_' . $b]=$langning[$a];
				$a++;
				$b++;
			echo "</tr>";
		}
		echo "</table>";
		
		
		?>
		<canvas id='tillval_diagram-langning';></canvas>
			
<?php		
echo "<br>";
echo "<table class='tabell'>";
echo "<th colspan='3'>Diplom</th>"; 
echo "<tr>";
	echo "<th class='tabellrad'>Tillvalstyp</th>";
	echo "<th class='tabellrad'>Pris</th>";
	echo "<th class='tabellrad'>Antal sålda</th>";
echo "</tr>";

			$diplom = array();
			$c='0';
			$d='0';
			$_SESSION['diplom_' . $d] = 0;
			$d='1';
			$_SESSION['diplom_' . $d] = 0;
			$d='2';
			$_SESSION['diplom_' . $d] = 0;
			$d='3';
			$_SESSION['diplom_' . $d] = 0;
			$d='0';
//loopen hämtar ut tillvalstypen diplom, dess pris och antal sålda enheter. 
		foreach ($dbc->query("SELECT artiklar_diplom.namn, artiklar_diplom.varde, COUNT(tillval_skidor.diplom) as total from artiklar_diplom, tillval_skidor where tillval_skidor.diplom=artiklar_diplom.id AND tillval_skidor.ordningsnr = '$ordningsnr' group by artiklar_diplom.id;") as $row) {
			echo "<tr>";
				echo "<td class='tabellinfo'>".$row['namn']."</td>";
				echo "<td class='tabellinfo'>".$row['varde']."</td>";
				echo "<td class='tabellinfo'>".$row['total']."</td>";
				$diplom[$c]=$row['total'];
				$_SESSION['diplom_' . $d]=$diplom[$c];
				$c++;
				$d++;
			echo "</tr>";
}

		echo"</table>";
		?>
		<canvas id='tillval_diagram-diplom';></canvas>
		<?php
		echo "<br>";
		
echo "<table class='tabell'>";
echo "<th colspan='3'>Försäkring</th>"; 
echo "<tr>";
	echo "<th class='tabellrad'>Tillvalstyp</th>";
	echo "<th class='tabellrad'>Pris</th>";
	echo "<th class='tabellrad'>Antal sålda</th>";
echo "</tr>";

			$forsakring = array();
			$e='0';
			$f='0';
			$_SESSION['forsakring_' . $f] = 0;
			$f='1';
			$_SESSION['forsakring_' . $f] = 0;
			$f='0';
//loopen hämtar ut tillvalstypen Försäkring, dess pris och antal sålda enheter. 
foreach ($dbc->query("SELECT artiklar_forsakring.namn, artiklar_forsakring.varde, COUNT(tillval_skidor.forsakring) as total from artiklar_forsakring, tillval_skidor where tillval_skidor.forsakring=artiklar_forsakring.id AND tillval_skidor.ordningsnr = '$ordningsnr' group by artiklar_forsakring.id;") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo "<td class='tabellinfo'>".$row['total']."</td>";
			$forsakring[$e]=$row['total'];
			$_SESSION['forsakring_' . $f]=$forsakring[$e];
			$e++;
			$f++;
		
		echo "</tr>";
}
		echo"</table>";
		?>
		<canvas id='tillval_diagram-forsakring';></canvas>
		<?php
		
		echo "<br>";

		echo "<table class='tabell'>";
echo "<th colspan='3'>Bussbiljett</th>"; 
echo "<tr>";

echo "<th class='tabellrad'>Tillvalstyp</th>";
echo "<th class='tabellrad'>Pris</th>";
echo "<th class='tabellrad'>Antal sålda</th>";
echo "</tr>";

			$biljett = array();
			$g='0';
			$h='0';
			$_SESSION['biljetter' . $h] = 0;
			$h='1';
			$_SESSION['biljetter_' . $h] = 0;
			$h='0';


//loopen hämtar ut tillvalstypen Bussbiljett, dess pris och antal sålda enheter. 
foreach ($dbc->query("SELECT artiklar_biljett.namn, artiklar_biljett.varde, COUNT(tillval_skidor.bussbiljett) as total from artiklar_biljett, tillval_skidor where tillval_skidor.bussbiljett=artiklar_biljett.id AND tillval_skidor.ordningsnr = '$ordningsnr' group by artiklar_biljett.id;") as $row) {
		echo "<tr>";
			echo "<td class='tabellinfo'>".$row['namn']."</td>";
			echo "<td class='tabellinfo'>".$row['varde']."</td>";
			echo "<td class='tabellinfo'>".$row['total']."</td>";
			$biljett[$g]=$row['total'];
			$_SESSION['biljetter_' . $h]=$biljett[$g];
			$g++;
			$h++;
		
		echo "</tr>";
}

echo"</table>";
?>

<canvas id='tillval_diagram-biljett';></canvas>
<?php

echo "<br>";


?>

<script>
		var ctx = document.getElementById('tillval_diagram_valla').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',
		

		// The data for our dataset
		data: {
        labels: ["Ingen Valla", "Glidvallning, LF", "Glidvallning HF", "Vallning LF", "Vallning HF", "Värsting"],
        datasets: [{
            label: "Sålda vallningspaket",
            backgroundColor: ["#587092", "#6f8eba", "#90b3e5", "#7fa7e0", "#a1c3f4", "#97abc9"],
            borderColor: '#587092',
            
			data: [<?php 
			echo $_SESSION['valla_0'] . ",";
			echo $_SESSION['valla_1'] . ",";
			echo $_SESSION['valla_2'] . ",";
			echo $_SESSION['valla_3'] . ",";
			echo $_SESSION['valla_4'] . ",";
			echo $_SESSION['valla_5'] . ",";
			?>
			],
        }]
		},

		// Configuration options go here
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
						}
						}]
					}
			
				}
		});
		</script>


<script>
		var ctx = document.getElementById('tillval_diagram-langning').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',

		// The data for our dataset
		data: {
        labels: ["Ingen", "Proffs", "Björn"],
        datasets: [{
            label: "Sålda langningspaket",
            backgroundColor: ["#587092", "#6f8eba", "#90b3e5"],
            borderColor: '#587092',
            
			data: [<?php 
			echo $_SESSION['langning_0'] . ",";
			echo $_SESSION['langning_1'] . ",";
			echo $_SESSION['langning_2'] . ",";
			?>
			],
        }]
		},

		// Configuration options go here
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
						}
						}]
					}
			
				}
		
		});
		</script>
		
		<script>
		var ctx = document.getElementById('tillval_diagram-diplom').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',

		// The data for our dataset
		data: {
        labels: ["Ingen", "Utan", "Björkram", "Ekram"],
        datasets: [{
            label: "Sålda diplom",
            backgroundColor: ["#587092", "#6f8eba", "#90b3e5", "#7fa7e0"],
            borderColor: '#587092',
            
			data: [<?php 
			echo $_SESSION['diplom_0'] . ",";
			echo $_SESSION['diplom_1'] . ",";
			echo $_SESSION['diplom_2'] . ",";
			echo $_SESSION['diplom_3'] . ",";
			
			?>
			],
        }]
		},

		// Configuration options go here
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						steps: 1,
						stepValue: 60
						}
						}]
					}
			
				}
		});
		
		</script>
		
		<script>
		var ctx = document.getElementById('tillval_diagram-forsakring').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',

		// The data for our dataset
		data: {
        labels: ["Ingen", "Sålda"],
        datasets: [{
            label: "Sålda försäkringar",
            backgroundColor: ["#587092", "#6f8eba"],
            borderColor: '#587092',
            
			data: [<?php 
			echo $_SESSION['forsakring_0'] . ",";
			echo $_SESSION['forsakring_1'] . ",";
			?>
			],
        }]
		},

		// Configuration options go here
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
						}
						}]
					}
			
				}
		});
		</script>
		
		<script>
		var ctx = document.getElementById('tillval_diagram-biljett').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',

		// The data for our dataset
		data: {
        labels: ["Ingen", "Sålda"],
        datasets: [{
            label: "Sålda biljetter",
            backgroundColor: ["#587092", "#6f8eba"],
            borderColor: '#587092',
            
			data: [<?php 
			echo $_SESSION['biljetter_0'] . ",";
			echo $_SESSION['biljetter_1'] . ",";
			?>
			],
        }]
		},

		// Configuration options go here
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
						}
						}]
					}
			
				}
		});
		</script>

</div>
</body>
<footer>  
<br><br> 
Skidloppet AB Box 312 77076 Hedemora || info@skidloppetab.com || 0500-66666	
	
 </footer>
</html>
tml>
| 0500-66666	
	
 </footer>
</html>
