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

<div style = "float:left;">
  <div id="cover">
    <div class = "scroll_bar">
    <form method="get" action="">
      <div class="tb">
        <div class="td"><input type="text" id="searchtxt"  placeholder="Search"required></div>
        <div class="td" id="s-cover">
          <button id = "search"  class = "searchbutton" type="submit">
            <div id="s-circle"></div>
            <span></span>
          </button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

<div class='column' style = 'text-align:center;float:right;'>
  <div class = "scroll_bar">
  <p style = "padding-top: 30px;">Update SI information</p>
  	<form action = "#" name = postlink method='post' style="padding-top:5%;">
  	
            <input type="text" id = "id-input" name='id-input'
                    rows = "1"
  		   style ='width:95%' "font-size: 30px;" placeholder = 'Student ID'></textarea>
  	<input type="text" id = "dept" name='dept'
                    rows = "1"
                     style ='width:95%' "font-size: 30px;" placeholder = 'Department (ex COSC)'></textarea>
            <input type="text" id = "course" name='course'
                    rows = "1"
  		  placeholder = 'Course Number (ex 386)' style ='width:95%' "font-size: 30px;"></textarea> 
             <input type="text" id = "sec" name='sec'
                    rows = "1"
  		   style ='width:95%' "font-size: 30px;" placeholder = 'Section Number (ex 001)'></textarea>
  	
  	<input type = "submit" value="Add SI" name = "submitbutton" id = "submitbutton"  style = "font-size: 30px;"/>
  	</form>
  </div>
</div>


<?php
$connection = @mysqli_connect('localhost','swarman2','swarman2','SalisburySIDB');
if($connection->connect_error) {
	die('Failed to Connect: '.$connection->connect_error);
}

if(isset($_GET['search'])){
   $student = mysql_real_escape_string($_GET['searchtxt']);
   $searchquery = "SELECT name from Student WHERE name LIKE '%".$student."%'";
   $result = mysql_query($searchquery);
   while($row = mysql_fetch_array($result)){
	 echo "<div id = 'link' onClick = 'addText(\"".$row['name']."\");'>" .$row['name'] . "</div>";
         echo $result;
     }
}

if(isset($_POST['submitbutton'])){
	$id = $_POST['id-input'];
	$dept = $_POST['dept'];
	$course = $_POST['course'];
	$sec = $_POST['sec'];

	if($id != ''){

	}

	if($dept != ''){
	
	}

	if($course != ''){

	}

	if($sec != ''){

	}

}







?>
