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

<div class="text_column" style = "float:left">
<div class="container" style = "float:left; width:100%; height:200px">
<div id="cover" style= "float:left" align = "left">
  <form method="POST" action="#">
    <div class="tb">
      <div class="td"><input type="text"  name = 'search' placeholder="Search" required></div>
      <div class="td" id="s-cover">
        <button class = "searchbutton" type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>
</div>

<?php
if(isset($_POST['search']))
{
echo' <div class = "column" style="width:100%; height:300px;">
	<form action method= "post">
	<h4>Delete SI Leader</h4>';	
	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	if($connection->connect_error) {
		die('Failed to Connect: '.$connection->connect_error);
	}

	$query = "select name,ID from Student,Supplemental_Instruction_Leader where Student_ID = ID and name like '%".$_POST['search']."%'";

	$r = mysqli_query($connection, $query);
	while($row = mysqli_fetch_array($r))
	{
		echo "<p><input type = 'checkbox' name = 'SI[]' value = '".$row['ID']."'>".$row['name']."  (ID: ".$row['ID'].")</p>";
	}
      
       echo ' <input type = "submit" value = "Search" id= "search"> 
	</form>
  </div>' ;
}
?>


</div>


 <div class = "column" style="float:right">
 	<div class = "scroll_bar">
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
      
        <input type = "submit" value = "Delete" id = "delete" name = "delete" onclick= "return confirm('Are you sure?')"> 
	</form>



</div>
  </div> 

<?php 

	$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
	//Php code to be included

	$student=$_POST['SI'];
	$id = '';
	//echo "'.$Student[0].'";

	$siquery = "DELETE FROM Supplemental_Instruction_Leader WHERE Student_ID = '".$id."'";
	$studentquery ="DELETE FROM Student WHERE ID = '".$id."'";
	$tf = mysqli_query($connection, $sql);

	if(isset($_POST['delete'])){
        //echo "'.$student[0].'";  
	if(empty($student)){
		echo("You didn't select any SI's to remove.");
	}else{
		$N = count($student);
		//echo("You want to remove the following SIs \n");
		for($i=0; $i< $N; $i++){
			$id = $student[$i];
			echo $id;
			if(mysqli_query($connection,$siquery)){
				echo "Removed from SI successfully";
			}
			if(mysqli_query($connection,$studentquery)){
				echo "removed from Student successfully";
			}
               }
	}
	}

?>
