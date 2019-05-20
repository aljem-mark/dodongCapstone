<?php include 'header.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php
	
	if(isset($_GET['filter'])) {
		$filter = $_GET;
	} else {
		$filter = [
			'f' => '',
			'drt' => 'date_created',
			'date_start' => date('Y-m-d'),
			'date_end' => '',
			's' => 'all',
			'c' => 'id',
			'd' => 'asc'
		];
	}

	$initialQuery = "SELECT a.*, cs.service_name, cs.price
		FROM `appointments` as a
		LEFT JOIN `clinic_services` as cs ON cs.id = a.idServ";

	$where[] = "WHERE a.clinic_id={$_SESSION['ClinicID']}";
	
	if($filter['f']) {
		$filterWhere = [];
		$filterVal = "%" . preg_replace('/\s+/', '%', $filter['f']) . "%";

		$filterWhere[] = "a.customer_name LIKE '{$filterVal}'";
		$filterWhere[] = "a.customer_contact LIKE '{$filterVal}'";
		$filterWhere[] = "cs.service_name LIKE '{$filterVal}'";
		$filterWhere[] = "a.description LIKE '{$filterVal}'";

		if($filterWhere) $where[] = "(" . implode(" OR ", $filterWhere) . ")";
	}

	if($filter['s'] != 'all') {
		$where[] = "a.status='{$filter['s']}'";
	}

	if($filter['date_start'] && $filter['date_end']) {
		$where[] = "( a.{$filter['drt']} BETWEEN '{$filter['date_start']}' AND '{$filter['date_end']}' )";
	} elseif($filter['date_start']) {
		$where[] = "( a.{$filter['drt']} >= '{$filter['date_start']}' )";
	} elseif($filter['date_end']) {
		$where[] = "( a.{$filter['drt']} <= '{$filter['date_end']}' )";
	}

	if($filter['c']) {
		$order[] = "{$filter['c']} " . strtoupper($filter['d']);

		if($filter['c'] != 'customer_name') {
			if($filter['c'] == 'date_created') {
				$order[] = "customer_name " . strtoupper($filter['d']);
			}

			if($filter['c'] == 'appointment_date') {
				$order[] = "customer_name " . strtoupper($filter['d']);
			}

			if($filter['s'] != 'all') {
				$order[] = "customer_name " . strtoupper($filter['d']);
			}
		}

		$orderClause = "ORDER BY " . implode(", ", $order);
	}
	
	$whereClause = implode(" AND ", $where);

	$query = "{$initialQuery} {$whereClause} {$orderClause}";

