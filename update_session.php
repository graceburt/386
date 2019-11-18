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
<nav id="navigation">
  <ul class="links" style = "float:left;">
  <li><a href="admin_page.php">Home</a></li>
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
<?php
if (isset($_POST["group3"]))
{
	$_SESSION["time"] = $_POST["group3"];
}
if(isset($_POST['group']))
{
	$_SESSION['day'] = $_POST['group'];
}	
?>
<div class = 'text_column' style = 'float:right; width: 45%; margin:0; '>
<div class = 'column' style = 'text-align:center; width: 100%; height:300px;'>
<form action ="#" name = postlink method = 'post' style ="width:100%;" >
<?php

 if (isset($_POST['choose-si']))
 {
	$_SESSION['add-si-id'] = $_POST['choose-si'];
 }
if (isset($_SESSION['add-si-id']))
{
	while($row = mysqli_fetch_array($r))
	{
		echo "<p><input type = 'radio' name = 'group1' onclick='this.form.submit()' value = '".$row['ID']."'";
		if (isset($_SESSION['sil-id']))
		{
			if ($row['ID']== $_SESSION['sil-id'])
			{
				echo " checked";
			}
		}
		echo">".$row['name']."  (ID: ".$row['ID'].")</p>";
	}
	echo $_SESSION['sil-id'];

	

	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
		
	$namequery = "select name from Student where ID = ".$_SESSION['add-si-id'];
	$nr = mysqli_query($connection, $namequery);
	$name_row = mysqli_fetch_array($nr); 

	echo "<h3>".$name_row['name']." 's Sessions </h3>";
	$query = "select session_weekday,session_time from Session where SI_ID = ".$_SESSION['add-si-id'];
	
	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		if (isset($_SESSION['sil-id1']))
		{
			if ($row['ID']== $_SESSION['sil-id1'] and isset($_SESSION['day']) and isset($_SESSION['time']))
			{
		echo "<p><input type = 'radio' name = 'group1' onclick='this.form.submit()' value = '".$row['ID']."' checked><p style ='color#800000; font-weight:bold;'>".$_SESSION['day']." at ".$_SESSION['time'].":00:00 </p>";
			}
			else
			{

				echo "<p><input type = 'radio' name = 'group1' onclick='this.form.submit()' checked value = '".$row['ID']."'>".$row['name']."  (ID: ".$row['ID'].")</p>";
			}
		}
		else
		{
			echo "<p><input type = 'radio' name = 'group1' onclick='this.form.submit()' value = '".$row['ID']."'>".$row['name']."  (ID: ".$row['ID'].")</p>";
		}
	
	}
	//echo $_SESSION['sil-id'];
}
else
{
	echo"<h3> Choose an SI to view their current sessions </h3>";
}
?>
</div>
<div class = 'column' style='text-align:center; height: 300px;width:100%;' >


<h2>Choose a new day and time</h2>
<div class="weekDays-selector">

<form action = '#' name = postday method = 'post' style = "padding-top:10px; height:60px;">
<?php
echo'
  <input type="radio" id="weekday-mon" class="weekday" name="group" onclick="this.form.submit()" value = "Monday"';
