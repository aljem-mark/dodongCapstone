<?php 
	include'config.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Dental Finder</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
			<script type="text/javascript" src="js/jquery.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="style1.css">
	</head>

	<body>

	<div style="margin: 10px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">Registration</div>
						<div class="card-body">
							<form action="useraction.php" method="POST">
								<!-- <div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail4">Email</label>
									<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
								</div>
								<div class="form-group col-md-6">
									<label for="inputPassword4">Password</label>
									<input type="password" class="form-control" id="inputPassword4" placeholder="Password">
								</div>
								</div> -->
								<div class="form-group">
									<label for="inputFname">First Name</label>
									<input type="text" class="form-control" id="inputFname" name="fname" placeholder="First Name">
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="Midname">Middle Name</label>
										<input type="text" class="form-control" id="Midname" name="mname" placeholder="Middle Name">
									</div>
									<div class="form-group col-md-6">
										<label for="Lastname">Last Name</label>
										<input type="text" class="form-control" id="Lastname" name="lname" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<label for="inputemail">Email</label>
									<input type="email" class="form-control" id="inputemail" name="email" placeholder="Email" required>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputpass">Password</label>
										<input type="password" class="form-control" id="inputpass" name="p1" placeholder="Password" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputpass1">Re-Password</label>
										<input type="password" class="form-control" id="inputpass1" name="p2" placeholder="Password" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputaddress">Address</label>
										<input type="text" class="form-control" id="inputaddress" name="address" placeholder="Address">
									</div>
									<div class="form-group col-md-6">
											<div class="radio" style="padding: 10px;">
												<label>Gender<br>
												  <input  type="radio" name="gender" value="m" checked>Male
												  <input type="radio" name="gender" value="f">Female
												 </label>
											</div>
									</div>
								</div>
								<div class="form-group">
									<label for="inputcont">Phone</label>
									<input type="text" class="form-control" id="inputcont" name="cont" placeholder="Phone" required>
								</div>
								<div class="form-group">
								    <label for="inputdesc">Description</label>
								    <textarea class="form-control" id="inputdesc" rows="3" name="desc"></textarea>
								</div>
									<?php if (isset($_GET['u'])) {
									 ?>
										<input type="submit" class="btn btn-primary" name="saveC" value="Save"></input>
									<?php } else {
										?> 
<input type="submit" class="btn btn-primary" name="save" value="Save"></input>
									
										<?php
									}?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>		
	</body>