<?php
	DEFINE("SERVER","localhost");
	DEFINE("USER","gz_pristup");
	DEFINE("PASS","mt110511");
	DEFINE("DATABASE","guitarzoom");
	
	$conn = mysqli_connect(SERVER, USER, PASS, DATABASE) OR die('Database connection error!:\n'.mysqli_connect_error());
?>
