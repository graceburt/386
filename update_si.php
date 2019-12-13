
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
      </ul
>
    </li>
</ul>
<ul class ="links">
    <li><a href="logout.php">Log Out</a>
    </li>
  </ul>
</nav>


</header>

<body style = "padding: 70px;">

<div class = 'text_column' style = 'float:right; width: 45%; margin:0; '>

<?php
 	if(isset($_POST["course_to_upd"]))
	{
		$_SESSION['course_to_up']=$_POST["course_to_upd"];
	}
	if(isset($_POST["updatecourse"]))
	{
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
	$updatequery = "update Course set department = '".$_SESSION['dept']."', number = '".$_SESSION['num']."', section = '".$_SESSION['sec']."' where SI_ID = '".$_SESSION['add-si-id']."'";
	$res = mysqli_query($connection, $updatequery);

	}	
?>


<div class = 'column' style = 'text-align:center; width: 45%; height:320px; width: 100%;'>
<div class = "colContent"><form action ="#" name = "addsession"  method = 'post' style ="width:100%; height:100%;" >
<?php

 if (isset($_POST['choose-si']))
 {
	$_SESSION['add-si-id'] = $_POST['choose-si'];
 }
if (isset($_SESSION['add-si-id']))
{
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	$coursequery = "SELECT department, number, section FROM Course WHERE SI_ID = '".$_SESSION['add-si-id']."';";
	//print($coursequery);
	$result = mysqli_query($connection, $coursequery);
	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		echo "<p><input type = 'checkbox' name = 'courses[]' value = '".$rows['department']."'>Department: ".$rows['department']." Course: ".$rows['number']." Section: ".$rows['section']." </p>";

	}



}
?>
</form>
</div>
</div>
</div>

<div class ='text_column' style = "align:left; margin:2%; width:45%">

<div id="cover">
  <form method="post" action="#">
    <div class="tb">
      <div class="td"><input type="text" name = 'search' placeholder="Search"></div>
      <div class="td" id="s-cover">
        <button class = 'searchbutton' type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>

 <div class = "column" style = 'width: 100%; float:left; height:600px; text-align:center; overflow: hidden;'> 
 	<div class = "scroll_bar" style = "height: 600px;">

	<h3>Choose an SI </h3>
		<form action = "#" name=postlink method ='post'>
	     <?php
		$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
		if($connection->connect_error) {
			die('Failed to Connect: '.$connection->connect_error);
		}
		if(isset($_POST['search']))
		{
		$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID and name like '%".$_POST['search']."%'";
		}
		else{
		$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";
		}
		$r = mysqli_query($connection, $query);

		while($row = mysqli_fetch_array($r))
		{
			echo "<p><input type = 'radio' id = 'buttong' name = 'choose-si' onclick='this.form.submit()' value = '".$row['ID']."'";
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



