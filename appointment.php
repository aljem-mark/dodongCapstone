<?php include'header.php'; ?>

	<?php $clinicId = $_GET['clinic_id']; ?>

	<div class="row">
		<div class="col-auto">
			<div class="my-3">
				<a class="btn btn-secondary" href="cliniclist.php" role="button"><i class="fas fa-arrow-left"></i></a>
			</div>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-lg-8 col-sm-10">

			<?php if( isset($_SESSION['success']) && $_SESSION['success'] ) { ?>

				<div class="alert alert-success" role="alert">
					<h4 class="alert-heading">Thank you for contacting us.</h4>
					<p class="mb-0">We have received your enquiry and will respond to you within 24 hours.</p>
				</div>
				
				<?php unset($_SESSION['success']); ?>

			<?php } ?>

			<?php if( isset($_SESSION['error']) && $_SESSION['error'] ) { ?>

				<div class="alert alert-danger" role="alert">
					<h4 class="alert-heading">Oops.</h4>
					<p class="mb-0">An error occured while sending your request. Please try again.</p>
				</div>
				
				<?php unset($_SESSION['error']); ?>

			<?php } ?>
			
			<form action="appointment-action.php" method="POST">
				<input type="hidden" name="clinic_id" value="<?php echo $clinicId; ?>">
				<div class="card">
					<div class="card-header">
						<h1 class="mb-0">Request Appointment</h5>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label for="customerName">Full Name *</label>
							<input type="text" class="form-control" name="customer_name" id="customerName" placeholder="Full Name" required>
						</div>
						<div class="form-group">
							<label for="customerContact">Contact No. *</label>
							<input type="tel" class="form-control" name="customer_contact" id="customerContact" placeholder="Contact No." pattern="^-?\d+$" required>
						</div>
						<div class="form-group">
							<label for="clinic_services_list">Service *</label>
							<select class="form-control" name="clinic_services_list" id="clinic_services_list" required>
								<option value="0">Choose...</option>
								<?php   

									$selectc = mysqli_query($con,"SELECT A.*, B.service_name as iServ ,
										B.description as iDescription  ,
										B.price as iPrice ,
										B.id as iServID
										FROM clinic as A LEFT JOIN clinic_services as B on A.id = B.clinic_id 
										WHERE A.id = '".$clinicId."' AND B.enabled=1;");

									while($rr = mysqli_fetch_assoc($selectc)){
									
								?>

									<option value="<?php echo $rr['iServID'];?>"><?php echo $rr['iServ'];?> (<?php echo $rr['iPrice']; ?>)</option>

								<?php } ?>

								</select>
							</div>
							<div class="form-group">
								<label for="descriptionid">Description *</label>
								<textarea class="form-control" id="descriptionid" name="description" rows="3" required placeholder="Description"></textarea>
							</div>
							<input type="submit" class="btn btn-primary" name="save" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
 
<?php include'footer.php'; ?>