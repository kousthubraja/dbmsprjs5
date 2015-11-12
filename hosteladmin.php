<?php

session_start();

  $username = $_POST['u'];
  $password = $_POST['p'];

  if(($username != 'admin' || $password != 'pwd') && $_SESSION["user"] != "admin")
	  die("Unauthorized!");
//    header("Location:adminlogin.html");


  $_SESSION["user"] = "admin";
?>

<?php
  echo "<h3>Welcome admin</h3>";
?>

<a href="enter_hostel_dues.php">Enter dues</a></br>

<a href="logout.php">Logout</a>
