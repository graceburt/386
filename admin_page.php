<!DOCTYPE html>
<html>
<head>
<?php
session_start();
if (!isset($_SESSION['admin']))
{

	echo'<meta http-equiv="refresh" content="0; URL=login.php" />';
	exit();
//header("location:login.php");
}

?>
<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic|Roboto:300,400&display=swap" rel="stylesheet"> 	
	<link rel ="stylesheet" href="stylemenu.css">
	<link rel ="stylesheet" href="stylesheet.css">
	<link rel ="stylesheet" href="stylesearch.css">
	<script language=javascript>
		function submitPostLink()
		{
		document.postlink.submit();
		}
</script>


    
	<link rel="javascript" href="progress.js">

</head>
<header>
<!--
<div id = 'cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Home</span></a></li>	
 <div class = "dropdown">
   <li><a href='update_si.php'><span>Edit SI</span></a></li>
<div class = "dropdown-content">
<a>Add</a>
</div>
</div>
   <li class ='last'><a href='edit_SIs.php'><span>Edit Session</span></a></li>
   <li class='last' style = 'float:right;'><a href='logout.php'><span>LOG OUT</span></a></li>
</ul>
</div>

<nav class="menu">
  <ol>
    <li class="menu-item" style = 'float:left;'><a href="#0">Home</a></li>
    <li class="menu-item">
      <a href="#0">Edit SI</a>
      <ol class="sub-menu">
        <li class="menu-item"><a href="#0">Add</a></li>
        <li class="menu-item"><a href="#0">Delete</a></li>
        <li class="menu-item"><a href="#0">Update</a></li>
      </ol>
    </li>
    <li class="menu-item">
      <a href="#0">Edit Session</a>
      <ol class="sub-menu">
        <li class="menu-item"><a href="#0">Add</a></li>
        <li class="menu-item"><a href="#0">Delete</a></li>
        <li class="menu-item"><a href="#0">Update</a></li>
      </ol>
    </li>
    <li class="menu-item" style = "float:right; padding-left:50 px"><a href="logout.php">Log Out</a></li>
  </ol>
</nav>
-->
<nav id="navigation">
  <ul class="links" style = "float:left;">
  <li><a href="#">Home</a></li>
    <li class="dropdown"><a href="#" class="trigger-drop">Edit SI<i class="arrow"></i></a>
      <ul class="drop">
        <li><a href="add_si.php">Add</a></li>
        <li><a href="delete_si.php">Delete</a></li>
        <li><a href="update_si.php">Update</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#" class="trigger-drop">Edit Session<i class="arrow"></i></a>
      <ul class="drop">
        <li><a href="add_session.php">Add</a></li>
        <li><a href="delete_session.php">Delete</a></li>
        <li><a href="update_session.php">Update</a></li>
      </ul>
    </li>
</ul>
<ul class ="links">
    <li><a href="logout.php">Log Out</a>
    </li>
  </ul>
</nav>


</header>

<body>

<div class ='text_column' style = "align:left;">
<h1>HELLO, Admin!</h1>
<h3>This week's Supplemental Instruction Leaders...</h3>


<div id="cover" style = "align:left">
  <form method="POST" action="#">
    <div class="tb">
      <div class="td"><input id="searchbar"  type="text"  name = "search" placeholder="Search" required></div>
      <div class="td" id="s-cover">
        <button class = "searchbutton" type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>

<?php 
	if(isset($_POST['search']))
	{
	echo "<div class = 'column' style = 'float:left; width:100%; height:400px;'>";
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
		
	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID and name like '%".$_POST['search']."%'";
	
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
		$attendance_query = "select session_date, DAYOFWEEK(session_date) as weekday, session_time, count(*) from Attends where SI_ID =".$row['ID']." group by session_date, session_time, SI_ID";
		$sub_r = mysqli_query($connection, $attendance_query);		
		$office_hours_query ="select HOUR(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))))as hours, MINUTE(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(end_time,start_TIME))))) as minutes from Office_Hours where SI_ID =".$row['ID'];
		$office_hr_r = mysqli_query($connection, $office_hours_query);
		$office_hr = mysqli_fetch_array($office_hr_r);		
		echo"<tr>";
		echo"<td style = 'padding-left:5%;'><strong>".$row['name']."</strong></td><td align ='center'> </td><td align = 'center'>";
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
			echo"<tr><td class='indent'><a href=# onclick='submitPostLink()'>";
			if ($sub_row['weekday'] == 1)
			{
				echo"Sunday";
			}
			elseif ($sub_row['weekday'] == 2)
			{
				echo"Monday";
			}
			elseif ($sub_row['weekday'] == 3)
			{
				echo"Tuesday";
			}
			elseif ($sub_row['weekday'] == 4)
			{
				echo"Wednesday";
			}
			elseif ($sub_row['weekday'] == 5)
			{
				echo"Thurdsay";
			}
			elseif ($sub_row['weekday'] == 6)
			{
				echo"Friday";
			}
			elseif ($sub_row['weekday'] == 7)
			{
				echo"Saturday";
			}
			else
			{
				echo $sub_row['session-date'];
			}
			echo"</a></td> <td align = 'center'>".$sub_row['count(*)']."</td><td>";

			echo"</td>";
			echo"</tr>";
		}
	}
	echo"</table>";
		echo"</div>";
	}
?>

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
</div>
<div class = 'column' >
	<div class = 'scroll_bar'>
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
		$attendance_query = "select session_date, DAYOFWEEK(session_date) as weekday, session_time, count(*) from Attends where SI_ID =".$row['ID']." group by session_date, session_time, SI_ID";
		$sub_r = mysqli_query($connection, $attendance_query);		
		$office_hours_query ="select HOUR(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))))as hours, MINUTE(SEC_TO_TIME(sum(TIME_TO_SEC(TIMEDIFF(end_time,start_TIME))))) as minutes from Office_Hours where SI_ID =".$row['ID'];
		$office_hr_r = mysqli_query($connection, $office_hours_query);
		$office_hr = mysqli_fetch_array($office_hr_r);		
		echo"<tr>";
		echo"<td style = 'padding-left:5%;'><strong>".$row['name']."</strong></td><td align ='center'> </td><td align = 'center'>";
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
			echo"<tr><td class='indent'><a href=# onclick='submitPostLink()'>";
			if ($sub_row['weekday'] == 1)
			{
				echo"Sunday";
			}
			elseif ($sub_row['weekday'] == 2)
			{
				echo"Monday";
			}
			elseif ($sub_row['weekday'] == 3)
			{
				echo"Tuesday";
			}
			elseif ($sub_row['weekday'] == 4)
			{
				echo"Wednesday";
			}
			elseif ($sub_row['weekday'] == 5)
			{
				echo"Thurdsay";
			}
			elseif ($sub_row['weekday'] == 6)
			{
				echo"Friday";
			}
			elseif ($sub_row['weekday'] == 7)
			{
				echo"Saturday";
			}
			else
			{
				echo $sub_row['session-date'];
			}
			echo"</a></td> <td align = 'center'>".$sub_row['count(*)']."</td><td>";

			echo"</td>";
			echo"</tr>";
		}
	}
	echo"</table>";
     ?>
 	</div>
  </div>

</div>

</body>
</html>
