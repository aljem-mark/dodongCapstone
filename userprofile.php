<?php include 'header.php' ?>
<?php include 'auth-checker.php'; ?>

	<div class="row my-4">
		<div class="col-md-12 ">
			<div class="card">
				<div class="card-header"><?php echo $_SESSION['userFullname']; ?></div>
				<div class="card-body">
					<form action="" method="POST">
						<?php 
								$select=   mysqli_query($con,"SELECT *  FROM user  WHERE id = '".$_SESSION['uid']."'");
								while($r = mysqli_fetch_assoc($select)){

									?>

								<div class="form-group">
									<label for="inputFname">First Name</label>
									<input type="text" class="form-control" id="inputFname" name="fname" placeholder="First Name" value="<?php echo $r['fname']; ?>" >
									
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="Midname">Middle Name</label>
										<input type="text" class="form-control" id="Midname" name="mname" placeholder="Middle Name" value="<?php echo $r['mname']; ?>" > 
									</div>
									<div class="form-group col-md-6">
										<label for="Lastname">Last Name</label>
										<input type="text" class="form-control" id="Lastname" name="lname" placeholder="Last Name" value="<?php echo $r['lname']; ?>" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputemail">Email</label>
									<input type="email" class="form-control" id="inputemail" name="email" placeholder="Email" value="<?php echo $r['email']; ?>"  required >
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputpass">Password</label>
										<input type="password" class="form-control" id="inputpass" name="p1" placeholder="Password">
									</div>
									<div class="form-group col-md-6">
										<label for="inputpass1">Re-Password</label>
										<input type="password" class="form-control" id="inputpass1" name="p2" placeholder="Password">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputaddress">Address</label>
										<input type="text" class="form-control" id="inputaddress" name="address" value="<?php echo $r['address']; ?>" placeholder="Address">
									</div>
									<div class="form-group col-md-6">
										<label for="inputcont">Phone</label>
										<input type="text" class="form-control" id="inputcont" name="cont" placeholder="Phone" value= "<?php echo $r['contact']; ?>" required>
									</div>
								</div>
								
								<div class="form-group">
								    <label for="inputdesc">Description</label>
								    <textarea class="form-control" id="inputdesc" rows="3" name="desc"></textarea>
								</div>
								<input type="submit" class="btn btn-primary" name="save" value="save"></input>
								<input type="submit" class="btn btn-info" name="update" value="Update"></input>
								</form>

									<?php
								}
							 ?>
							 <?php
			if (isset($_POST['update']))
			if ($_POST['update']) {
				if ($_POST['p1'] == $_POST['p2'] and $_POST['p1'] != "" and $_POST['p2'] != ""){

					$address = stripslashes($_POST['address']);
					$address = htmlentities($address);
					$address = strip_tags($address);
					$address = addslashes($address);


					$update = mysqli_query($con,"INSERT INTO user (id,fname,mname,lname,email,pass,gender,description,address,type,contact)".
						"VALUES('', 
						'".$_POST['fname']."' ,
						 '".$_POST['mname']."' ,
						  '".$_POST['lname']."' ,
						   '".$_POST['email']."' ,
						    '".$_POST['p1']."'  ,
						    '".$_POST['gender']."' ,
						     '".$_POST['desc']."' , 
						     '".$_POST['cont']."' , 
						     '".mysqli_real_escape_string($address)."' , 
						     3 , 
						     '".$_POST['cont']."')");
						
						if ($update){
								header("location: cliniclist.php");			
						}else{}
							echo 'sayup';
				}
			}
		?>
				</div>
			</div>
		</div>
	</div>