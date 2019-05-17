<?php include'header.php'; ?>

	<?php

		if (isset($_POST['login']))
		if ($_POST['login']) {
			$email = $_POST['email'];
			$password = $_POST['p1'];
		
			$query = "SELECT A.*, ifnull(B.id,'No Clinic') as idClinic FROM user as A LEFT JOIN clinic as B ON A.id = B.user_id WHERE email = '".$email."'  AND  pass = '".$password."' LIMIT 1";

			if(!$result = mysqli_query($con, $query)) {
				$_SESSION['error'] = 'Invalid Username/Password';
				header("location: index.php");
			} else {
				while($row = mysqli_fetch_assoc($result)){
					$_SESSION['userFullname'] = ucwords($row['fname']." ".$row['mname']." ".$row['lname']); 
					$_SESSION['userType'] = $row['type'];
					$_SESSION['uid'] = $row['id'];
					$_SESSION['ClinicID'] = $row['idClinic'];

					if ($row['type'] == 2) {
						$_SESSION['homepage'] = "dentist-index.php";
						header("location: dentist-index.php");
					} elseif ($row['type'] == 1) {
						$_SESSION['homepage'] = "admin.php";
						header("location: admin.php");
					} else {
						$_SESSION['homepage'] = "index.php";
						header("location: index.php");
					}
				}
			}
		}
	?>

	<div class="container">
		<div class="row justify-content-center align-items-center" style="height: 100vh">
			<div class="col-lg-5 col-md-8 col-sm-10 col-12" >
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="col-md-12">
					<?php if(isset($_SESSION['userFullname']) && $_SESSION['userFullname']) { ?>
						<?php } else {?>
							<div class="input-group">  
								<form action="" method="POST">
								<div class="form-group p-5">
									<div class="row">
										<div class="col-md-12 col-xs-6">

												<div class="text-center">
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
														<div class="text-center" style="margin-top: 5px;">

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

<?php include'footer.php'; ?>