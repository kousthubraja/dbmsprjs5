<?php
  session_start();
  	 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";


  $username = $_POST['u'];
  $password = $_POST['p'];

  if($username != 'admin' || $password != 'pwd')
    header("Location:adminlogin.html");


  $_SESSION['user'] = 'admin';
  header("Location:admin.php");

?>
