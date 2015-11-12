<?php
	$host = "localhost";
	$user = "b130359cs";
	$pass = "b130359cs";
	$db = "db_b130359cs";
	
	$conn = new mysqli($host, $user, $pass, $db);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>