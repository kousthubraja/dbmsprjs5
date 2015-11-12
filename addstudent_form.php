<?php

	session_start();
	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";
	
	if($_SESSION["user"] != "admin"){
		die("Unauthorized!");
	}
?>

<html>
 <head><link rel='stylesheet' type='text/css' href='des1.css' /></head>
<body>
	<h3>Add Student</h3>
	<form action="addstudent.php">
		Roll No : <input type="text" name="Roll_No" required></br>
		Name : <input type="text" name="Name" required></br>
		DOB : <input type="text" name="DOB" required></br>
		Address : <input type="text" name="Address" required></br>
		Sex : <input type="text" name="Sex" required></br>
		YOJ : <input type="text" name="YOJ" required></br>
		Guardian : <input type="text" name="Guardian" required></br>
		Phone : <input type="text" name="Phone" required></br>
		Guardian Phone : <input type="text" name="Guardian_Phone" required></br>
		Blood Group : <input type="text" name="Blood_Group" required></br>
		
		<input type="submit">
	</form>
</body>
</html>