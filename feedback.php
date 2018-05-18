<!DOCTYPE html>
<html>
<head>
<title>Feedback efter lopp</title>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Feedback Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Amaranth:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Josefin+Slab:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href="css/feedbackstyle.css" rel="stylesheet" type="text/css" media="all" />
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
</style>
</head>
<body>
<div class="content">
	<h1>Feedbackformulär för genomfört lopp</h1>
	<div class="main">
	<!-- action="testmodul.html"-->
		<form method="post">

		 <?php
		// $input = $_POST['value'];
		session_start();
		$pdo = new PDO('mysql:dbname=skidloppet_AB;host=localhost', 'sqllab', 'Tomten2009'); #databasens namn i SQL
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,false);
		echo '<select required id="dropdown" name="drop">';  // Här hämtas ID för dropdown-menyn (färger, fonts mm.)
		echo '<option value="">Välj lopp här</option>';
		foreach ($pdo->query ('SELECT * FROM lopp') as $row){
			echo '<option value="'.$row['ordningsnr'].'">';
				echo $row['typ']. " - " .$row['namn']." - " .$row['distans'];
			echo '</option>';
		}
		
		echo "</select>"; #dropdownmenyn i php	
		// $_SESSION['choosenLopp'] = $row['namn']; 
		?><br>

		<br> <h5>Vad tyckte du om loppet?</h5>
			<div class="radio-btns">
					<div class="swit">								
						<div class="check_box_one"> <div class="radio"> <label><input type="radio" name="radio" value="Mycket missnöjd"><i></i>Mycket missnöjd</label> </div></div>
                        <div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" value="Missnöjd"><i></i>Missnöjd</label> </div></div>
						<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" value="Nöjd"><i></i>Nöjd</label> </div></div>
						<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" value="Mycket nöjd" checked=""><i></i>Mycket nöjd</label> </div></div>
						<div class="clear"></div>
					</div>
			</div>
				
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

			<h5>Något annat att tillägga som kan hjälpa oss att förbättra evenemanget? </h5>	
				<textarea name="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}">Skriv här</textarea>

				<input type="submit" value="Skicka formulär">
		</form>
	</div>
	
</div>
<?php
	//include("connection.php");
	
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
?>



</body>
</html>