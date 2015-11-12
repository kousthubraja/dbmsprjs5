
<?php

require_once("connect.php");
 echo "<link rel='stylesheet' type='text/css' href='des1.css' />";

		if(!isset($_POST['tid'])  || !isset($_POST['tp']))
			die("failed");

		$tid = trim($_POST['tid']);	
		$tpass = trim($_POST['tp']);


		if(empty($tid) || empty($tpass))
			die("Enter all fields");


echo "<div id='main'>";
	//echo "kkk";
	$sql = "SELECT * FROM Teacher WHERE TID='$tid' and Tpass='$tpass'";

	$res = $conn -> query($sql);

	//print_r($res);



		
		if($res->num_rows <= 0)
		{
			die("<h2>Invalid login details</h2>");
		}
	//	setcookie('user',$tid,time()+3600,'/');
	//	echo "SET COOKIE";

		echo "<h1>Welcome</h1>";
		//echo "<h2>PROFILE</h2>";
		echo "<h3><a href='http://athena.nitc.ac.in/aravind_b130359cs/webproject/index.html'>Log Out</a></h3><h2>PROFILE</h2>";
		
		
		
		while($row = $res->fetch_assoc()) 
		{
			echo "<p>Name   : ".$row['TName']."</p><p>DOB      :".$row['DOB']."</p><p>Designation :".$row['Designation']."</p><p>Qualification :".$row['Qualification']."</p>";
		}
			
echo "</div>";
	//OPTION
	//echo "SELECT CID,CName FROM courses WHERE TID1='$tid' or  TID2='$tid'";

	$courses=$conn->query("SELECT CID,CName FROM Courses WHERE TID1='$tid' or  TID2='$tid'");


	if($courses->num_rows <= 0)
		{
			echo "currently you arent taking any courses";
		}

	else
		{
		
		  $i=1;

	  echo "<div class='CSSTableGenerator'>";
			echo "<table>";
				echo "<tr>";
					echo "<td colspan=\"2\">Select a course and get the student details</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td >Select course</td>";
					//echo "<td  id=\"courseID\" width=\"70%\">";
					
					echo "<td>";
					echo "<form action=\"teacherlogin.php\" method=\"POST\">";
					echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\"></input>";
						echo "<input type=\"hidden\" name=\"tp\" value=\"$tpass\"></input>";

					echo "<select name=\"selectcourse\">";
					echo "<option>--Select Course--</option> ";				
						while($row = $courses->fetch_assoc()) 
							{	
								$courseid[$i]=$row['CID'];
								$coursename[$i]=$row['CName'];
								echo "<option>" . $coursename[$i] . "</option>";
								$i++;
							}
					
					echo "</select>";
					echo "<input style='color: blue; font-weight: bold; font-size: 100%; text-transform: uppercase;' type=\"submit\" value=\"GO\"></input>";
					echo "</form>";
					
					echo "</td>";
					echo "</tr>";
					echo "</table>";
					echo "</div>";

		}



if($_POST['selectcourse'])
{
	$course=$_POST['selectcourse'];

 $ls="SELECT Student.Roll_No as Roll,Name,Grade  FROM Selected_Courses,Student,Courses WHERE CName='$course' and Courses.CID=Selected_Courses.CID and Selected_Courses.Roll_No=Student.Roll_No and NOT(Grade='NO')";
 	$ls=$conn->query($ls);
	
	//echo "GRAAAAAAAAAAAADE ".$row['Grade'];
	echo "<div class='CSSTableGenerator'>";
echo "<table border>";
	if($ls->num_rows > 0)
	{
		echo "<tr>";
		echo "<td>Student_ID</td><td>StudentName</td><td>Grade</td>";
		echo "</tr>";

	while($row=$ls->fetch_assoc())
		{

			echo "<tr>";
			echo "<td>".$row['Roll']." </td> <td> ".$row['Name']. "</td><td>".$row['Grade']."</td>";
			echo "</tr>";
		}
	}
	echo '</table>';
	echo '</div>';

}




	$eval=$conn->query("SELECT Student.Roll_No as Roll,Name  FROM Selected_Courses,Student,Courses WHERE CName='$course' and Courses.CID=Selected_Courses.CID and Selected_Courses.Roll_No=Student.Roll_No and Grade='NO'");

	if($eval->num_rows <= 0)
	{
		echo "<br>EVALUATION COMPLETED<br>";

	}


	 else
	{

		echo "<br>EVALUATE<br>";
		echo "<div class='CSSTableGenerator'>";
		echo "<table>";
		echo "<tr>";
		echo "<td>Student_ID</td><td>Student Name</td><td>Grade</td>";
		echo "</tr>";
		
		
		//$i=1;

		while($row=$eval->fetch_assoc())
			{
				echo "<tr>";
					echo "<td>";
						echo $row['Roll'];
					echo "</td>";
					echo "<td>";
						echo $row['Name'];
					echo "</td>";
					echo "<td>";
						echo "<form method='POST'>";
						echo "<input type='hidden' name='Roll_No' value=".$row['Roll']."></input>";
						echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\"></input>";
						echo "<input type=\"hidden\" name=\"tp\" value=\"$tpass\"></input>";
						echo "<input type=\"hidden\" name=\"selectcourse\" value=\"$course\"></input>";
						echo "<select name='grade'>
								<option>S</option>
								<option>A</option>
								<option>B</option>
								<option>C</option>
								<option>D</option>
								<option>E</option>
								<option>F</option>
								<option>W</option>
								<option>R</option>
								</select>";
						echo "<button style='color: blue; font-weight: bold; font-size: 100%; text-transform: uppercase;'' type='Submit'>Submit grade</button>";
						echo "</form>";
					echo "</td>";
				echo "</tr>";
			}
		echo "</table>";	
		echo '</div>';
	}
//entering grades

if(isset($_POST["Roll_No"]))
	{

//echo "hhh";
		//{
		//	$x=$row['Roll_No'];
			$q = "UPDATE Selected_Courses SET  Grade='".$_POST['grade']."' WHERE Roll_No = '".$_POST['Roll_No']."'";
			//echo $q;
			if($update=$conn->query($q))
				{
					echo "<br>evaluation successful"; 
				}
			else
				{
					//echo "<br>evaluation failed"; 
				}
		
	}		

$conn -> close();

?>
