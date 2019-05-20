<?php include 'header.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

    if(isset($_GET['user_id'])) {
        $initialQuery = "";
        $where = [];

        $initialQuery = "SELECT
            u.*, u.id as uid,
            c.id as cid,
            c.embed,
            c.name,
            up.filename
            FROM `user` as u
            LEFT JOIN `clinic` as c ON c.user_id=u.id
            LEFT JOIN `uploads` as up ON up.id=c.profile_media_id
            WHERE u.id={$_GET['user_id']}";

        $whereClause = $where ? "WHERE " : "";
        $whereClause .= implode(' AND ', $where);
        $query = "{$initialQuery} {$whereClause}";

        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result)) : while ($row = mysqli_fetch_assoc($result)) :
            $userData = $row;
        endwhile; endif;
    } else {
        http_response_code( 303 ); header( "Location: {$_SESSION['homepage']}" ); exit;
    }

?>

	<div class="row justify-content-center my-4">
		<div class="col-auto">
			<h1 class="mb-0">Edit Profile</h1>
		</div>
	</div>
	<div class="row justify-content-center mb-5">
		<div class="col-lg-5 col-md-10">
			<form action="clinic-action.php" method="POST" enctype="multipart/form-data">
				<div class="card border-dark mb-4">
                    <input type="hidden" name="uid" value="<?= $userData['uid']; ?>">
                    <input type="hidden" name="type" value="<?= $userData['type']; ?>">
                    <input type="hidden" name="updatePassword" id="updatePassword" value="0">

					<div class="card-header bg-dark text-white">
						<h2 class="mb-0">Personal Details</h2>
					</div>
					<div class="card-body">

						<?php if( isset($_SESSION['success'])) : ?>

							<div id="registration-personal-success" class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-heading mb-0">Profile Successfully Update</h4>
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
							<input type="email" class="form-control" id="inputemail" name="email" placeholder="Email" required value="<?= $userData['email']; ?>">
						</div>
						<div class="form-group">
							<label for="inputFname">First Name</label>
							<input type="text" class="form-control" id="inputFname" name="fname" placeholder="First Name" value="<?= $userData['fname']; ?>">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="Midname">Middle Name</label>
								<input type="text" class="form-control" id="Midname" name="mname" placeholder="Middle Name" value="<?= $userData['mname']; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="Lastname">Last Name</label>
								<input type="text" class="form-control" id="Lastname" name="lname" placeholder="Last Name" value="<?= $userData['lname']; ?>">
							</div>
						</div>
                        <div id="passwordToggleBtn" class="mb-2">
                            <button type="button" class="btn btn-info btn-sm">Change Password</button>
                        </div>
						<div id="passwordBox" class="form-row d-none">
							<div class="form-group col-md-6">
								<label for="inputpass">Password *</label>
								<input type="password" class="form-control" id="inputpass" name="p1" placeholder="Password" required disabled>
							</div>
							<div class="form-group col-md-6">
								<label for="inputpass1">Re-Password *</label>
								<input type="password" class="form-control" id="inputpass1" name="p2" placeholder="Password" required disabled>
							</div>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="m" id="gender-male" <?= $userData['gender'] == 'm' ? 'checked' : ''; ?> />
									<label class="form-check-label" for="gender-male">Male</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="f" id="gender-female" <?= $userData['gender'] == 'f' ? 'checked' : ''; ?> >
									<label class="form-check-label" for="gender-female">Female</label>
								</div>
							</div>
						</div>

                        <?php if ($userData['type'] == 1) : ?>

                            <div>
                                <input type="submit" class="btn btn-dark" name="update" value="Submit"/>
                            </div>

                        <?php endif; ?>

					</div>
				</div>

                <?php if ($userData['type'] == 2) : ?>

                    <div class="card border-dark">
                        <div class="card-header bg-dark text-white">
                            <h2 class="mb-0">Clinic Details</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputclinic">Clinic Name *</label>
                                <input type="text" class="form-control" id="inputclinic" name="name" placeholder="Name" required value="<?= $userData['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputadd">Address *</label>
                                <input type="text" class="form-control" id="inputadd" name="address" placeholder="Address" required value="<?= $userData['address']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required value="<?= $userData['contact']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="embed">Map *</label>
                                <textarea class="form-control" id="embed" rows="3" name="map" required><?= $userData['embed'] ? $userData['embed'] : ""; ?></textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Get embed map from <a href="//www.embedgooglemap.net/" target="_blank">here</a>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" rows="3" name="desc"><?= $userData['description'] ? $userData['description'] : ""; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="media" id="registration-upload" accept="image/*">
                                        <label class="custom-file-label" for="registration-upload" id="registration-upload-label"><?= $userData['filename'] ? $userData['filename'] : 'Choose file...'; ?></label>
                                    </div>	
                                </div>
                            </div>
                            <div class="form-group">
                                <img id="registration-img-preview" src="<?= $userData['filename'] ? "uploads/{$userData['filename']}" : '...'; ?>" alt="<?= $userData['filename'] ? $userData['filename'] : '...'; ?>" class="img-thumbnail <?= $userData['filename'] ? '' : 'd-none'; ?>" style="max-height: 250px;">
                            </div>
                            <div>
                                <input type="submit" class="btn btn-dark" name="update" value="Submit"/>
                            </div>
                        </div>
                    </div>
                
                <?php endif; ?>

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
			var file = e.target.files[0]
			var fileName = file.name
			var $imgPreview = $('#registration-img-preview')
			var reader  = new FileReader();

			reader.addEventListener("load", function () {
				$imgPreview.attr('src', reader.result)
			}, false);

			if (file) {
				reader.readAsDataURL(file);
			}
			
			$('#registration-upload-label').text(fileName)
			$imgPreview.attr('alt', fileName)
			$imgPreview.removeClass('d-none')		
        })
        
        $('#passwordToggleBtn').on('click', function(e) {
            $(this).addClass('d-none')
            $('#updatePassword').val(1)

            var $passwordBox = $('#passwordBox')
            $passwordBox.removeClass('d-none')
            $passwordBox.find('#inputpass').attr('disabled', false)
            $passwordBox.find('#inputpass1').attr('disabled', false)
        })
	})

</script>