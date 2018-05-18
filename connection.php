<?php
	DEFINE ('DB_USER', 'sqllab');
	DEFINE ('DB_PASSWORD', 'Tomten2009');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'skidloppet_AB1');

	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
	$dbc -> set_charset("utf8");
?>

