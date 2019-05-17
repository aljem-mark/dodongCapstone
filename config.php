<?php 
 session_start();
//error_reporting(0);
$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'frcapstone';

$con = mysqli_connect($server,$user,$pass);
mysqli_select_db($con, $dbname);
//if isset(($_SESSION['uid']))  = false {
	//location:(http://localhost/capstne/index.php);
	
//}
?>