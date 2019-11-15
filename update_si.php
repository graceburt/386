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
   <li><a href='admin_page.php'><span>Home</span></a></li>	
   <li class ='active'><a href='update_si.php'><span>Update SI's</span></a></li>
   <li class ='last'><a href='edit_SIs.php'><span>Edit SI's</span></a></li>
   <li class='last' style = 'float:right;'><a href='logout.php'><span>LOG OUT</span></a></li>
</ul>
</div>





<div class = 'column' style = 'width: 45%; margin-top: 5%'>
	<form>
	<h4>Add SI Leader</h4>	
          <textarea id = "name-input"
                  rows = "1"
                   placeholder = 'Name' style ='width:85%'></textarea>
          <textarea id = "id-input"
                  rows = "1"
                   style ='width:85%' placeholder = 'Student ID'></textarea>
          <textarea id = "id-input"
                  rows = "1"
                   style ='width:85%' placeholder = 'Email'></textarea>
          <textarea id = "id-input"
                  rows = "1"
		   style ='width:85%' placeholder = 'Password'></textarea>

	<input type = "submit" value="Add SI">
	</form>

  </div>
 <div class = "column" style = 'width: 45%; float:right;margin-top: 5%'>
	<form>
	<h4>Delete SI Leader</h4>	
     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}

	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";

	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		echo "<p><input type = 'checkbox' name = '".$row['ID']."' value = '".$row['ID']."'>".$row['name']."  (ID: ".$row['ID'].")</p>";
	}
?>


	</form>




  </div> 

</div>

</body>
</html>
