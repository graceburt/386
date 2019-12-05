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

<div class="container" style = "float:left;width:500px;height:200px">
<div id="cover" style= "float:left" align = "left">
  <form method="get" action="">
    <div class="tb">
      <div class="td"><input type="text" placeholder="Search" required></div>
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

<div class='column' style = 'padding:0; text-align:center;float:right;'>
<p>Update SI information</p>
	<form action = "#" name = postlink method='post' style="padding-top:5%;">
	
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
