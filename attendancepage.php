<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['SI']))
{
    echo'<meta http-equiv="refresh" content="0; URL=login.php" />';
    exit();
    //header("location:login.php");
}

// Retrieving current user's username(Email)
$email = $_SESSION['uname']

?>
<html>
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<head>
    <title>CSA Student Overview </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic|Roboto:300,400&display=swap" rel="stylesheet">
     <link rel ="stylesheet" href="stylemenu.css">
     <link rel ="stylesheet" href="stylesheet.css">
</head>
<header>
    <nav id="navigation">
        <!-- <ul class="links" style = "float:left;">
        <li><a href="">Home</a></li>
        <li class="dropdown"><a href="#" class="trigger-drop">Edit SI<i class="arrow"></i></a>
        <ul class="drop">
        <li><a href="">Add</a></li>
        <li><a href="">Delete</a></li>
        <li><a href="">Update</a></li>
    </ul>
</li>
<li class="dropdown"><a href="#" class="trigger-drop">Edit Session<i class="arrow"></i></a>
<ul class="drop">
<li><a href="">Add</a></li>
<li><a href="">Delete</a></li>
<li><a href="">Update</a></li>
</ul>
</li>
</ul>
-->
<ul class ="links">
    <li><a href="logout.php">Log Out</a>
    </li>
</ul>
</nav>
</header>

<body>
    <?php
    // Making connection to DB
    $connection = new mysqli('localhost','jstoetzel1','jstoetzel1','SalisburySIDB');
    if($connection->connect_error) {
        die('Failed to Connect: '.$connection->connect_error);
    }

    // Query for users ID
    $IDQuery = "SELECT ID FROM Student WHERE email = '" . $email . "'";
    $result = $connection->query($IDQuery);
    if($result) {
        foreach ($result as $row) {
            $ID = $row['ID'];
        }
        $result -> free_result();
    }

    // Query for SI's Name
    $NameQuery = "SELECT name FROM Student WHERE ID = '" . $ID . "'";
    $result = $connection->query($NameQuery);
    if($result) {
        foreach ($result as $row) {
            $name = $row['name'];
        }
        $result -> free_result();
    }

    /*  NOTES FOR FRONT END
    - $email    = the current SI's email (jstoetzel@gulls.salisbury.edu)
    - $ID       = the current SI's ID number (1000003)
    - $name     = the current SI's name (Jack Stoetzel)
    */
    
    // Query for the SI's sessions (will be a list)
    $SessionQuery = "SELECT session_weekday, session_time, duration FROM Session WHERE SI_ID = " . $ID;
    $result = $connection->query($SessionQuery);
    if($result){
        foreach($result as $row){
            $SessionDay = $row['session_weekday'];
            $SessionTime = $row['session_time'];
            $SessionDuration = $row['duration'];
            $TimeFromZero = strtotime($SessionTime) - strtotime("00:00:00");    // Find the time from 0
            $EndTime = date('h:i a', strtotime($SessionDuration) + $TimeFromZero);      // Add the duration to that time

            // To assign the current date a number
            $CurrentDate = date("l");

            if($Currentdate == "Sunday"){
                $DateNum = 0;
            }
            else if($CurrentDate == "Monday"){
                $DateNum = 1;
            }
            else if($CurrentDate == "Tuesday"){
                $DateNum = 2;
            }
            else if($CurrentDate == "Wednesday"){
                $DateNum = 3;
            }
            else if($CurrentDate == "Thursday"){
                $DateNum = 4;
            }
            else if($CurrentDate == "Friday"){
                $DateNum = 5;
            }

            if($SessionDay == "Sunday"){
                $SessionNum = 0;
            }
            else if($SessionDay == "Monday"){
                $SessionNum = 1;
            }
            else if($SessionDay == "Tuesday"){
                $SessionNum = 2;
            }
            else if($SessionDay == "Wednesday"){
                $SessionNum = 3;
            }
            else if($SessionDay == "Thursday"){
                $SessionNum = 4;
            }
            else if($SessionDay == "Friday"){
                $SessionNum = 5;
            }

           // echo "<p>" . $SessionDay . " (" . date('m/d/Y',(strtotime ('-' .  ($DateNum - $SessionNum) . ' day' , strtotime ( date('m/d/Y'))))) . "): " . date('h:i a', strtotime($SessionTime)) . " - " . $EndTime . "</p>";
        }
    }
    // Printing the list of students in the sections    
    // Need to get the Dpt, Num, Sec from Course matched with SI_ID
    // Then pull all students from the Enrolled in list who are in this class
    ?>
<div class = "column" style="float:left">
  <div class = "scroll_bar" style = "height: 675px;">
  <h2>Select Attendance From Roster: </h2>
  <form action method= "post">
<?php
    // Printing the list of students in the sections    
    // Need to get the Dpt, Num, Sec from Course matched with SI_ID
    // Then pull all students from the Enrolled in list who are in this class
    $ClassQuery = "SELECT department, number, section FROM Course WHERE SI_ID = " . $ID;
    //echo "<h3> " . $ClassQuery . "</h3>";
    $CQResult = $connection->query($ClassQuery);
    if($CQResult){
        foreach($CQResult as $row1){
            $EnrollQuery = "SELECT student_ID FROM Enrolled_In WHERE department = '" . $row1['department'] . "' AND course_number = " . $row1['number'] . " AND course_section = " . $row1['section'];
            //echo "<h3> " . $EnrollQuery . "</h3>";
            $EQResult = $connection->query($EnrollQuery);
            if($EQResult){
                foreach($EQResult as $row2){
                    $StudentQuery = "SELECT name FROM Student WHERE ID = " . $row2['student_ID'];
                    //echo "<h3> " . $StudentQuery . "</h3>";
                    $SQResult = $connection->query($StudentQuery);
                    if($SQResult){
                        foreach($SQResult as $row3){
                            echo "<p><input type = 'checkbox' name = 'Attendance' value = '" .$row2['student_ID']. "'> ".$row3['name'] . " (" . $row2['student_ID'] . ")</p>";
                        }   
                    }   
                }   
            }   
        }   
    } 
?>
    </form>
   </div>
  </div>
</body>
</html>
