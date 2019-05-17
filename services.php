<?php include'header.php'; 

include'nav.php';
   
$rr=0;	 
  
$r = mysqli_query($con,"SELECT COUNT(id) as iCount FROM appointments WHERE clinic_id ='19'  and status = 'pending' " );
while ($s = mysqli_fetch_assoc($r)){
  $rr = $s['iCount'];

}
?>

<div class="container-fluid" >
	<div class="row justify-content-center" style="margin-top: 20px;">
			<div class="card">
				<div class="card-header">
						<h4>Services </h4>
						
				</div>
				<div class="card-body">
					<table class="table table-hover">
						<thead>
							<th>Service Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Option</th>
						</thead>
						
				
						<tbody>
						
								<?php  
						$x = 0;
$select=   mysqli_query($con,"SELECT * FROM clinic_services WHERE clinic_id = '".$_SESSION['ClinicID']."'");
		while($r = mysqli_fetch_assoc($select)){
		
		?>
		
                            <tr>
								<td><?php echo $r['service_name'];?></td> 
								<td><?php echo $r['description'];?></td> 
								<td><?php echo $r['price'];?></td> 
								<td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="<?php echo "#iMoadlOption".$r['id']; ?>">Options</button>
                                    <div class="container"> 
									 
                                 </td>       
                            </tr>  

				<?php 
					$x++;
				} 
				?>			
						</tbody>
					</table>
				</div>
                <hr>
                 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#iModalForNewServices">Add  Services</button>
			</div>
        
	</div>
    
</div>

 <?php 
  $xx = 0;
	$selectc=   mysqli_query($con,"SELECT * FROM clinic_services WHERE clinic_id = '".$_SESSION['ClinicID']."'");
		while($rr = mysqli_fetch_assoc($selectc)){

 ?>
 

<?php $xx++; } ?>


<!-- modal for new Services-->
 <form method="post">
                <div class="modal fade" id="iModalForNewServices" action="services.php" role="dialog">
                    <div class="modal-dialog">
                            

                    <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Service</h4>
                        </div>
                        <div class="modal-body">
                        
                            
                            
                            
                            <table class="table table-hover">
                            <thead>
                                <th>Service Name</th>
                                <th>Description</th>
                                <th>Price</th>
                            </thead>
                                <tbody> 


                                    <td><input type="text" name="inputServiceName" required> </input> </td>
                                    <td><input type="text" name="inputDescription" required> </input> </td>
                                    <td><input type="number" name="inputPrice" required> </input> </td>


                                </tbody>
                            </table>
                         
                        <div class="modal-footer">
                              
							 <input class="btn btn-primary" type="Submit" name="iNewBtnSave"> 
									
                        </div>
                        
                    
                    </div>
                        </div>

                </div>
                </div>
</form>
<?php  





    if(isset($_POST['iNewBtnSave'])){
 
					
			if ($_POST['inputServiceName'] != ""){ 
				if ($_POST['inputDescription'] != ""){ 
					if ($_POST['inputPrice'] != ""){ 
					 
								$insert = mysqli_query($con,"INSERT INTO clinic_services (id, clinic_id, service_name, description, price, date_added, date_update, rating, void)".
									"VALUES ('',
									'".$_SESSION['ClinicID']."',
									'".$_POST['inputServiceName']."',
									'".$_POST['inputDescription']."',
									'".$_POST['inputPrice']."', 
									CURRENT_TIMESTAMP,
									'',
									'',
									'1'); ");
									
									if ($insert){
											header("location: services.php");			
									}else{ 
										 
							}
						}
					}
				}
			
    }
?>
 