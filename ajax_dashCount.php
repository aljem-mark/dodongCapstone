 <?php 
	include'config.php';
	
	$s = mysqli_query($con,"SELECT count(id) as iCount FROM appointments WHERE clinic_id = '".$_SESSION['ClinicID']."' and status = 'pending'");
	while($r=mysqli_fetch_assoc($s)){
		echo $r['iCount'];
	}
		
 ?>