<?php

session_start();

if(isset($_SESSION['uname'])){
	header("Location:admin_page.php");
}
?>

<html>
<div class = "container">
     <form method = "post" action = "">
	<div id = "div_login">
	  <h1>Login</h1>
	  <div>
               <input type ="text" class="textbox" id="txt_uname" name="txt_uname" placeholder= "Username" />
	  </div>
	  <div>
	      <input type = "password" class="textbox" id="txt_uname"  name="txt_pwd"  placeholder="Password"/>
	</div>
	<div>
	     <input type="submit" value ="Submit" name="but_submit" id="but_submit"/>
	</div>
      </div>
    </form>
</div>
</html>


<?php
include "config.php";
error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display errors', TRUE);

if(isset($_POST['but_submit'])){
	$uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
	$pword = mysqli_real_escape_string($con,$_POST['txt_pwd']);


	//check if username and password are empty
	if($uname !='' && $pword!=''){

		//write query to check if user exists
		$sql_query = "SELECT COUNT(*) as cnt FROM Admin where username = '".$uname."' AND password ='".$pword."'";
		$result = mysqli_query($con, $sql_query);
		$row = mysqli_fetch_array($result);

		$count = $row['cnt'];

		$sql_query1 = "SELECT COUNT(*) as cnt1 FROM Supplemental_Instruction_Leader WHERE password = '".$pword."' AND Student_ID = (SELECT ID FROM Student WHERE  email = '".$uname."')";
		$result1 = mysqli_query($con, $sql_query);
		$row1 = mysqli_fetch_array($result1);

		$count1 = $row1['cnt1'];

		if($count > 0){
			$_SESSION['uname'] = $uname;
			flush();
			header('Location: admin_page.php');
		        die('Should of redirected by now');
		}
		else if($count1 > 0){
			echo 'test';
			$_SESSION['uname'] =$uname;
			header('Location: PC.php');
		}


		else{
			echo "Invalid username or password";
		}
	}
}
?>