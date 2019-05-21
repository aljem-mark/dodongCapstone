<?php include 'header.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

	if(isset($_GET['filter'])) {
		$filter = $_GET;
	} else {
		$filter = [
			'f' => '',
			's' => 'all',
			'c' => 'name',
			'd' => 'asc'
		];
	}

	$initialQuery = "SELECT c.*,
        u.filename
        FROM `clinic` as c
        LEFT JOIN `user` as us
        ON us.id=c.user_id
        LEFT JOIN `uploads` as u
        ON u.id=c.profile_media_id";

    $where = [];
    $where[] = "c.deleted_at IS NULL";
    $where[] = "us.deleted_at IS NULL";
	
	if($filter['f']) {
		$filterWhere = [];
		$filterVal = "%" . preg_replace('/\s+/', '%', $filter['f']) . "%";

		$filterWhere[] = "c.name LIKE '{$filterVal}'";
		$filterWhere[] = "c.address LIKE '{$filterVal}'";
		$filterWhere[] = "c.contact LIKE '{$filterVal}'";
		$filterWhere[] = "c.description LIKE '{$filterVal}'";

		if($filterWhere) $where[] = "(" . implode(" OR ", $filterWhere) . ")";
	}

	if($filter['s'] != 'all') {
		$where[] = "c.status='{$filter['s']}'";
	}

	if($filter['c']) {
		$order[] = "{$filter['c']} " . strtoupper($filter['d']);

		if($filter['c'] != 'name') {
            $order[] = "c.name " . strtoupper($filter['d']);
		}

		$orderClause = "ORDER BY " . implode(", ", $order);
    }

    $whereClause = $where ? "WHERE " : "";
	$whereClause .= implode(" AND ", $where);

    $query = "{$initialQuery} {$whereClause} {$orderClause}";

