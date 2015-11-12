<?php
	require_once("connect.php");
	
	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";
	$TID = $_GET['TID'];
	$TName = $_GET['TName'];
	$DOB = $_GET['DOB'];
	$Sex = $_GET['Sex'];
	$Dept = $_GET['Dept'];
	$Designation = $_GET['Designation'];
	$Qualification = $_GET['Qualification'];
	$Tpass = $TID;
	
	if(empty($TID) || empty($TName) || empty($DOB) || empty($Dept) || empty($Sex) || empty($Designation) || empty($Qualification))
		die("Enter all fields");
	
	$sql = "INSERT INTO `db_b130359cs`.`Teacher` VALUES('$TID', '$TName', '$Sex', '$DOB', '$Dept',  '$Designation', '$Qualification', '$Tpass');";
	
	echo $sql;
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
?>