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
						$_SESSION['homepage'] = "admin-index.php";
						header("location: admin-index.php");
					} else {
						$_SESSION['homepage'] = "index.php";
						header("location: index.php");
					}
				}
			}
		}
	?>
	

	<div style="background-image: url(img/doc1.jpg);
				background-attachment: fixed;
			    background-position: center;
			    background-repeat: no-repeat;
				background-size: cover;
				height: 100vh;
				width: 100vw;
				position: fixed;
				z-index: -1;"
	></div>

	<div class="row justify-content-center align-items-center">
		<div class="col-lg-3 col-md-5 col-12" >
			<div class="card o-hidden border-0 shadow-lg my-5">
				<?php if(isset($_SESSION['userFullname']) && $_SESSION['userFullname']) : ?>
				<?php else : ?>
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
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php include'footer.php'; ?>