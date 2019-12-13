<!DOCTYPE html>
<head>
  <title>CSA Login</title>
  <link rel = "stylesheet" type = "text/css" href = "loginpage.css">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<html>

<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
				<form method = "post" action = "#">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name = "txt_uname"/>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name = "txt_pwd"/>
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn" name = "loginbutton"id = "loginbutton"/>
					</div>
				</form>
			</div>
</div>
</body>
</html> 


<?php

session_start();
$con = mysqli_connect('localhost', 'mrovine1', 'mrovine1', 'SalisburySIDB');

if(!$con){
	die("Connection failed: " .mysqli_connect_error());
}
error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display errors', TRUE);
if(isset($_POST['loginbutton'])){
	//$uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
	//$pword = mysqli_real_escape_string($con,$_POST['txt_pwd']);
	$uname = $_POST['txt_uname'];
	$pword = $_POST['txt_pwd'];
	//check if username and password are empty
	if($uname !='' && $pword!=''){
		$hashpword = hash('ripemd160',$pword);
		//write query to check if user exists
		$sql_query = "SELECT COUNT(*) as cnt FROM Admin where username = '".$uname."' AND password ='".$hashpword."'";
		$result = mysqli_query($con, $sql_query);
		$row = mysqli_fetch_array($result);

		$count = $row['cnt'];

		$sql_query1 = "SELECT COUNT(*) as cnt1 FROM Student WHERE password = '".$hashpword."' AND  email = '".$uname."'";
		$result1 = mysqli_query($con, $sql_query1);
		$row1 = mysqli_fetch_array($result1);

		$count1 = $row1['cnt1'];

		if($count > 0){
			$_SESSION['admin'] = true;
			$_SESSION['username'] =$uname;
			//flush();
			
			//echo'<meta http-equiv="refresh" content="0; URL=admin_page.php" />';
			header('Location: admin_page.php');
			die();
		       // die('Should of redirected by now');
		}
		else if($count1 > 0){
			$_SESSION['SI']= true;
			$_SESSION['uname'] =$uname;

			header('Location: attendancepage.php');
		}


		else{
			#echo "Invalid username or password";
			#echo $count1;
		}
	}
}
