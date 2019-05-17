<?php 
	include'config.php';
?>

<?php
	if (isset($_POST['logout'])) {
		if ($_POST['logout']) {
			session_destroy();
			header("location: index.php");
		}
	}
?>