<?php include 'header.php'; ?>

<?php

	if(isset($_GET['filter'])) {
		$filter = $_GET;
	} else {
		$filter = [
			'f' => '',
			'drt' => 'date_created',
			'date_start' => '',
			'date_end' => '',
			'c' => 'id',
			'd' => 'asc'
		];
	}

	$initialQuery = "SELECT *
		FROM `clinic_services`";

	$where[] = "WHERE clinic_id={$_SESSION['ClinicID']}";
	
	if($filter['f']) {
		$filterWhere = [];
		$filterVal = "%" . preg_replace('/\s+/', '%', $filter['f']) . "%";

		$filterWhere[] = "service_name LIKE '{$filterVal}'";
		$filterWhere[] = "description LIKE '{$filterVal}'";

		if($filterWhere) $where[] = "(" . implode(" OR ", $filterWhere) . ")";
	}

	if($filter['date_start'] && $filter['date_end']) {
		$where[] = "( {$filter['drt']} BETWEEN '{$filter['date_start']}' AND '{$filter['date_end']}' )";
	} elseif($filter['date_start']) {
		$where[] = "( {$filter['drt']} >= '{$filter['date_start']}' )";
	} elseif($filter['date_end']) {
		$where[] = "( {$filter['drt']} <= '{$filter['date_end']}' )";
	}

	if($filter['c']) {
		$order[] = "{$filter['c']} " . strtoupper($filter['d']);

		if($filter['c'] != 'service_name') {
			if($filter['c'] == 'date_created') {
				$order[] = "service_name";
			}

			if($filter['c'] == 'date_updated') {
				$order[] = "service_name";
			}
		}

		$orderClause = "ORDER BY " . implode(", ", $order);
	}
	
	$whereClause = implode(" AND ", $where);

	$query = "{$initialQuery} {$whereClause} {$orderClause}";

