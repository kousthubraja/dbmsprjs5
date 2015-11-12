<?php
	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";
	session_start();
	
	if($_SESSION["user"] != "admin"){
		die("Unauthorized!");
	}
?>

<html>
<head> <link rel='stylesheet' type='text/css' href='des1.css' /></head>
<body>
	<h3>Add Student</h3>
	<form action="addstudent.php">
		Course ID : <input type="text" name="CID" required></br>
		Course Name : <input type="text" name="CName" required></br>
		Department : <input type="text" name="Dept" required></br>
		Semester : <input type="text" name="Semester" required></br>
		Is Core? : <input type="text" name="Core" required></br>
		Teacher 1 : <input type="text" name="TID1" required></br>
		Teacher 2 : <input type="text" name="TID2" required></br>
		Credit : <input type="text" name="Credit" required></br>
		Is Theory? : <input type="text" name="Guardian_Phone" required></br>
		
		<input type="submit">
	</form>
</body>
</html>