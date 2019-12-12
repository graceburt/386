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
	if(isset($_POST["deleteSession"]))
	{
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
	$delquery = "delete from Session where SI_ID = '".$_SESSION['sil-id']."' and session_weekday = '".$_POST['session-to-del']."'";
	$dq = mysqli_query($connection, $delquery);
	
	}	
?>
<div class = 'column' style='text-align:center;' >
<form action = "#" name = postlink method='post' style="padding-top:5%;">
<?php
	if(isset($_POST['group1']))
	{
		$_SESSION['sil-id']= $_POST['group1'];
	}
if (isset($_SESSION['sil-id']))
{
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
		
	$query = "select session_weekday,session_time from Session where SI_ID = ".$_SESSION['sil-id'];
	
	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		echo "<p><input type = 'checkbox' name = 'session-to-del' value = '".$row['session_weekday']."'>".$row['session_weekday']." at  ".date('h:i a',strtotime($row['session_time']))."</p>";
	}
	//echo $_SESSION['sil-id'];
		echo"<button class ='button1' name = 'deleteSession' value = 'del'>Delete Session</button>";
}
else
{
	echo "Select an SI to view their sessions";
}
?>

	
	</form>
<?php
?>







  </div> 

<div class ='text_column' style = "align:left;">


<div id="cover">
  <form method="POST" action="#">
    <div class="tb">
      <div class="td"><input type="text" name ='search' placeholder="Search" required></div>
      <div class="td" id="s-cover">
        <button class ="searchbutton" type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>

 <div class = "column" style = 'width: 100%; float:left;height:400px overflow: hidden;'>
 	<div class = "scroll_bar"> 
<h3>Choose an SI </h3>
	<form action = "#" name = postlink method='post'>
     <?php
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}
	if(isset($_POST['search']))
	{
		$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID and name like '%".$_POST['search']."%'";
	}
	else
	{
		$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID";
	}
	$r = mysqli_query($connection, $query);
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
?>

	
	</form>
<?php
?>
</div>
</div>

</body>
</html>
</div>

</body>
</html>



