<!--?php
  ini_set('display_errors', 1);
?-->

<?php
//echo "test";

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'mrovine1');
define('DB_PASSWORD', 'mrovine1');
define('DB_DATABASE', 'SalisburySIDB');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(!$con){
	die("Connection failed: " .mysqli_connect_error());
}

?>
