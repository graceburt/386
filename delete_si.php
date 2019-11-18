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
        <li><a href="add_si.php">Add</a></li>
        <li><a href="delete_si.php">Delete</a></li>
        <li><a href="update_si.php">Update</a></li>
      </ul>
    </li>
</ul>
<ul class ="links">
    <li><a href="logout.php">Log Out</a>
    </li>
  </ul>
</nav>


</header>

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

 <div>
  <p>Select the SI's you wish to delete.</p>
 </div>

 <div class = "column">
	<form action method= "post">
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
		echo "<p><input type = 'checkbox' name = 'SI[]' value = '".$row['ID']."'>".$row['name']."  (ID: ".$row['ID'].")</p>";
	}
?>
      
        <input type = "submit" value = "Delete"> 
	</form>




  </div> 

<?php 

	//Php code to be included

	$student=$_POST['SI'];
	$id = '';
	//echo("'.$Student[0].'";

	$sql = "DELETE FROM Supplemental_Instruction_Leader WHERE ID = '$id'";
	$t = mysqli_query($connection, $sql);

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Delete'])){

	if(empty($studet)){
		echo("You didn't select any SI's to remove.");
	}else{
		$N = count($student);
		echo("You want to remove the following SIs \n");
		for($i=0; $i< $N; $i++){
			$id = $student[$i];
			
		}
	}
	}

?>
