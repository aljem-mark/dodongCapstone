<?php include 'header.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

	if(isset($_GET['filter'])) {
		$filter = $_GET;
	} else {
		$filter = [
			'f' => '',
			'c' => 'email',
			'd' => 'asc'
		];
	}

	$initialQuery = "SELECT id,
        email,
        CONCAT(fname, ' ', mname, ' ', lname) as fullname,
		type
        FROM `user`";

    $where = [];
    $where[] = "deleted_at IS NULL";
	
	if($filter['f']) {
		$filterWhere = [];
		$filterVal = "%" . preg_replace('/\s+/', '%', $filter['f']) . "%";

		$filterWhere[] = "email LIKE '{$filterVal}'";
		$filterWhere[] = "CONCAT(fname, ' ', mname, ' ', lname) LIKE '{$filterVal}'";

		if($filterWhere) $where[] = "(" . implode(" OR ", $filterWhere) . ")";
	}

	if($filter['c']) {
		$order[] = "{$filter['c']} " . strtoupper($filter['d']);

		$orderClause = "ORDER BY " . implode(", ", $order);
    }

    $whereClause = $where ? "WHERE " : "";
	$whereClause .= implode(" AND ", $where);

    $query = "{$initialQuery} {$whereClause} {$orderClause}";

?>
    

    <?php if( isset($_SESSION['success'])) : ?>

        <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading"><span class="font-weight-bold"><?= $_SESSION['success']; ?></span> password has been reset successfully!</h4>
            <p class="mb-0">Password: <span class="font-weight-bold">1234</span></p>
        </div>
        
        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>
    <div class="row align-items-end my-4">
		<div class="col">
			<h1 class="mb-0">Users</h1>
		</div>
	</div>
	<div class="row my-4">
		<div class="col">
			<form method="POST" action="admin-action.php" id="admin-clinic-filter-form" class="border border-dark rounded shadow p-3">
				<div class="form-row align-items-end mb-3">
					<div class="col-6 mr-auto">
						<label for="admin-clinic-search-bar" class="font-weight-bold">(Email and Name)</label>
						<div class="input-group shadow">
							<input type="search" class="form-control" id="admin-clinic-search-bar" name="f" aria-label="Search for ..." placeholder="Search for ..." aria-describedby="search-icon" value="<?= $filter['f']; ?>"/>
							<div class="input-group-append">
								<span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<label for="admin-clinic-sort-column" class="font-weight-bold">Sort By</label>
						<select class="form-control shadow" id="admin-clinic-sort-column" name="c" data-reset-value="email">
							<option value="email" <?= $filter['c'] == 'email' ? ' selected="selected"' : ''; ?>>Email</option>
							<option value="fullname" <?= $filter['c'] == 'fullname' ? ' selected="selected"' : ''; ?>>Name</option>
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
							<th scope="col">Email</th>
							<th scope="col">Name</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
							
						<?php

                            $result = mysqli_query($con, $query);
							if(mysqli_num_rows($result)) : while ($row = mysqli_fetch_assoc($result)) :
							
						?>

						<tr>
							<td><?= $row['email']; ?></td>
							<td><?= $row['fullname']; ?></td>
							<td>
								<form method="POST" action="admin-action.php">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">
									<input type="hidden" name="email" value="<?= $row['email']; ?>">

                                    <button type="submit" class="btn btn-info btn-sm" name="action" value="resetPassword">Reset Password</button>
									
									<?php if ($row['type'] != 1) : ?>

										<!-- Trigger Delete Modal -->
										<button type="button" data-toggle="modal" data-target="#delete-modal" data-id="<?= $row['id']; ?>" data-table="user" class="btn btn-danger btn-sm" title="delete"><i class="fas fa-times"></i></button>
									
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
	})

</script>