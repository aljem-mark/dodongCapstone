<?php include 'header.php'; ?>

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
	<div class="row justify-content-center my-4">
		<div class="col-auto">
			<h1 class="mb-0">Registration</h1>
		</div>
	</div>
	<div class="row justify-content-center mb-5">
		<div class="col-md-5 col">
			<form action="clinic-action.php" method="POST" enctype="multipart/form-data">
				<div class="card border-dark mb-4">
					<div class="card-header bg-dark text-white">
						<h2 class="mb-0">Personal Details</h2>
					</div>
					<div class="card-body">

						<?php if( isset($_SESSION['success'])) : ?>

							<div id="registration-personal-success" class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-heading">Clinic Successfully Registered</h4>
								<p class="mb-0">We need still need to verify your Clinic in 24 - 48 hours. Thank you.</p>
							</div>
							
							<?php unset($_SESSION['success']); ?>

						<?php endif; ?>

						<div id="registration-personal-error" class="alert alert-danger <?= isset($_SESSION['error']) ? '' : 'd-none'; ?>" role="alert">
							<h4 class="alert-heading">Oops.</h4>
							<p class="mb-0" id="registration-personal-error-message"><?= isset($_SESSION['error']) ? $_SESSION['error'] : 'An error occured while sending your request. Please try again.'; ?></p>
						
							<?php unset($_SESSION['error']); ?>

						</div>

						<div class="form-group">
							<label for="inputemail">Email *</label>
							<input type="email" class="form-control" id="inputemail" name="email" placeholder="Email" required>
						</div>
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
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputpass">Password *</label>
								<input type="password" class="form-control" id="inputpass" name="p1" placeholder="Password" required>
							</div>
							<div class="form-group col-md-6">
								<label for="inputpass1">Re-Password *</label>
								<input type="password" class="form-control" id="inputpass1" name="p2" placeholder="Password" required>
							</div>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="m" id="gender-male">
									<label class="form-check-label" for="gender-male">Male</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="f" id="gender-female">
									<label class="form-check-label" for="gender-female">Female</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card border-dark">
					<div class="card-header bg-dark text-white">
						<h2 class="mb-0">Clinic Details</h2>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label for="inputclinic">Clinic Name *</label>
							<input type="text" class="form-control" id="inputclinic" name="name" placeholder="Name" required>
						</div>
						<div class="form-group">
							<label for="inputadd">Address *</label>
							<input type="text" class="form-control" id="inputadd" name="address" placeholder="Address" required>
						</div>
						<div class="form-group">
							<label for="phone">Phone *</label>
							<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
						</div>
						<div class="form-group">
							<label for="embed">Map *</label>
							<textarea class="form-control" id="embed" rows="3" name="map" required></textarea>
							<small id="passwordHelpBlock" class="form-text text-muted">
								Get embed map from <a href="//www.embedgooglemap.net/" target="_blank">here</a>
							</small>
						</div>
						<div class="form-group">
							<label for="desc">Description</label>
							<textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
						</div>
						<div class="form-group">
							<label>Upload</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="media" id="registration-upload" accept="image/*">
									<label class="custom-file-label" for="registration-upload" id="registration-upload-label">Choose file...</label>
								</div>	
							</div>
						</div>
						<div class="form-group">
							<img id="registration-img-preview" src="..." alt="..." class="img-thumbnail d-none" style="max-height: 250px;">
						</div>
						<div>
							<input type="submit" class="btn btn-dark" name="save" value="Submit"/>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php include'footer.php' ?>

<script>

	$(document).ready(function () {
		$('#inputpass, #inputpass1').on('blur', function(e) {
			personalErrorMessage = "Password does not match";
			if($('#inputpass').val() && $('#inputpass1').val()) {
				if($('#inputpass').val() === $('#inputpass1').val()) {
					$('#registration-personal-error').addClass('d-none')
				} else {
					$('#registration-personal-error-message').text(personalErrorMessage)
					$('#registration-personal-error').removeClass('d-none')
					$([document.documentElement, document.body]).animate({
						scrollTop: $("#registration-personal-error").offset().top - 100
					}, 1000)
				}
			}
		})

		$('#registration-upload').on('change', function(e) {
			var fileName = e.target.files[0].name
			var $imgPreview = $('#registration-img-preview')
			
			$('#registration-upload-label').text(fileName)
			$imgPreview.attr('src', 'uploads/'+fileName)
			$imgPreview.attr('alt', fileName)
			$imgPreview.removeClass('d-none')
		})
	})

	$(window).on('load', function() {
	})

</script>