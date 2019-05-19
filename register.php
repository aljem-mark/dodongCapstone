<?php include 'header.php'; ?>

	<div class="row justify-content-center">
		<div class="col-md-6 col-sm-10">
			<div class="card mt-4">
				<div class="card-header">
					<h1 class="mb-0">Registration</h1>
				</div>
				<div class="card-body">
					<form action="useraction.php" method="POST">
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
								<label>Gender</label>
								<div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="gender" value="male" id="gender-male">
										<label class="form-check-label" for="gender-male">Male</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="gender" value="female" id="gender-female">
										<label class="form-check-label" for="gender-female">Female</label>
									</div>
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
						<input type="submit" class="btn btn-primary" name="<?php isset($_GET['u']) ? "saveC" : "save" ?>" value="Save"/>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php include 'footer.php'; ?>