if($_SESSION["day"] == 'Monday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-mon">M</label>
  <input type="radio" id="weekday-tue" class="weekday" name="group" onclick="this.form.submit()" value = "Tuesday"';

if($_SESSION["day"] == 'Tuesday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-tue">T</label>
  <input type="radio" id="weekday-wed" class="weekday" name="group" onclick="this.form.submit()" value = "Wednesday"';

if($_SESSION["day"] == 'Wednesday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-wed">W</label>
  <input type="radio" id="weekday-thu" class="weekday" name="group" onclick="this.form.submit()" value = "Thursday"';

if($_SESSION["day"] == 'Thursday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-thu">T</label>
  <input type="radio" id="weekday-fri" class="weekday" name="group" onclick="this.form.submit()" value = "Friday"';

if($_SESSION["day"] == 'Friday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-fri">F</label>
  <input type="radio" id="weekday-sat" class="weekday" name="group" onclick="this.form.submit()" value = "Saturday"';

if($_SESSION["day"] == 'Saturday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-sat">S</label>
  <input type="radio" id="weekday-sun" class="weekday" name="group" onclick="this.form.submit()" value = "Sunday"';

if($_SESSION["day"] == 'Sunday')
{
	echo " checked";
}
echo '/>
  <label for="weekday-sun">S</label>
';
?>
</form>
</div>


<div class="time-selector">
<form action = '#' name = posttime method ='post'>
<?php  
echo'
  <input type="radio" id="1oclk" class="time" name="group3" onclick="this.form.submit()" value ="1"';
 if($_SESSION['time'] =='1')
 {
	echo " checked ";
 }
  echo'/>
  <label for="1oclk">1</label>
  <input type="radio" id="2oclk" class="time" name="group3"  onclick="this.form.submit()" value ="2"';

 if($_SESSION['time'] =='2')
 {
	echo " checked ";
 }
 echo '/>
  <label for="2oclk">2</label>
  <input type="radio" id="3oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="3"';
 
 if($_SESSION['time'] =='3')
 {
	echo " checked ";
 }
  echo '/>
  <label for="3oclk">3</label>
  <input type="radio" id="4oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="4"';

 if($_SESSION['time'] =='4')
 {
	echo " checked ";
 }
 echo '/>
  <label for="4oclk">4</label>
  <input type="radio" id="5oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="5"';

 if($_SESSION['time'] =='5')
 {
	echo " checked ";
 }

echo' />
  <label for="5oclk">5</label>
  <input type="radio" id="6oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="6"';

 if($_SESSION['time'] =='6')
 {
	echo " checked ";
 }

 echo '/>
  <label for="6oclk">6</label>
  <input type="radio" id="7oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="7"';

 if($_SESSION['time'] =='7')
 {
	echo " checked ";
 }
 echo '/>
  <label for="7oclk">7</label>
  <input type="radio" id="8oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="8"';

 if($_SESSION['time'] =='8')
 {
	echo " checked ";
 }
 echo '/>
  <label for="8oclk">8</label>
  <input type="radio" id="9oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="9"';

 if($_SESSION['time'] =='9')
 {
	echo " checked ";
 }

 echo '/>
  <label for="9oclk">9</label>
  <input type="radio" id="10oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="10"';

 if($_SESSION['time'] =='10')
 {
	echo " checked ";
 }
echo ' />
  <label for="10oclk">10</label>
  <input type="radio" id="11oclk" class="time" name="group3"  onclick="this.form.submit()"  value ="11"';
 
 if($_SESSION['time'] =='11')
 {
	echo " checked ";
 }
 echo ' />
  <label for="11oclk">11</label>
  <input type="radio" id="12oclk" class="time" name="group3"  onclick="this.form.submit()" value ="12"';

 if($_SESSION['time'] =='12')
 {
	echo " checked ";
 }
echo ' />
  <label for="12oclk">12</label>
';
?>
</form>
</div>
  </div>



</div>
<div class ='text_column' style = "align:left; margin:2%; width:45%">

<div id="cover" style = "align:left;margin-left:-15vw;">
  <form method="get" action="">
    <div class="tb">
      <div class="td"><input type="text" placeholder="Search"></div>
      <div class="td" id="s-cover">
        <button class = 'searchbutton' type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>

 <div class = "column" style = 'width: 100%; float:left;margin-top: 5%; height:400px; text-align:center'>
<h1>Choose an SI </h1>
	<form action = "#" name=postlink method ='post'>
     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}

	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";

	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		echo "<p><input type = 'radio' name = 'choose-si' onclick='this.form.submit()' value = '".$row['ID']."'";
		if(isset($_SESSION['add-si-id']))
		{
			if($row['ID']==$_SESSION['add-si-id'])
			{
				echo" checked";
			}	
		}
		echo ">".$row['name']."  (ID: ".$row['ID'].")</p>";
	}

?>

</form>


</div>

</div>

</body>
</html>



