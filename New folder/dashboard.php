<?php include 'header.php' ?>	

<div class="container-fluid">
		<div>
			<?php  
			?>
				<h6>Covered Date</h6>
			From : <input type="date" name="date1" value='<?php  date("m/d/Y"); ?>'> To : <input type="datetime" name="date2" value='01/01/2019'>  
		</div>
	<div class="row table-responsive">
<!-- <!-		<div class="col-md-6" style="margin-top: 50px;">  -->
			<table class="table " >
				<thead>
					<tr>
						<th scope="col">Time</th>
				<?php 
					for ($ii=0; $ii <6 ; $ii++) { 
						 // base on 'from and to' date 
						// find a way how to format a time in php 
					echo 	"<th>";
					echo 	date("m/") . date("d/") . date("Y") ;
					echo 	"</th>";

						}
				?>

				<!-- end if base on from and to date -->

					</tr>
				</thead>
				<tbody>
					
 <!-- fixed time -->
						<?php 
  							for ($i=1; $i < 11 ; $i++) { 
								?>
								<tr>
									<td><?php echo $i + 7; ?> :00 </td>
											 <?php 
											 		for ($iii=0; $iii < 6 ; $iii++) {  
											 			// dari na ka mag echo if na sulod dara ang sched
											 				if ($iii == 1 && $i == 1) {
											 					echo "<td style='background-color:red'> Famoleras Deanmark  </td>"; 
											 				} else{
											 					if ($iii ==1 && $i==2) {
											 						echo "<td style='background-color:red'></td>"; 
											 					} 
											 					
											 			
											 					echo "<td> </td>";
											 				}
											 				
											 			 }



											 ?>
								</tr>
								<?php		 
							
							}

						?>
						<!-- end of fix time -->
				</tbody>
			</table>
		<!-- </div> -->
	</div>
</div>
<br><br><br>

<!-- for request appointment -->
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10 table-responsive">
			<div class="card">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Patient Name</th>
							<th scope="col">Time</th>
							<th scope="col">Date</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
							<?php 
								for ($p=0; $p <= 3; $p++) { 
								
							 ?>
						<tr>
							<td>
								Rocamora Francis
							</td>

							<td>
								From <input type="time" name=""> To <input type="Time" name="">
							</td>
							<td>
								<input type="date" name="idate" value='<?php  date("m/d/Y"); ?>'>
								<input type="submit" class="btn btn-primary btn-sm" onclick="" name="">
							</td>
							<td>
								<input type="button" class="btn btn-primary btn-sm" name="" value="Accept">
								<input type="button" class="btn btn-danger btn-sm" name="" value="Decline">
							</td>
						</tr>
								<?php 
							}

							 	?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<br><br><br><br>



<?php include 'footer.php' ?>