?>

    <div class="row align-items-end my-4">
		<div class="col">
			<h1 class="mb-0">Clinics</h1>
		</div>
	</div>
	<div class="row my-4">
		<div class="col">
			<form method="POST" action="admin-action.php" id="admin-clinic-filter-form" class="border border-dark rounded shadow p-3">
				<div class="form-row align-items-end mb-3">
					<div class="col-6 mr-auto">
						<label for="admin-clinic-search-bar" class="font-weight-bold">(Clinic, Dentist and Location)</label>
						<div class="input-group shadow">
							<input type="search" class="form-control" id="admin-clinic-search-bar" name="f" aria-label="Search for ..." placeholder="Search for ..." aria-describedby="search-icon" value="<?= $filter['f']; ?>"/>
							<div class="input-group-append">
								<span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<label for="appointment-sort-status" class="font-weight-bold">Status</label>
						<select class="form-control shadow" id="appointment-sort-status" name="s" data-reset-value="all">
							<option value="all" <?= $filter['s'] == 'all' ? ' selected="selected"' : ''; ?>>All</option>
							<option value="pending" <?= $filter['s'] == 'pending' ? ' selected="selected"' : ''; ?>>Pending</option>
							<option value="declined" <?= $filter['s'] == 'declined' ? ' selected="selected"' : ''; ?>>Declined</option>
							<option value="disabled" <?= $filter['s'] == 'disabled' ? ' selected="selected"' : ''; ?>>Disabled</option>
							<option value="verified" <?= $filter['s'] == 'verified' ? ' selected="selected"' : ''; ?>>Verified</option>
						</select>
					</div>
					<div class="col-auto">
						<label for="admin-clinic-sort-column" class="font-weight-bold">Sort By</label>
						<select class="form-control shadow" id="admin-clinic-sort-column" name="c" data-reset-value="name">
							<option value="name" <?= $filter['c'] == 'name' ? ' selected="selected"' : ''; ?>>Clinic</option>
							<option value="description" <?= $filter['c'] == 'description' ? ' selected="selected"' : ''; ?>>Description</option>
							<option value="status" <?= $filter['c'] == 'status' ? ' selected="selected"' : ''; ?>>Status</option>
						</select>
					</div>
					<div class="col-auto">
						<label class="sr-only" for="admin-clinic-sort-direction">Sort Direction</label>
						<select class="form-control shadow" id="admin-clinic-sort-direction" name="d" data-reset-value="asc">
							<option value="asc" <?= $filter['d'] == 'asc' ? ' selected="selected"' : ''; ?>>ASC</option>
							<option value="desc" <?= $filter['d'] == 'desc' ? ' selected="selected"' : ''; ?>>DESC</option>
						</select>
					</div>
				</div>
				<div class="form-row align-items-end">
					<div class="col-auto">
						<button type="button" class="btn btn-dark shadow" id="admin-clinic-reset-filter">Reset</button>
						<button type="submit" class="btn btn-primary shadow" name="filter" value="1" data-reset-value="1" id="admin-clinic-filter-submit">Filter</button>
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
							<th scope="col">Preview</th>
							<th scope="col">Clinic</th>
							<th scope="col">Description</th>
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
							<td scope="row">
                                <!-- Profile Image -->
                                <div>
                                    <img src="<?= $row['filename'] ? "uploads/" . $row['filename'] : "img/loc.png"; ?>" style="max-width: 140px; height: auto;"/>
                                </div>
                            </td>
							<td>
                                <div class="row mb-4">
                                    <div class="col">
                                        <h3 class="mb-0"><?= $row['name']; ?></h2>
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-map-marker"></i>
                                    </div>
                                    <div class="col-auto">
                                        <p class="m-0"><?= $row['address']; ?></p>
                                    </div>
                                </div>
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="fas fa-phone fa-flip-horizontal"></i>
                                    </div>
                                    <div class="col-auto">
                                        <p class="m-0"><?= $row['contact']; ?></p>
                                    </div>
                                </div>
                            </td>
							<td><p class="m-0" style="max-width: 300px;"><?= $row['description']; ?></p></td>
							<td>
							
                                <?php

                                    switch ($row['status']) {
                                        case 'pending':
                                            $statusClass = "warning";
                                            break;

                                        case 'declined':
                                            $statusClass = "danger";
                                            break;

										case 'disabled':
											$statusClass = "secondary";
											break;

                                        case 'verified':
                                            $statusClass = "success";
                                            break;
                                        
                                        default:
                                            $statusClass = "warning";
                                            break;
                                    }

                                ?>

                                <h5><span class="badge badge-<?= $statusClass; ?> badge-pill text-capitalize"><?= $row['status']; ?></span></h5></td>
							<td>
								<form method="POST" action="admin-action.php">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">

                                    <!-- Trigger Modal -->
                                    <button type="button" data-toggle="modal" data-target="#clinicEmbedMap" data-clinic="<?= $row['name'] ?>" data-embed="<?= $row["embed"]; ?>" class="btn btn-info btn-sm">Show Map</button>

                                    
									<!-- Update Status Buttons -->
                                    <?php if ($row['status'] == 'verified') : ?>

                                        <button type="submit" value="disabled" name="action" class="btn btn-secondary btn-sm">Disable</button>

                                    <?php elseif ($row['status'] == 'disabled') : ?>

                                        <button type="submit" value="verified" name="action" class="btn btn-success btn-sm">Enable</button>

                                    <?php elseif ($row['status'] == 'pending') : ?>

                                        <button type="submit" value="declined" name="action" class="btn btn-danger btn-sm">Decline</button>
                                        <button type="submit" value="verified" name="action" class="btn btn-success btn-sm">Verify</button>

                                    <?php endif; ?>
									
									<!-- Trigger Delete Modal -->
									<button type="button" data-toggle="modal" data-target="#delete-modal" data-id="<?= $row['id']; ?>" data-table="clinic" class="btn btn-danger btn-sm" title="delete"><i class="fas fa-times"></i></button>
								</form>
							</td>
						</tr>

						<?php endwhile; mysqli_free_result($result); endif; ?>

					</tbody>
				</table>
			</div>
		</div>
    </div>
    
    <!-- Modal For Embed Map -->
    <div class="modal fade" id="clinicEmbedMap" tabindex="-1" role="dialog" aria-labelledby="clinicEmbedMap">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Embed Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-auto" id="embed-map-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

	<!-- Delete Modal -->
	<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="POST" action="admin-action.php">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="delete-modal-label">Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" id="delete-id">
						<input type="hidden" name="delete-table" id="delete-table">

						<p class="mb-0" id="delete-modal-error-message">Are you sure you want to delete this item?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="action" id="delete-modal-submit" class="btn btn-primary" value="delete">Accept</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php include'footer.php'; ?>

<script type="text/javascript">

    $(document).ready(function (){
		// EVENTS

		// Delete Modal
		$('#delete-modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var table = button.data('table')

			var modal = $(this)
			modal.find('input[type=hidden]#delete-id').val(id)
			modal.find('input[type=hidden]#delete-table').val(table)
		})

		// Show Map
		$('#clinicEmbedMap').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var clinic = button.data('clinic')
			var embedMap = button.data('embed')

            var modal = $(this)
            modal.find('.modal-title').text(`${clinic}`)
            modal.find('#embed-map-container').html(embedMap)
        })

		// Reset all filter to default
        $('#admin-clinic-reset-filter').on('click', function(e) {
            var filterForm = document.getElementById('admin-clinic-filter-form')

            for (var i = 0; i < filterForm.elements.length; i++) {
                if(typeof $(filterForm.elements.item(i)).data('resetValue') === 'undefined') {
                    filterForm.elements[i].value = ''
                } else {
                    filterForm.elements[i].value = $(filterForm.elements.item(i)).data('resetValue')
                }
            }

            $('#admin-clinic-filter-submit').click()
        })
    })

</script>