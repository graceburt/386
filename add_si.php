<!DOCTYPE html>
<html>


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


	<script language=javascript>
		function submitPostLink()
		{
		document.postlink.submit();
		}
	</script>
	<script language =javascript>
		window.onbeforeunload = unsetsessionvar;
		function unsetsessionvar()
		{
			unset($_SESSION['added_students']);
		}
		</script>
<header>
<?php
session_start();
if (!isset($_SESSION['admin']))
{
	echo'<meta http-equiv="refresh" content="0; URL=login.php" />';
	exit();
//header("location:login.php");
}
?>

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
if (!isset($_SESSION['added_students']))
{
	$_SESSION['added_students']=array();
}
?>
<div class='column' style = 'padding-bottom: 20px; text-align:center;float:left;'>
	<form action = "#" name = postlink method='post'>

	<h4 style = 'padding-bottom:25px;'>Add SI Leader</h4>	
          <input type="text" id = "id-input" name='id-input'
                  rows = "1"
		   style ='width:95%' placeholder = 'Student ID'></textarea>
	<p></p>  
	<input type="text" id = "dept" name='dept'
                  rows = "1"
                   style ='width:95%' placeholder = 'Department (ex COSC)'></textarea>
	<p></p>  
          <input type="text" id = "course" name='course'
                  rows = "1"
		  placeholder = 'Course Number (ex 386)' style ='width:95%'></textarea>
	<p></p>  
           <input type="text" id = "sec" name='sec'
                  rows = "1"
		   style ='width:95%' placeholder = 'Section Number (ex 001)'></textarea>
	<p></p>
	
	<input type = "submit" value="Add SI"/>
	</form>
</div>
<?php 
if(strlen($_POST['id-input'])>0 && strlen($_POST['dept'])>0 && strlen($_POST['course'])>0 && strlen($_POST['sec'])>0)
{
	array_push($_SESSION['added_students'], array("id"=>$_POST['id-input'], "dept"=> $_POST['dept'], "course"=>$_POST['course'], "sec" => $_POST['sec']));
}
if (count($_SESSION['added_students'])>0)
{
echo"<div class='column' style = 'padding-bottom:20px; text-align:center;float:right;'><h4 style='padding-bottom: 25px;'><center> Added Leaders</center></h4>";
	foreach($_SESSION['added_students'] as $student)
	{
		echo"<p>";
		foreach($student as $att)
		{
			echo $att . " ";
		}
		echo"</p>";
		
	}
	echo"</div>";
}
/*
if (count($added_students)>0)
{
	echo"<div class = 'column' style = 'float:right; width = 30%;'></div>";
$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
		
	$query = "select name,ID from Student where Student_ID = ID";
 */
?>

</body>
</html>
