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
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-md-8 col-xs-12 col-sm-12">
					<div class="row justify-content-center" style="margin-top: 50px;">
						<img class="img-resposive" src="img/logo.png" style="width:50%; height: 50%;">
					</div>
						<div class="col-md-12" >
							<div align="center">
							<p style="font-family: century gothic">Search for Dental Clinic around Cagayan de Oro</p>
							</div>
							<div align="center">
							<a href="cliniclist.php" class="btn btn-info" name="clinic">View List</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6" >
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="col-md-12">
							<?php if(isset($_SESSION['userFullname']) && $_SESSION['userFullname']) { ?>
							<?php } else {?>
								<div class="input-group">  
									<form action="login.php" method="POST">
									<div class="form-group p-5">
										<div class="row">
											<div class="col-md-12 col-xs-6">

													<div align="center">
														<h1>Welcome</h1>
														<hr>
													</div>

													<?php if( isset($_SESSION['error']) && $_SESSION['error'] ) { ?>
														<div class="alert alert-danger" role="alert">
															<?php
																echo $_SESSION['error'];
																unset($_SESSION['error']);
															?>
														</div>
													<?php } ?>

													<?php if( isset($_SESSION['success']) && $_SESSION['success'] ) { ?>
														<div class="alert alert-success" role="alert">
															<?php
																echo $_SESSION['success'];
																unset($_SESSION['success']);
															?>
														</div>
													<?php } ?>

														<label for="inputemail"></label>
															<input type="email" class="form-control input-sm" style="border-radius: 10rem;" name="email" id="inputemail" placeholder="Email" required>
												</div>

												<div class="col-md-12 col-xs-6">
														<label for="inputpass"></label>
														<div class="form-group">
															<input type="password" class="form-control input-sm" style="border-radius: 10rem;" id="inputpass" name="p1"  placeholder="Password">
															<div align="center" style="margin-top: 5px;">

															<br><hr><br>
																<input type="submit"class="btn btn-primary btn-block" name="login" id="login" value="Login">
																<a class="btn btn-success btn-block" class="form-control input-sm" href="register.php?u=1" role="button">Register Dental Clinic</a>
															</div>
														</div>
												</div>
											</div>
										</div>
									</form>		
								</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>

			</div>
		</div>
			</div>

		

		</div>

<br>
<br>
	<!-- About content -->
		<!-- <div class="container-fluid" id="about">
			<div class="row" style="background-color: white; padding: 20px; ">
				<div class="col-md-6">
				<h3 class="w3-center">About</h3>
						<p>Our philosophy for our clinics is what we strive for every day. “A family oriented practice in a friendly and caring environment dedicated to excellence.” We look forward to creating happy, healthy and bright smiles for you and your family in the years ahead.</p>
				</div>
				<div class="col-md-6">
					<img src="img/back.jpg" class="justify-content-center">
				</div>
			</div>
		</div>
		 -->
	<!-- End of the Acout -->
		
		<br><br><br><br><br><br><br><br><br><br>
	<?php include'footer.php' ?>
	

	</body>