<?php
	require_once("connect.php");
	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";
	
	$Roll_No = $_GET['Roll_No'];
	$Name = $_GET['Name'];
	$DOB = $_GET['DOB'];
	$Address = $_GET['Address'];
	$Sex = $_GET['Sex'];
	$YOJ = $_GET['YOJ'];
	$Guardian = $_GET['Guardian'];
	$Phone = $_GET['Phone'];
	$Guardian_Phone = $_GET['Guardian_Phone'];
	$Blood_Group = $_GET['Blood_Group'];
	//$Spass = $_GET['Spass'];
	$Spass = $Roll_No;
	
	if(empty($Roll_No) || empty($Name) || empty($DOB) || empty($Address) || empty($Sex) || empty($YOJ) || empty($Guardian) || empty($Phone) || empty($Guardian_Phone))
		die("Enter all fields");
	
	$sql = "INSERT INTO `db_b130359cs`.`Student` VALUES('$Roll_No', '$Name', '$DOB', '$Address', '$Sex', '$YOJ', '$Guardian', '$Phone', '$Guardian_Phone', '$Blood_Group', '$Spass');";
	
	echo $sql;
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
?>