?>

	<div class="row my-4 align-items-end">
		<div class="col">
			<h1 class="mb-0">Appointments</h1>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col">
			<form method="POST" action="dentist-appointment-action.php" id="appointment-filter-form" class="border border-dark rounded shadow p-3">
				<div class="form-row align-items-end mb-3">
					<div class="col-3 mr-auto">
						<label for="appointment-search-bar" class="font-weight-bold">(Customer, Contact No., Service and Description)</label>
						<div class="input-group shadow">
							<input type="search" class="form-control" id="appointment-search-bar" name="f" aria-label="Search for ..." placeholder="Search for ..." aria-describedby="search-icon" value="<?= $filter['f']; ?>"/>
							<div class="input-group-append">
								<span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<label for="appointment-date-type" class="font-weight-bold">Date Range Type</label>
						<select class="form-control shadow" id="appointment-date-type" name="drt" data-reset-value="date_created">
							<option value="date_created" <?= $filter['drt'] == 'date_created' ? ' selected="selected"' : ''; ?>>Date Requested</option>
							<option value="appointment_date" <?= $filter['drt'] == 'appointment_date' ? ' selected="selected"' : ''; ?>>Appointment Date</option>
						</select>
					</div>
					<div class="col-auto">
						<label for="appointment-date-start" class="font-weight-bold">Date Start</label>
						<input type="date" class="form-control shadow" id="appointment-date-start" name="date_start" value="<?= $filter['date_start']; ?>" data-reset-value="<?= date('Y-m-d'); ?>"/>
					</div>
					<div class="col-auto">
						<label for="appointment-date-end" class="font-weight-bold">Date End</label>
						<input type="date" class="form-control shadow" id="appointment-date-end" name="date_end" value="<?= $filter['date_end']; ?>"/>
					</div>
					<div class="col-auto">
						<label for="appointment-sort-status" class="font-weight-bold">Status</label>
						<select class="form-control shadow" id="appointment-sort-status" name="s" data-reset-value="all">
							<option value="all" <?= $filter['s'] == 'all' ? ' selected="selected"' : ''; ?>>All</option>
							<option value="pending" <?= $filter['s'] == 'pending' ? ' selected="selected"' : ''; ?>>Pending</option>
							<option value="accepted" <?= $filter['s'] == 'accepted' ? ' selected="selected"' : ''; ?>>Accepted</option>
							<option value="declined" <?= $filter['s'] == 'declined' ? ' selected="selected"' : ''; ?>>Declined</option>
							<option value="cancelled" <?= $filter['s'] == 'cancelled' ? ' selected="selected"' : ''; ?>>Cancelled</option>
							<option value="done" <?= $filter['s'] == 'done' ? ' selected="selected"' : ''; ?>>Done</option>
						</select>
					</div>
					<div class="col-auto">
						<label for="appointment-sort-column" class="font-weight-bold">Sort By</label>
						<select class="form-control shadow" id="appointment-sort-column" name="c" data-reset-value="id">
							<option value="id" <?= $filter['c'] == 'id' ? ' selected="selected"' : ''; ?>>ID</option>
							<option value="customer_name" <?= $filter['c'] == 'customer_name' ? ' selected="selected"' : ''; ?>>Customer</option>
							<option value="description" <?= $filter['c'] == 'description' ? ' selected="selected"' : ''; ?>>Description</option>
							<option value="date_created" <?= $filter['c'] == 'date_created' ? ' selected="selected"' : ''; ?>>Date Requested</option>
							<option value="appointment_date" <?= $filter['c'] == 'appointment_date' ? ' selected="selected"' : ''; ?>>Appointment Date</option>
							<option value="status" <?= $filter['c'] == 'status' ? ' selected="selected"' : ''; ?>>Status</option>
						</select>
					</div>
					<div class="col-auto">
						<label class="sr-only" for="appointment-sort-direction">Sort Direction</label>
						<select class="form-control shadow" id="appointment-sort-direction" name="d" data-reset-value="asc">
							<option value="asc" <?= $filter['d'] == 'asc' ? ' selected="selected"' : ''; ?>>ASC</option>
							<option value="desc" <?= $filter['d'] == 'desc' ? ' selected="selected"' : ''; ?>>DESC</option>
						</select>
					</div>
				</div>
				<div class="form-row align-items-end">
					<div class="col-auto">
						<button type="button" class="btn btn-dark shadow" id="appointment-reset-filter">Reset</button>
						<button type="submit" class="btn btn-primary shadow" name="filter" value="1" data-reset-value="1" id="appointment-filter-submit">Filter</button>
					</div>
				</div>
			</form>
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
							<th scope="col">Appointment Date</th>
							<th scope="col">Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
							
						<?php

							$result = mysqli_query($con, $query);
							if(mysqli_num_rows($result)) : while ($row = mysqli_fetch_assoc($result)) :
							
						?>

						<tr>
							<th scope="row"><?= $row['id']; ?></th>
							<td><?= $row['customer_name']; ?></td>
							<td><?= $row['customer_contact']; ?></td>
							<td>
								<?php

									$newNumFormat = number_format($row['price'], 2);

									echo "{$row['service_name']} <span class='font-weight-bold'>({$newNumFormat})</span>";

								?>
							</td>
							<td><p class="m-0" style="max-width: 300px;"><?= $row['description']; ?></p></td>
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

										case 'declined':
											$statusClass = "danger";
											break;

										case 'cancelled':
											$statusClass = "secondary";
											break;

										case 'done':
											$statusClass = "success";
											break;
										
										default:
											$statusClass = "warning";
											break;
									}

								?>

								<h5><span class="badge badge-<?= $statusClass; ?> badge-pill text-capitalize"><?= $row['status']; ?></span></h5>
							</td>
							<td>
								<form method="POST" action="dentist-appointment-action.php">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">
									
									<?php if($row['status'] == 'pending') : ?>

										<!-- Trigger Accept Modal -->
										<button type="button" data-toggle="modal" data-target="#accept-request-modal" data-id="<?= $row['id']; ?>" data-action-type="Accept" class="btn btn-primary btn-sm">Accept</button>
										<!-- Decline Appointment -->
										<button type="submit" value="declined" name="action" class="btn btn-danger btn-sm">Decline</button>
									
									<?php elseif($row['status'] == 'accepted') : ?>

										<button type="submit" value="done" name="action" class="btn btn-success btn-sm">Done</button>
										<button type="button" data-toggle="modal" data-target="#accept-request-modal" data-id="<?= $row['id']; ?>" data-date="<?= date('Y-m-d', strtotime($row['appointment_date'])); ?>" data-action-type="Reschedule" class="btn btn-info btn-sm">Reschedule</button>
										<button type="submit" value="cancelled" name="action" class="btn btn-secondary btn-sm">Cancel</button>
									
									<?php endif; ?>
									
								</form>
							</td>
						</tr>

						<?php endwhile; mysqli_free_result($result); endif; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal for Accept -->
	<div class="modal fade" id="accept-request-modal" tabindex="-1" role="dialog" aria-labelledby="accept-request-modal-label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="POST" action="dentist-appointment-action.php">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="accept-request-modal-label">Accept Request</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" id="appointment-id">

						<div id="appointment-modal-error" class="alert alert-danger d-none" role="alert">
							<h4 class="alert-heading">Oops.</h4>
							<p class="mb-0" id="appointment-modal-error-message">An error occured while sending your request. Please try again.</p>
						</div>

						<div class="form-group">
							<label for="appointment-date">Appointment Date *</label>
							<input type="date" min="<?= date('Y-m-d'); ?>" class="form-control" name="appointment_date" id="appointment-date" placeholder="Full Name" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="action" id="appointment-modal-submit" class="btn btn-primary" value="accepted">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php include 'footer.php'; ?>

