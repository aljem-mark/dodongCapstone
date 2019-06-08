<?php include'header.php'; ?>

<?php

	if(isset($_GET['filter'])) {
		$filter = $_GET;
	} else {
		$filter = [
			'f' => '',
			'c' => 'name',
			'd' => 'asc'
		];
	}

	$initialQuery = "SELECT c.*,
        GROUP_CONCAT(CONCAT(cs.service_name,'<!!!>',cs.price,'<!!!>',cs.enabled) ORDER BY cs.service_name ASC SEPARATOR '|') as services,
        u.filename
        FROM `clinic` as c
        LEFT JOIN `user` as us
        ON us.id=c.user_id
        LEFT JOIN `clinic_services` as cs
        ON (cs.clinic_id=c.id AND cs.deleted_at IS NULL)
        LEFT JOIN `uploads` as u
        ON u.id=c.profile_media_id";

    $where = [];
    $where[] = "c.status='verified'";
    $where[] = "c.deleted_at IS NULL";
    $where[] = "us.deleted_at IS NULL";
	
	if($filter['f']) {
		$filterWhere = [];
		$filterVal = "%" . preg_replace('/\s+/', '%', $filter['f']) . "%";

		$filterWhere[] = "c.name LIKE '{$filterVal}'";
		$filterWhere[] = "c.address LIKE '{$filterVal}'";
		$filterWhere[] = "c.contact LIKE '{$filterVal}'";
		$filterWhere[] = "cs.service_name LIKE '{$filterVal}'";
		$filterWhere[] = "cs.price LIKE '{$filterVal}'";

		if($filterWhere) $where[] = "(" . implode(" OR ", $filterWhere) . ")";
	}

	if($filter['c']) {
		$order[] = "{$filter['c']} " . strtoupper($filter['d']);

		if($filter['c'] != 'name') {
            $order[] = "c.name " . strtoupper($filter['d']);
		}

		$orderClause = "ORDER BY " . implode(", ", $order);
    }

	if($where) {
        $whereClause = "WHERE ";
    } else {
        $whereClause = "";
    }

	$whereClause .= implode(" AND ", $where);

    $query = "{$initialQuery} {$whereClause} GROUP BY c.id {$orderClause}";

?>

    <h1 class="sr-only mb-0">Dental Finder</h1>

	<div class="row my-4">
		<div class="col">
			<form method="POST" action="search-engine-action.php" id="search-engine-filter-form">
				<div class="form-row align-items-end mb-3">
					<div class="col-6 mr-auto">
						<label for="search-engine-search-bar" class="sr-only">Search for (Clinic, Dentist, Services and Location)</label>
						<div class="input-group shadow">
							<input type="search" class="form-control" id="search-engine-search-bar" name="f" aria-label="Search for ..." placeholder="Search for ..." aria-describedby="search-icon" value="<?= $filter['f']; ?>"/>
							<div class="input-group-append">
								<span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<label for="search-engine-sort-column" class="font-weight-bold">Sort By</label>
						<select class="form-control shadow" id="search-engine-sort-column" name="c" data-reset-value="name">
							<option value="name" <?= $filter['c'] == 'name' ? ' selected="selected"' : ''; ?>>Clinic</option>
							<option value="description" <?= $filter['c'] == 'description' ? ' selected="selected"' : ''; ?>>Description</option>
							<option value="price" <?= $filter['c'] == 'price' ? ' selected="selected"' : ''; ?>>Price</option>
						</select>
					</div>
					<div class="col-auto">
						<label class="sr-only" for="search-engine-sort-direction">Sort Direction</label>
						<select class="form-control shadow" id="search-engine-sort-direction" name="d" data-reset-value="asc">
							<option value="asc" <?= $filter['d'] == 'asc' ? ' selected="selected"' : ''; ?>>ASC</option>
							<option value="desc" <?= $filter['d'] == 'desc' ? ' selected="selected"' : ''; ?>>DESC</option>
						</select>
					</div>
				</div>
				<div class="form-row align-items-end">
					<div class="col-auto">
						<button type="button" class="btn btn-dark shadow" id="search-engine-reset-filter">Reset</button>
						<button type="submit" class="btn btn-primary shadow" name="filter" value="1" data-reset-value="1" id="search-engine-filter-submit">Filter</button>
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
							<th scope="col">Services Offered</th>
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

                                    if ($row['services']) :
                                
                                    $services = explode("|", $row['services']);

                                ?>
                                
                                <ul class="list-group list-group-overflow">

                                    <?php
                                
                                        if ($services) foreach ($services as $key => $value) :
                                            $service = explode("<!!!>", $value);
                                            $serviceName = $service[0];
                                            $servicePrice = number_format($service[1], 2);
                                            $serviceStatus = $service[2];
                                    ?>

                                        <li class='list-group-item <?= $serviceStatus ? '' : 'list-group-item-danger' ; ?>'>
                                            <div class="row justify-content-between">
                                                <div class="col-auto">
                                                    <h6 class="mb-0"><?= $serviceName; ?></h6>
                                                </div>
                                                <div class="col-auto">
                                                    <span><?= $servicePrice; ?></span>
                                                </div>
                                            </div>
                                        </li>

                                    <?php endforeach; ?>

                                </ul>

                                <?php else : ?>

                                    <li class='list-group-item list-group-item-info'>
                                        <h6 class="mb-0">No services registered</h6>
                                    </li>

                                <?php endif; ?>

							</td>
							<td>
								<form method="POST" action="search-engine-action.php">
									<input type="hidden" name="id" value="<?= $row['id']; ?>">

                                    <!-- Trigger Modal -->
                                    <button type="button" data-toggle="modal" data-target="#clinicEmbedMap" data-clinic="<?= $row['name'] ?>" data-embed="<?= $row["embed"]; ?>" class="btn btn-secondary btn-sm">Show Map</button>

                                    <!-- Link to Request Appointment -->
                                    <a href="appointment.php?clinic_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Request Appointment</button>
									
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

<?php include'footer.php'; ?>

<script type="text/javascript">

    function showEmbedMap(el) {
        var embedHtml = $(el).attr('data-embed');
        var $embedModalBody = $("#embed-map-container");

        $embedModalBody.html("");
        $embedModalBody.html(embedHtml);
    }

    $(document).ready(function (){
		$('#clinicEmbedMap').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var clinic = button.data('clinic')
			var embedMap = button.data('embed')

            var modal = $(this)
            modal.find('.modal-title').text(`${clinic}`)
            modal.find('#embed-map-container').html(embedMap)
        })

        $('#search-engine-reset-filter').on('click', function(e) {
            var filterForm = document.getElementById('search-engine-filter-form')

            for (var i = 0; i < filterForm.elements.length; i++) {
                if(typeof $(filterForm.elements.item(i)).data('resetValue') === 'undefined') {
                    filterForm.elements[i].value = ''
                } else {
                    filterForm.elements[i].value = $(filterForm.elements.item(i)).data('resetValue')
                }
            }

            $('#search-engine-filter-submit').click()
        })
    })

</script>