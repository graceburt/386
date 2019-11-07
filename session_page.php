<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 45%;
  padding: 10px;
  /*height: 300px; /* Should be removed. Only for demonstration */
  margin-left: 20px;
  border: solid;
  border-radius: 25px;
}
.text_column {
  float: left;
  width: 45%;
  /*height: 300px; /* Should be removed. Only for demonstration */
  margin-left: 20px;
  color:#F7C55A;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.sql_text{
color:black;
font-family:"Trebuchet MS", Helvetica, sans-serif;
}

th, td {
  padding: 5px;
}
table{
	width:100%;
border-collapse:collapse;
}
a{
	text-decoration:none;
	color :#FFF;
}
</style>
</script>

</head>
<body>


<?php
	$date = $_POST["s-date"];
	$time = $_POST["s-time"];
	echo "<h1> SIL NAME: ".$_POST["si-name"]."</h1>";
	echo "<h1> DATE: ".$date."</h1>";
	echo "<h1> TIME: ".$time."</h1>";	
?>

<div class="row">
  <div class="text_column"> 
    <center><h2>STUDENTS</h2></center>
  </div>
  <div class="text_column" style ="margin-left:50px">
    <center><h2>FREQUENT</h2></center>
  </div>
</div>


<div class="row">
  <div class="column" style="background-color:#ffffff;">
     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}	
	$query = "select name, ID from Student where ID in (select a1.student_ID from Attends a1,Supplemental_Instruction_Leader s1 where s1.Student_ID = SI_ID and '".$date."' = session_date and '".$time."' = session_time)";
	$r = mysqli_query($connection, $query);
	echo"<table>";
	while($row = mysqli_fetch_array($r))
	{
		echo"<tr><td>".$row['name']." </td><td>".$row['ID']."</td></tr>";
	}
	echo"</table>";
mysqli_close($connection)
?>
  </div>
  <div class="column" style="background-color:#ffffff;margin-left:50px">
     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
	$query ="select s1.name,student_count/SI_count as avg_attend, student_count, SI_count from (select student_ID,SI_ID, count(*) as student_count from Attends group by student_ID, SI_ID) by_student,(select SI_ID,count(*) as SI_count from Attends group by SI_ID)by_SI, Student s1 where s1.ID =by_student.student_ID";
	$student_attendance = mysqli_query($connection, $query);
	echo"<table>";
	while($row = mysqli_fetch_array($student_attendance))
	{
		if ($row['avg_attend'] >= .5)
		{
		echo"<tr>";
		echo"<td class = sql_text>".$row[0]."</td> <td style = 'float:right;'>".$row['student_count']."/".$row['SI_count'];
			echo"</td>";
		echo"</tr>";
		}
	}
echo"</table>";
mysqli_close($connection)
     ?>
  </div>
</div>														


</body>
</html>
