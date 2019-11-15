<!DOCTYPE html>
<html>
<head>

<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic|Roboto:300,400&display=swap" rel="stylesheet"> 	
	<link rel ="stylesheet" href="stylemenu.css">
	<link rel ="stylesheet" href="stylesheet.css">
	<script language=javascript>
		function submitPostLink()
		{
		document.postlink.submit();
		}
	</script>
	<link rel="javascript" href="progress.js">

</head>
<body>

<div id='cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Home</span></a></li>
   <li class='last' style = 'float:right;'><a href='logout.php'><span>LOG OUT</span></a></li>
</ul>
</div>





<h1>HELLO, Admin!</h1>
<h3>This week's Supplemental Instruction Leaders...</h3>

<form class="search-box" action="action_page.php">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
<!--
<div class="row">
  <div class="text_column">
	<table>
		<thead>
			<tr>
				<th align = 'center'>SI Leader</th>
				<th align = 'center'>ATTENDANCE<br /> REPORTED</th> 
				<th align = 'center'> OFFICE HOURS</th>
			</tr>
		</thead>
	</table>
</div>
-->
<div class = 'column'>

     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
		
	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";
	echo"<table>
		<thead>
			<tr>
			<th align = 'center'>SI Leader</th>
			<th align = 'center' >ATTENDANCE <br/> REPORTED</th>
			<th align = 'center' >OFFICE HOURS</th>
			</tr>
		</thead>";

	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		$attendance_query = "select session_date, session_time, count(*) from Attends where SI_ID =".$row['ID']." group by session_date, session_time, SI_ID";
		$sub_r = mysqli_query($connection, $attendance_query);		
		$office_hours_query ="select HOUR(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))))as hours, MINUTE(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(end_time,start_TIME))))) as minutes from Office_Hours where SI_ID =".$row['ID'];
		$office_hr_r = mysqli_query($connection, $office_hours_query);
		$office_hr = mysqli_fetch_array($office_hr_r);		
		echo"<tr>";
		echo"<td style = 'padding-left:5%;'><strong>".$row['name']."</strong></td><td></td><td align = 'center'>";
		if( $office_hr['hours'] >=2)
		{
			echo " FULFILLED ";
		}
		elseif(isset($office_hr['hours']))
		{
			echo "<div style = 'color:#e50000;'>".$office_hr['hours']." hrs  ".$office_hr['minutes']." mins </div>";

		}
		else
		{
			echo"<div style = 'color:#e50000;'> 0 hrs  0 mins </div>";
		}
		echo"</td>";
		echo"</tr>";		

		while($sub_row=mysqli_fetch_array($sub_r))
		{
			echo"<form action = 'session_page.php' name=postlink method = 'post'>
				<input type = 'hidden' name='s-date' value=".$sub_row['session_date'].">
			<input type = 'hidden' name='si-name' value=".$row['name'].">
				<input type = 'hidden' name='s-time' value=".$sub_row['session_time'].">";
			echo"<tr><td class='indent'><a href=# onclick='submitPostLink()'>".$sub_row['session_date']."</a></td> <td align = 'center'>".$sub_row['count(*)']."</td><td>";

			echo"</td>";
			echo"</tr>";
		}
	}
	echo"</table>";
	/*
	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";
	$r = mysqli_query($connection, $query);
	echo"<table>
		<thead>
			<tr>
				<th>SIL</th>
				<th style = 'float:right;'>OFFICE HOURS</th> 
			</tr>
		</thead>";
	while($row = mysqli_fetch_array($r))
	{
		$office_hours_query = "select start_time-end_time from Office_Hours where SI_ID = ".$row['ID'];
		$sub_r = mysqli_query($connection, $office_hours_query);		
		echo"<tr>";
		echo"<td class = sql_text>".$row['name']."</td> <td style = 'float:right;'>".$sub_r['start_time-end_time'];
			echo"</td>";
			echo"</tr>";
	}
	echo"</table>";
	 */
     ?>
  </div>

<!--   <div class = "column">
  	<script async src="//jsfiddle.net/kimmobrunfeldt/72tkyn40/embed/"></script>
  </div> -->

</div>

</body>
</html>