?>

	<div class="row align-items-end my-4">
		<div class="col">
			<h1 class="mb-0">Clinic Services</h1>
		</div>
		<div class="col-auto">
			<button class="btn btn-success btn-lg shadow" title="Add Clinic Service" data-toggle="modal" data-target="#service-modal" data-action-type="Add"><i class="fas fa-plus"></i></button>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col">
			<form method="POST" action="dentist-services-action.php" id="services-filter-form" class="border border-dark rounded shadow p-3">
				<div class="form-row align-items-end mb-3">
					<div class="col-3 mr-auto">
						<label for="services-search-bar">(Service name and Description)</label>
						<div class="input-group shadow">
							<input type="search" class="form-control" id="services-search-bar" name="f" aria-label="Search for ..." placeholder="Search for ..." aria-describedby="search-icon" value="<?= $filter['f']; ?>"/>
							<div class="input-group-append">
								<span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<label for="service-date-type">Date Range Type</label>
						<select class="form-control shadow" id="service-date-type" name="drt" data-reset-value="date_created">
							<option value="date_created" <?= $filter['drt'] == 'date_created' ? ' selected="selected"' : ''; ?>>Date Created</option>
							<option value="date_updated" <?= $filter['drt'] == 'date_updated' ? ' selected="selected"' : ''; ?>>Date Updated</option>
						</select>
					</div>
					<div class="col-auto">
						<label for="service-date-start">Date Start</label>
						<input type="date" class="form-control shadow" id="service-date-start" name="date_start" value="<?= $filter['date_start']; ?>"/>
					</div>
					<div class="col-auto">
						<label for="service-date-end">Date End</label>
						<input type="date" class="form-control shadow" id="service-date-end" name="date_end" value="<?= $filter['date_end']; ?>"/>
					</div>
					<div class="col-auto">
						<label for="services-sort-column">Column</label>
						<select class="form-control shadow" id="services-sort-column" name="c" data-reset-value="id">
							<option value="id" <?= $filter['c'] == 'id' ? ' selected="selected"' : ''; ?>>ID</option>
							<option value="service_name" <?= $filter['c'] == 'service_name' ? ' selected="selected"' : ''; ?>>Service Name</option>
							<option value="description" <?= $filter['c'] == 'description' ? ' selected="selected"' : ''; ?>>Description</option>
							<option value="date_created" <?= $filter['c'] == 'date_created' ? ' selected="selected"' : ''; ?>>Date Created</option>
							<option value="date_updated" <?= $filter['c'] == 'date_updated' ? ' selected="selected"' : ''; ?>>Date Updated</option>
						</select>
					</div>
					<div class="col-auto">
						<label class="sr-only" for="services-sort-direction">Sort Direction</label>
						<select class="form-control shadow" id="services-sort-direction" name="d" data-reset-value="asc">
							<option value="asc" <?= $filter['d'] == 'asc' ? ' selected="selected"' : ''; ?>>ASC</option>
							<option value="desc" <?= $filter['d'] == 'desc' ? ' selected="selected"' : ''; ?>>DESC</option>
						</select>
					</div>
				</div>
				<div class="form-row align-items-end">
					<div class="col-auto">
						<button type="button" class="btn btn-dark shadow" id="services-reset-filter">Reset</button>
						<button type="submit" class="btn btn-primary shadow" name="filter" value="1" data-reset-value="1" id="services-filter-submit">Filter</button>
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
							<th scope="col">Service Name</th>
							<th scope="col">Description</th>
							<th scope="col">Price</th>
							<th scope="col">Date Created</th>
							<th scope="col">Date Updated</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php if($result = mysqli_query($con, $query)) : while ($row = mysqli_fetch_assoc($result)) : ?>

						<tr>
							<td scope="row"><?= $row['id']; ?></td>
							<td><?= $row['service_name']; ?></td>
							<td><p class="m-0" style="max-width: 300px;"><?= $row['description']; ?></p></td>
							<td>
								<?php

									$newNumFormat = number_format($row['price'], 2);

									echo $newNumFormat;

								?>
							</td>
							<td>

								<?php

									$time = strtotime($row['date_created']);
									$newformat = date('F j, Y',$time);

									echo $newformat;

								?>

							</td>
							<td>

								<?php

									if($row['date_updated']) {
										$time = strtotime($row['date_updated']);
										$newformat = date('F j, Y',$time);

										echo $newformat;
									} else {
										echo "-";
									}

								?>

							</td>
							<td>
								<form method="POST" action="dentist-services-action.php">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">

										<!-- Trigger Modal -->
										<button type="button" data-toggle="modal" data-target="#service-modal" data-action-type="Update" data-service='<?= json_encode($row); ?>' class="btn btn-primary btn-sm">Update</button>

										<!-- Set Service to Enable/Disable -->
										<?php if($row['enabled']) : ?>

											<button type="submit" value="disable" name="action" class="btn btn-danger btn-sm">Disable</button>

										<?php else : ?>

											<button type="submit" value="enable" name="action" class="btn btn-success btn-sm">Enable</button>
											
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

	<!-- Modal for Add/Update Service -->
	<div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal-label" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form method="POST" action="dentist-services-action.php">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="service-modal-label">Add Clinic Service</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" id="service-id">
						<div class="form-group">
							<label for="service-name">Service Name *</label>
							<input type="text" class="form-control" name="service_name" id="service-name" placeholder="Service Name" required>
						</div>
						<div class="form-group">
							<label for="service-description">Description</label>
							<textarea class="form-control" name="description" id="service-description" placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<label for="service-price">Price *</label>
							<input type="text" class="form-control" name="price" id="service-price" placeholder="Price" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="action" class="btn btn-primary" value="save">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php include 'footer.php'; ?>

<script>

	$(document).ready(function (){
		$('#service-modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var data = button.data('service')
			var actionType = button.data('actionType')

			var modal = $(this)
			modal.find('.modal-title').text(`${actionType} Clinic Service`)
			if(data) {
				modal.find('#service-id').val(data.id)
				modal.find('#service-name').val(data.service_name)
				modal.find('#service-description').text(data.description)
				modal.find('#service-price').val(data.price)
			}
		})

		$('#service-modal').on('hidden.bs.modal', function(){
			$(this).find('form')[0].reset();
			$(this).find('#service-id').val("")
			$(this).find('#service-description').text("")
		});

		$('#services-reset-filter').on('click', function(e) {
			var filterForm = document.getElementById('services-filter-form')

			for (var i = 0; i < filterForm.elements.length; i++) {
				if(typeof $(filterForm.elements.item(i)).data('resetValue') === 'undefined') {
					filterForm.elements[i].value = ''
				} else {
					filterForm.elements[i].value = $(filterForm.elements.item(i)).data('resetValue')
				}
			}

			$('#services-filter-submit').click()
		})
	})

</script>