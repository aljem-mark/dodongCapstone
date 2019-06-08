<?php include 'header.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

    if(isset($_GET['clinic_id'])) {
        $initialQuery = "";
        $where = [];

        $initialQuery = "SELECT *
            FROM `appointment_schedules`";

        $where[] = "clinic_id={$_GET['clinic_id']}";
        $whereClause = $where ? "WHERE " : "";
        $whereClause .= implode(' AND ', $where);
        $query = "{$initialQuery} {$whereClause}";

        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result)) :
            while ($row = mysqli_fetch_assoc($result)) :
                $aSData = $row;
            endwhile;
        else:
            $initialQuery = "INSERT INTO `appointment_schedules`
            (clinic_id)
            VALUES
            ({$_GET['clinic_id']})";

            $query = "{$initialQuery}";
            $result = mysqli_query($con, $query);
            
            $initialQuery = "";
            $where = [];

            $initialQuery = "SELECT *
                FROM `appointment_schedules`";

            $where[] = "clinic_id={$_GET['clinic_id']}";
            $whereClause = $where ? "WHERE " : "";
            $whereClause .= implode(' AND ', $where);
            $query = "{$initialQuery} {$whereClause}";

            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result)) : while ($row = mysqli_fetch_assoc($result)) :
                $aSData = $row;
            endwhile; endif;
        endif;
    } else {
        http_response_code( 303 ); header( "Location: {$_SESSION['homepage']}" ); exit;
    }

    $dates = [
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'
    ];

?>

	<div class="row justify-content-center mt-4 mb-5">
		<div class="col-md-5 col-12">
			<form action="clinic-manage-appointment-action.php" method="POST">
                <div class="card border-dark mb-4">
                    <input type="hidden" name="id" value="<?= $aSData['id']; ?>">

                    <div class="card-header bg-dark text-white">
						<h1 class="mb-0">Appointments/day</h1>
					</div>
					<div class="card-body">
                        <?php foreach ($dates as $key => $date) : ?>

                            <div class="form-group">
                                <label for="<?= $date; ?>" class="text-capitalize"><?= $date; ?></label>
                                <input type="number" class="form-control" id="<?= $date; ?>" name="<?= $date; ?>" placeholder="<?= ucfirst($date); ?>" value="<?= $aSData[$date]; ?>">
                            </div>
                        
                        <?php endforeach; ?>

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