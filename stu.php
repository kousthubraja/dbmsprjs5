
<?php
//session_start();
require_once("connect.php");
 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";

		if(!isset($_POST['sid'])  || !isset($_POST['sp']))
			die("failed");

		$sid = trim($_POST['sid']);	
		$spass = trim($_POST['sp']);


		if(empty($sid) || empty($spass))
			die("Enter all fields");


echo "<div id='main'>";
	//echo "kkk";
	$sql = "SELECT * FROM Student WHERE Roll_No='$sid' and Spass='$spass'";

	$res = $conn -> query($sql);

	//print_r($res);



		
		if($res->num_rows <= 0)
		{
			die("<h2>Invalid login details</h2>");
		}
	//	setcookie('user',$tid,time()+3600,'/');
	//	echo "SET COOKIE";

		echo "<h1>Welcome</h1>";
		echo "<h3><a href='http://athena.nitc.ac.in/aravind_b130359cs/webproject/index.html'>Log Out</a></h3><h2>PROFILE</h2>";
		//$_SESSION[""]
		
		while($row = $res->fetch_assoc()) 
		{
			echo "<p>Name   : ".$row['Name']."</p><p>DOB      :".$row['DOB']."</p><p>Sem :".$row['Sem']."</p>";
			$sem=$row['Sem'];
			$br=$row['Branch'];
				}
		$due=$conn->query("select * from Hostel_Dues,Library_Dues WHERE Hostel_Dues.Roll_No='$sid' and Hostel_Dues.Roll_No=Library_Dues.Roll_No");
		
		$flg=0;
		while($row=$due->fetch_assoc())
		{
			if($row['Has_Dues']==1)
				{
					echo "<h3>LIBRARY DUES NOT CLEARED</h3>";
					$flg=1;
				}
			else
								
				echo "<h3>LIBRARY DUES CLEARED</h3>";
				

			if($row['Dues']>=0)
				{
					echo "<h3>HOSTEL DUES NOT CLEARED <br> PENDING AMOUNT = Rs".$row['Dues']."</h3>";
					$flg=2;
				}
			else
				echo "<h3>HOSTEL DUES CLEARED</h3>";
		}



	echo "</div>";

echo "<br>Courses completed<br>";
$comp=$conn->query("Select * from Selected_Courses,Courses WHERE Roll_No='$sid' and Selected_Courses.CID = Courses.CID and NOT(Grade='NO')");

echo "<div class='CSSTableGenerator'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>CourseID</td><td>Course Name</td><td>Credit</td><td>Grade</td>";
		echo "</tr>";
		

	while ($row=$comp->fetch_assoc())
		 {
		
		
		echo "<tr>";
		echo "<td>".$row['CID']."</td><td>".$row['CName']."</td><td>".$row['Credit']."</td><td>".$row['Grade']."</td>";
		echo "</tr>";

		}

echo "</table>";	
		echo '</div>';


if($flg!=0)
{
	echo "<H2> YOU ARE NOT ELIGIBLE FOR REGISTRATION <H2>";
	if($flg==2)
	echo "<h3><a href='https://www.onlinesbi.com/prelogin/icollecthome.htm' target='_blank'>CLEAR HOSTEL DUES NOW</a></h3>";
}

else
{

echo "<br>Courses Selected in current Semester<br>";
$comp=$conn->query("Select * from Selected_Courses,Courses WHERE Roll_No='$sid' and Selected_Courses.CID = Courses.CID and Grade='NO'");

echo "<div class='CSSTableGenerator'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>CourseID</td><td>Course Name</td><td>Credit</td><td>Theory/Lab</td><td>Type</td>";
		echo "</tr>";
		

	while ($row=$comp->fetch_assoc())
		 {
		
		
		echo "<tr>";
		echo "<td>".$row['CID']."</td><td>".$row['CName']."</td><td>".$row['Credit']."</td>";
		if($row['Theory']==1)
			echo "<td>Theory</td>";
		else
			echo "<td>Lab</td>";

		if($row['Core']==1)
			echo "<td>Core</td>";
		else
			echo "<td>Elective</td>";
		echo "</tr>";

		}

echo "</table>";	
		echo '</div>';


			
//OPTION
	//echo "SELECT CID,CName FROM courses WHERE TID1='$tid' or  TID2='$tid'";
	


		//echo "sSELECT CID,CName,Credit  FROM Courses WHERE Courses.Semester =".$sem."and Courses.Dept='".$br."'";

	 $eval=$conn->query("SELECT CID,CName,Credit  FROM Courses WHERE Courses.Semester = ".$sem." and Courses.Dept='".$br."'");

	if($eval->num_rows <= 0)
	{
		echo "<br>NO COURSES ARE AVAILABLE FOR YOU<br>";

	}


	 else
	{

		echo "<br><h3>COURSES AVAILABLE FOR YOU</h3><br>";
		echo "<div class='CSSTableGenerator'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>CourseID</td><td>Course Name</td><td>Credit</td><td>Theory/Lab</td><td>Type</td><td>Enroll Course</td>";
		echo "</tr>";
		
		
		$f=1;

		while($row=$eval->fetch_assoc())
			{
					$f=1;
					$avail=$conn->query("select * from Selected_Courses");
					while ($r=$avail->fetch_assoc()) 
						{
							if($r['Roll_No']==$sid && $row['CID']==$r['CID'])				
							$f=0;
						}
						

				if($f==1)		

				{	

				echo "<tr>";
					echo "<td>";
						echo $row['CID'];
					echo "</td>";
					echo "<td>";
						echo $row['CName'];
					echo "</td>";
					echo "<td>";
						echo $row['Credit'];
					echo "</td>";
					if($row['Theory']==1)
			echo "<td>Theory</td>";
		else
			echo "<td>Lab</td>";

		if($row['Core']==1)
			echo "<td>Core</td>";
		else
			echo "<td>Elective</td>";
					echo "<td>";
						echo "<form method='POST'>";
						echo "<input type='hidden' name='courseid' value=".$row['CID']."></input>";
						echo "<input type=\"hidden\" name=\"sid\" value=\"$sid\"></input>";
						echo "<input type=\"hidden\" name=\"sp\" value=\"$spass\"></input>";
						//echo "<input type=\"hidden\" name=\"selectcourse\" value=\"$course\"></input>";
						
						echo "<button style='color: blue; font-weight: bold; font-size: 100%; text-transform: uppercase;'  type='Submit'>Enroll for course</button>";
						echo "</form>";
					echo "</td>";
				echo "</tr>";
				}
			}
		echo "</table>";	
		echo '</div>';
	}
//entering grades

if(isset($_POST["courseid"]))
	{

//echo "hhh";
		//{
			$q="INSERT into Selected_Courses values('".$sid."','".$_POST['courseid']."','NO')";		
			
			//echo $q;
			if($update=$conn->query($q))
				{
					echo "<br>Successfully enrolled "; 
				}
			else
				{
					echo "<br>enrollment failed"; 
				}
		
	}
}		

$conn -> close();

?>
