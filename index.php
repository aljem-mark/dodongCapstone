<?php 
	include'config.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Dental Finder</title>
		<meta charset="utf-8">
    
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>

	<body style="background-image: url(img/doc1.jpg);
				background-attachment: fixed;
			    background-position: center;
			    background-repeat: no-repeat;
			    background-size: cover;
			    ">
		<div class="container-fluid" style="height: 100vh">
			<div class="row flex-column">

				<?php if(!isset($_SESSION['uid'])) : ?>

					<div class="col row my-3">
						<div class="col-auto ml-auto">
							<a href="login.php" class="btn btn-outline-secondary btn-lg font-weight-bold mr-2" name="clinic">Sign in</a>
							<a href="register.php" class="btn btn-primary btn-lg font-weight-bold" name="clinic">Sign up</a>
						</div>
					</div>

				<?php endif; ?>

				<div class="col row justify-content-center align-items-center">
					<div class="col-md-10">
						<div class="row justify-content-center">
							<img class="img-resposive w-50 h-50" src="img/logo.png">
						</div>
						<div class="col-md-12 text-center">
							<div>
								<p style="font-family: century gothic">Search for Dental Clinic around Cagayan de Oro</p>
							</div>
							<div>
								<a href="cliniclist.php" class="btn btn-info btn-lg" name="clinic">View List</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include'footer.php' ?>