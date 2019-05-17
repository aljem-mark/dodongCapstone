<?php include 'header.php'; ?>

<?php

	$query = "SELECT a.*, cs.service_name
		FROM `appointments` as a
		LEFT JOIN `clinic_services` as cs ON cs.id = a.idServ
		WHERE
		a.clinic_id=".$_SESSION['ClinicID'];

	$result = mysqli_query($con, $query);

?>

	<div class="row">
		<div class="col">
			<h1 class="my-3">Appointments</h1>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="table-responsive table-hover">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Customer</th>
							<th scope="col">Contact No.</th>
							<th scope="col">Service</th>
							<th scope="col">Description</th>
							<th scope="col">Date Requested</th>
							<th scope="col">Date Approved</th>
							<th scope="col">Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php

							while ($row = mysqli_fetch_assoc($result)) :

						?>

						<tr>
							<th scope="row"><?php echo $row['id']; ?></th>
							<td><?php echo $row['customer_name']; ?></td>
							<td><?php echo $row['customer_contact']; ?></td>
							<td><?php echo $row['service_name']; ?></td>
							<td><?php echo $row['description']; ?></td>
							<td>

								<?php

									$time = strtotime($row['date_created']);
									$newformat = date('F j, Y',$time);

									echo $newformat;

								?>

							</td>
							<td>

								<?php

									if($row['appointment_date']) {
										$time = strtotime($row['appointment_date']);
										$newformat = date('F j, Y',$time);

										echo $newformat;
									} else {
										echo "-";
									}

								?>

							</td>
							<td>
							
								<?php

									switch ($row['status']) {
										case 'pending':
											$statusClass = "warning";
											break;

										case 'accepted':
											$statusClass = "primary";
											break;

										case 'cancelled':
											$statusClass = "secondary";
											break;

										case 'declined':
											$statusClass = "danger";
											break;

										case 'done':
											$statusClass = "success";
											break;
										
										default:
											# code...
											break;
									}

								?>

								<h5><span class="badge badge-<?php echo $statusClass; ?> badge-pill text-capitalize"><?php echo $row['status']; ?></span></h5>
							</td>
							<td>
								<form method="POST" action="dentist-appointment-action.php">
									<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									
									<?php if($row['status'] == 'pending') : ?>

										<!-- Trigger Accept Modal -->
										<button type="button" data-toggle="modal" data-target="#acceptRequestModal" data-id="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Accept</button>
										<!-- Decline Appointment -->
										<button type="submit" value="declined" name="decline" class="btn btn-danger btn-sm">Decline</button>
									
									<?php elseif($row['status'] == 'accepted') : ?>

										<button type="submit" value="done" name="done" class="btn btn-success btn-sm">Done</button>
										<button type="submit" value="cancelled" name="cancel" class="btn btn-secondary btn-sm">Cancel</button>
									
									<?php endif; ?>
									
								</form>
							</td>
						</tr>

						<?php endwhile; mysqli_free_result($result); ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal for Accept -->
	<div class="modal fade" id="acceptRequestModal" tabindex="-1" role="dialog" aria-labelledby="acceptRequestModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="POST" action="dentist-appointment-action.php">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="acceptRequestModalLabel">Accept Request</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id">

						<div class="form-group">
							<label for="appointmentDate">Appointment Date *</label>
							<input type="date" class="form-control" name="appointment_date" id="appointmentDate" placeholder="Full Name" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="accept" class="btn btn-primary" value="accepted">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php include 'footer.php'; ?>

<script>

	$('#acceptRequestModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')

		var modal = $(this)
		modal.find('input[type=hidden][name=id]').val(id)
	})

</script>