<script>

	$(document).ready(function (){
		$('#accept-request-modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var date = button.data('date')
			var actionType = button.data('actionType')

			var modal = $(this)
			modal.find('.modal-title').text(`${actionType} Request`)
			modal.find('input[type=hidden]#appointment-id').val(id)
			modal.find('input[type=date]#appointment-date').val(date)
		})

		$('#appointment-date-start').on('change', function (e) {
			$('#appointment-date-end').attr('min', $(this).val())
		});

		$('#appointment-reset-filter').on('click', function(e) {
			var filterForm = document.getElementById('appointment-filter-form')

			for (var i = 0; i < filterForm.elements.length; i++) {
				if(typeof $(filterForm.elements.item(i)).data('resetValue') === 'undefined') {
					filterForm.elements[i].value = ''
				} else {
					filterForm.elements[i].value = $(filterForm.elements.item(i)).data('resetValue')
				}
			}

			$('#appointment-filter-submit').click()
		})

		$('#appointment-date').on('change', function(e) {
			selectedDate = $(this).val()

			var data = {date: selectedDate}
			$.get('ajax-date-validation.php', data, function(response) {
				if(response.error) {
					$('#appointment-modal-submit').attr('disabled', true)
					$('#appointment-modal-error-message').text(response.error)
					$('#appointment-modal-error').removeClass('d-none')
				} else {
					$('#appointment-modal-submit').attr('disabled', false)
					$('#appointment-modal-error').addClass('d-none')
				}
			}, "json");
		})
	})

	$(window).on('load', function(){
		$('#appointment-date-end').attr('min', $('#appointment-date-start').val())
	})

</script>