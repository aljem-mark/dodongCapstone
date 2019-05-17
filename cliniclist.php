<?php include'header.php'; ?>
    <?php include'nav.php'; ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <h2 style="font-size: 40px; color: skyblue; padding: 30px;">Dental Finder</h2>
                <form class="form-inline" action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-button" name="s" value="<?php echo isset($_POST['s']) ? $_POST['s'] : ''; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="search-button">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                </form>
                <?php include'search.php'; ?>
            </div>

            <div class="col-md-12 table-responsive">
                <table class="table   ">
                    <thead>
                        <tr>
                            <th>Clinics</th>
                            <th></th>
                            <th></th>
                            <th></th>
                    </thead>
                    <tbody>
                        <?php

							if(isset($_POST['s']) && $_POST['s']) {
								$where = "WHERE A.name LIKE \"%".str_replace(" ", "%", $_POST["s"])."%\"";
							} else {
								$where = '';
							}
							$rs=mysqli_query($con,"SELECT A.*, B.contact as contact, C.filename FROM CLINIC as A LEFT JOIN user as B ON A.user_id= B.id LEFT JOIN uploads as C ON C.id = A.profile_media_id " . $where . " ORDER BY A.name ASC");

										while ($row = mysqli_fetch_array($rs)) {
											$filename = $row['filename'] ? "uploads/" . $row['filename'] : "img/loc.png";
											$appointBtn = isset($_SESSION['uid']) ? "<a class=\"btn btn-primary btn-sm\" style =\"margin:5px;\" href=\"appointment.php?clinic_id=".$row['id']."\">Request Appointment</a></td>" : "";

											echo 
												"<tr>".
													"<td scope=\"row\" style =\"margin-top:10px;\"><img  src=\"" . $filename . "\" height=\"100\"></td>".
													"<td scope=\"row\" style =\"margin-top:10px;\">"."<b>".$row['name']."</b>"."<br>".$row["address"]."
													<br>"."<br>"."<br>"."<br>"."Mobile number: ".$row["contact"]."</td>".

													"<td>".$row["description"]."</td>".
													"<td><a class=\"btn btn-info btn-sm\" style =\"margin:5px;\" href=\"#\" data-toggle=\"modal\" data-target=\"#clinicEmbedMap\" data-embed=\"".$row["embed"]."\" onclick=\"showEmbedMap(this)\">View Map</a><br>" . $appointBtn .
														
												"</tr>";

										}
                        ?>
                    </tbody>
                </table>
                <div class="modal fade" id="clinicEmbedMap" tabindex="-1" role="dialog" aria-labelledby="clinicEmbedMap">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Embed Map</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <br>
        <br>
        </div>
        </div>

        <?php include'footer.php'; ?>

            <script type="text/javascript">
                function showEmbedMap(el) {
                    var embedHtml = $(el).attr('data-embed');
                    var $embedModalBody = $("#clinicEmbedMap .modal-body");

                    $embedModalBody.html("");
                    $embedModalBody.html(embedHtml);
                }
            </script>