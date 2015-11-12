<?php
	require_once("connect.php");
	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";
	
	$CID = $_GET['CID'];
	$CName = $_GET['CName'];
	$Dept = $_GET['Dept'];
	$Semester = $_GET['Semester'];
	$Core = $_GET['Core'];
	$TID1 = $_GET['TID1'];
	$TID2 = $_GET['TID2'];
	$Credit = $_GET['Credit'];
	$Theory = $_GET['Theory'];
	
	
	if(empty($CID) || empty($CName) || empty($Dept) || empty($Semester) || empty($Core) || empty($TID1) || empty($TID2) || empty($Credit) || empty($Theory))
		die("Enter all fields");
	
	$sql = "INSERT INTO `db_b130359cs`.`Courses` VALUES('$CID', '$CName', '$Dept', '$Semester', $Core, '$TID1', '$TID2', $Credit, $Theory);";
	
	echo $sql;
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
?>