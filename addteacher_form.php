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
	<form action="addteacher.php">
		Teacher ID : <input type="text" name="TID" required></br>
		Name : <input type="text" name="TName" required></br>
		DOB : <input type="text" name="DOB" required></br>
		Sex : <input type="text" name="Sex" required></br>
		Dept : <input type="text" name="Dept" required></br>
		Designation : <input type="text" name="Designation" required></br>
		Qualification : <input type="text" name="Qualification" required></br>
		
		<input type="submit">
	</form>
</body>
</html>