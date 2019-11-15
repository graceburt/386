<?php
session_start();
session_unset();
echo "<p> Resetting variables </p>";
header("location:login.php");
?>
