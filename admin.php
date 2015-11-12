<?php

session_start();
	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";


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

<a href="addcourse_form.php">Add course</a></br>
<a href="addstudent_form.php">Add student</a></br>
<a href="addteacher_form.php">Add teacher</a></br>

<a href="logout.php">Logout</a>
