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

<div class = 'column' style='text-align:center;' >
<h1>Choose an SI </h1>
	<form>
     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}

	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";

	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		echo "<p><input type = 'radio' name = 'group1' value = '".$row['ID']."'>".$row['name']."  (ID: ".$row['ID'].")</p>";
	}
?>


	</form>




  </div> 

<div class ='text_column' style = "align:left;">


<div id="cover" style = "align:left;margin-left:-15vw;">
  <form method="get" action="">
    <div class="tb">
      <div class="td"><input type="text" placeholder="Search" required></div>
      <div class="td" id="s-cover">
        <button type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>

 <div class = "column" style = 'width: 100%; float:left;margin-top: 5%; height:400px'>
<h1>Choose a day and time</h1>
<div class="weekDays-selector">
  <input type="radio" id="weekday-mon" class="weekday" name="group" />
  <label for="weekday-mon">M</label>
  <input type="radio" id="weekday-tue" class="weekday" name="group" />
  <label for="weekday-tue">T</label>
  <input type="radio" id="weekday-wed" class="weekday" name="group" />
  <label for="weekday-wed">W</label>
  <input type="radio" id="weekday-thu" class="weekday" name="group"  />
  <label for="weekday-thu">T</label>
  <input type="radio" id="weekday-fri" class="weekday" name="group" />
  <label for="weekday-fri">F</label>
  <input type="radio" id="weekday-sat" class="weekday" name="group" />
  <label for="weekday-sat">S</label>
  <input type="radio" id="weekday-sun" class="weekday" name="group" />
  <label for="weekday-sun">S</label>
</div>


<div class="time-selector">
  <input type="radio" id="1oclk" class="time" name="group3" />
  <label for="1oclk">1</label>
  <input type="radio" id="2oclk" class="time" name="group3" />
  <label for="2oclk">2</label>
  <input type="radio" id="3oclk" class="time" name="group3" />
  <label for="4oclk">3</label>
  <input type="radio" id="4oclk" class="time" name="group3"  />
  <label for="4oclk">4</label>
  <input type="radio" id="5oclk" class="time" name="group3" />
  <label for="5oclk">5</label>
  <input type="radio" id="6oclk" class="time" name="group3" />
  <label for="6oclk">6</label>
  <input type="radio" id="7oclk" class="time" name="group3" />
  <label for="7oclk">7</label>
  <input type="radio" id="8oclk" class="time" name="group3" />
  <label for="8oclk">8</label>
  <input type="radio" id="9oclk" class="time" name="group3" />
  <label for="9oclk">9</label>
  <input type="radio" id="10oclk" class="time" name="group3" />
  <label for="10oclk">10</label>
  <input type="radio" id="11oclk" class="time" name="group3" />
  <label for="11oclk">11</label>
  <input type="radio" id="12oclk" class="time" name="group3" />
  <label for="12oclk">12</label>
</div>


<?php
?>
</div>

</body>
</html>
</div>

</body>
</html>



