<?php include'config.php'; ?>

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
		<div class="container-fluid<?php echo isset($_SESSION['uid']) ? ' d-flex align-items-center' : ''; ?>" style="min-height: 100vh">

		<?php if(!isset($_SESSION['uid'])) : ?>

			<div class="row">
				<div class="col-auto ml-auto my-3">
					<a href="login.php" class="btn btn-outline-secondary btn-lg font-weight-bold mr-2" name="clinic">Sign in</a>
					<a href="addclinic.php" class="btn btn-outline-info btn-lg font-weight-bold" name="clinic">Register Clinic</a>
				</div>
			</div>

		<?php endif; ?>
			
			<div class="row">
				<div class="col justify-content-center align-items-center">
					<div class="row justify-content-center">
						<img class="img-resposive w-50 h-50" src="img/logo.png">
					</div>
					<div class="col-md-12 text-center">
						<div>
							<p style="font-family: century gothic">Search for Dental Clinic around Cagayan de Oro</p>
						</div>
						<div class="mb-3">
							<a href="cliniclist.php" class="btn btn-info btn-lg" name="clinic">View List</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include'footer.php' ?>