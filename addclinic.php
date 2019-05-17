
<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Request to add clinic</div>
					<form action="clinicaction.php" method="POST" enctype="multipart/form-data">
						<div class="card-body">	
							<div class="form-group">
								<label for="inputclinic">Clinic Name</label>
								<input type="text" class="form-control" id="inputclinic" name="name" placeholder="Name">
							</div>
							<div class="form-group">
								<label for="inputadd">Address</label>
								<input type="text" class="form-control" id="inputadd" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<label for="embed">Map</label>
								<textarea class="form-control" id="embed" rows="3" name="map"></textarea>
							</div>
							<div class="form-group">
								<label for="descrit">Description</label>
								<textarea class="form-control" id="descrit" rows="3" name="descrit"></textarea>
							</div>
							<div class="form-group">
								<label for="cont">Phone</label>
								<input type="text" class="form-control" id="cont" name="cont">
							</div>
							<div class="form-group">
								<label>Upload</label>
								<div class="input-group">
								  <div class="custom-file">
								    <input type="file" class="custom-file-input" name="media" id="inputGroupFile04" accept="image/*">
								    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
								  </div>	
								</div>
							</div>
							<div>
								<input type="submit" class="btn btn-primary" name="save" value="Submit"></input>
							</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include'footer.php' ?>
</body>
</html>