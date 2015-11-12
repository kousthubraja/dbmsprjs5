<?php

	session_start();
	require_once("connect.php");

	if($_SESSION["user"] != "admin"){
		die("Unauthorized!");
	}

	if(isset($_POST['due'])){
		$Roll_No = $_POST['Roll_No'];
		$due = $_POST['due'];

		$sql = "UPDATE Hostel_Dues SET Dues = Dues + $due WHERE Roll_No = '$Roll_No'";
		if($conn -> query($sql) === True){
			echo "Due updated for $Roll_No";
		}
		else{
			echo "Error";
		}

		die();
	}
?>

<html>
<body>
	<h3>Hostel Dues Entry</h3>
	<form method="POST">
			Roll No : <input type="text" name="Roll_No" required></br>
			Dues : <input type="number" name="due" required></br>
		<input type="submit" value="Enter Dues">
	</form>
</body>
</html>
