<?php include'header.php'; ?>
<?php  include'nav.php'; ?>


<?php

	$clinicId = $_GET['clinic_id'];
	$currentUserId = $_SESSION['uid'];
	//

?>
<a href="cliniclist.php" style="text-decoration: none;"><h4 >Dental Finder</h4>
</a>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 ml-auto">
	<form action="" method="POST">
		<input type="hidden" name="clinic_id" value="<?php echo $clinicId; ?>">
		<input type="hidden" name="user_id" value="<?php echo $currentUserId; ?>">
		<div class="card">
			<div class="card-header">Get in touch</div>
			<div class="card-body">
				<h5 class="card-title">Request Appointment</h5>
						Select Service: <select name="clinic_services_list" >
								
								<?php   
									    
							
										$selectc=   mysqli_query($con,"SELECT A.*, B.service_name as iServ ,
							B.description as iDescription  ,
							B.price as iPrice ,
							B.id as iServID

							FROM clinic as A LEFT JOIN clinic_services as B on A.id = B.clinic_id 
							WHERE A.id = '".$clinicId."';");
										while($rr = mysqli_fetch_assoc($selectc)){
										?>
										  <option value="<?php echo $rr['iServID'];?>"><?php echo $rr['iServ'];?>  
										  <?php echo$rr['iPrice'];?></option>
										<?php
										}

									
								?>
						</select>
					<div class="form-group">
		    			<label for="descriptionid">Description:</label>
		    			<textarea class="form-control" id="descriptionid" name="description" rows="3" required></textarea><br>
		    				<input type="submit" class="btn btn-primary" name="save" value="Submit">
		 		 	</div>
			</div>
		</div>
	</form>
		</div>
	</div>
</div>

<?php
	if (isset($_POST['save'])) {
	
	echo $_POST['clinic_services_list'];
 
		$insert = mysqli_query($con,"INSERT INTO appointments(
			clinic_id,user_id,description,status,idServ)"."
			VALUES(
			'".$_POST['clinic_id']."',
			'".$_POST['user_id']."',
			'".$_POST['description']."',
			'pending',
			'".$_POST['clinic_services_list']."'
			)"); 

	}
?>
 
 
<?php include'footer.php'; ?>