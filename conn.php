<?php
	clearstatcache();
	date_default_timezone_set("ASIA/DHAKA");
	$server = "localhost";
	$username = "root";
	$password = "root";
	$db = "sj";
	$conn = mysqli_connect($server,$username,$password);
	
	
	$conn = new mysqli($server, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
?>