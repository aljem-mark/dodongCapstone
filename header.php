<!DOCTYPE html>

	<?php 
		include 'config.php';
	?>

	<html>
	<head>
		<title>Dental Finder</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="css/sb-admin-2.css">
		<link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css"> -->
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/media.css">
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="fontawesome/js/all.min.js"></script>
	</head>
	<body>

	<?php

		include 'nav-top.php';

		if(isset($_SESSION['userType']) && $_SESSION['userType']) :
			if(isset($_SESSION['uid']) && $_SESSION['uid']) :
				include 'nav.php';
			endif;
		else :
	
	?>
		<main role="main" class="col" style="padding-top: 40px;">
	
	<?php endif; ?>

 