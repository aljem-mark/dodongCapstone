<div class="container-fluid">
	<div class="row">
		<nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">
				<ul class="nav flex-column">

					<?php if($_SESSION['userType'] == 1) : ?>

						<li class="nav-item">
							<a class="nav-link" href="admin-index.php">
								<div class="row">
									<div class="col-1">
										<i class="fas fa-clinic-medical"></i>
									</div>
									<div class="col">
										Clinics

										<?php

											$initialQuery = "SELECT count(*) as status_count
												FROM `clinic`";

											$where[] = "WHERE status='pending'";
											$whereClause = implode(" AND ", $where);
											$query = "{$initialQuery} {$whereClause}";
									
											if($result = mysqli_query($con, $query)) : while ($row = mysqli_fetch_assoc($result)) : if($row['status_count']) :

										?>

											<span class="badge badge-warning text-capitalize p-2"><?= $row['status_count']; ?></span>

										<?php

											endif; endwhile; mysqli_free_result($result); endif;

											$initialQuery = "";
											$where = [];
											$whereClause = [];
											$orderClause = [];
											
										?>
									</div>
								</div>
							</a>
						</li>

					<?php elseif($_SESSION['userType'] == 2) : ?>

						<li class="nav-item">
							<a class="nav-link" href="dentist-index.php">
								<div class="row">
									<div class="col-1">
										<i class="fas fa-calendar-alt"></i>
									</div>
									<div class="col">
										Appointments

										<?php

											$initialQuery = "SELECT count(*) as status_count
												FROM `appointments`";

											$where[] = "WHERE status='pending' AND clinic_id={$_SESSION['ClinicID']}";
											$whereClause = implode(" AND ", $where);

											$query = "{$initialQuery} {$whereClause}";
									
											if($result = mysqli_query($con, $query)) : while ($row = mysqli_fetch_assoc($result)) : if($row['status_count']) :

										?>

											<span class="badge badge-warning text-capitalize p-2"><?= $row['status_count']; ?></span>

										<?php

											endif; endwhile; mysqli_free_result($result); endif;

											$initialQuery = "";
											$where = [];
											$whereClause = [];
											$orderClause = [];
											
										?>
									</div>
								</div>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="services.php">
								<div class="row">
									<div class="col-1">
										<i class="fas fa-wrench mr-1"></i>
									</div>
									<div class="col">
									Services
									</div>
								</div>
							</a>
						</li>

					<?php endif; ?>

					<script>

						$(window).on('load', function(){
							var url = window.location.pathname;
							var filename = url.substring(url.lastIndexOf('/')+1);

							$(`[href="${filename}"].nav-link`).addClass('active')
						})

					</script>

				</ul>
			</div>
		</nav>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10" style="padding-top: 56px;">
