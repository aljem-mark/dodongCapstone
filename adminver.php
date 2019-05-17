<?php 
include 'config.php';
mysqli_query($con,"UPDATE user SET type = '2' WHERE id = '".$_GET['id']."'");
	
			 header("location:admin.php")	;	
?>