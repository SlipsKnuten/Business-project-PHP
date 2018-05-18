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
	<li class="navliback"><a class="navcontentback" href="back_office_deltagare.php">Loppdeltagare</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_admin.php">Admin</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_feedback.php">Feedback</a></li>
	<li class="navliback"><a class="navcontentback" href="back_office_logout.php">Logga ut </a></li>
</ul>
</header>




<div id="wrapper_tillval_backoffice" class="col-12-m">
<br>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et tellus purus. Pellentesque tristique mi vel tincidunt tincidunt. Sed et tellus nec nibh bibendum luctus vel sed turpis. Curabitur orci mauris, auctor sed pharetra ut, laoreet quis eros. Pellentesque lorem tortor, commodo et odio nec, lacinia aliquam arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec ultrices cursus lacus, non viverra arcu convallis in. Duis dui lacus, interdum non erat ac, tincidunt sagittis leo. Cras ac orci non nunc euismod pretium sit amet eget ante. Proin pellentesque sed lorem sit amet convallis. Aenean sit amet tortor pulvinar, elementum neque at, consectetur massa. Praesent id felis at sem ultricies mollis. Praesent congue pellentesque metus, in accumsan nisl venenatis non. Vestibulum sit amet volutpat urna, vel fermentum purus. Quisque tristique nisi nec est rutrum feugiat.
Integer semper velit ipsum, ut malesuada metus imperdiet condimentum. Etiam pellentesque ex vitae diam vulputate, non vestibulum nisi imperdiet. 

Mauris in convallis lorem. Vestibulum lacinia fermentum elit fermentum sodales. Vestibulum quis massa finibus, tincidunt urna ac, vestibulum magna. Phasellus non lorem eu elit condimentum facilisis at vel ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vestibulum quis lectus at molestie.
In hac habitasse platea dictumst. Maecenas ipsum urna, porttitor vel sodales ultricies, auctor a enim. Proin ut porttitor felis. Nullam blandit finibus arcu vitae egestas. Etiam nec sagittis ligula, sed maximus neque. Integer id leo eget ex ultrices luctus ut sed ligula. Donec feugiat placerat sapien, id finibus velit fringilla eu. Nulla ornare accumsan nulla in congue. Vestibulum molestie tincidunt elit eget tristique. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed ut tellus nibh. Aenean vitae cursus massa. Sed sit amet enim metus. Nunc id tempor nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Praesent non scelerisque dolor. 

Suspendisse scelerisque, diam vel dignissim ultrices, lorem odio laoreet lorem, at vehicula quam augue vel justo. Donec vehicula laoreet semper. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus consectetur imperdiet rhoncus. Vestibulum varius sem et massa dapibus, quis sollicitudin metus pulvinar. Donec rutrum porttitor quam vel auctor. Quisque euismod sit amet arcu imperdiet tincidunt. Duis vitae feugiat massa, nec pulvinar urna. Proin vitae nisi tincidunt, molestie quam quis, tempor ante. Donec nec nunc quis enim consectetur cursus malesuada in leo. Aliquam sagittis tristique suscipit. Nulla placerat orci massa, sit amet suscipit purus dictum quis. Nulla tempus ipsum at iaculis finibus. Donec elementum mauris sed eros tincidunt fringilla. Fusce a suscipit enim.
Pellentesque egestas volutpat sem, vel convallis mauris gravida placerat. Nam ut vulputate nibh, nec tempor ipsum. Maecenas efficitur facilisis sodales. Vestibulum id convallis felis. Integer sodales lacus mollis sapien porta mollis. Nulla maximus dapibus tellus, sed convallis enim condimentum in. Aliquam erat volutpat. Morbi id turpis vel odio hendrerit molestie. Nam ac nibh sit amet nisl suscipit lacinia at in tellus. Nulla luctus, nibh id mollis volutpat, lorem quam aliquet tortor, congue interdum urna libero sed neque. Duis dignissim sed urna eget tempor. Ut commodo accumsan vestibulum. Pellentesque sed augue at dui dictum placerat et et nisi. Nulla sit amet sapien et nisl ornare iaculis.
Generated 5 par</p>
<br>

<?php
include("connection.php");
session_start();
	if (isset ($_SESSION['logged_in'])){
		$name = $_SESSION['userInfo'];
	}
		
	if (isset ($_SESSION['hashed_pw'])){
		$pw = $_SESSION['hashed_pw'];
	} 
?>
</div>
</body>
<footer>
<br><br>
Skidloppet AB Box 312 770 76 Hedemora || info@skidloppetab.com || Tel: 0500 - 666 66
</footer>

</html>	