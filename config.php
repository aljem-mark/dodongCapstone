<?php

	session_start();
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'frcapstone';

	$con = mysqli_connect($server,$user,$pass);
	mysqli_select_db($con, $dbname);
	
	$smsApiKey = urlencode('D7AQFNNY9Sk-yKXwrma3PCZHAsFCqUctyUcto9ccnY');

?>