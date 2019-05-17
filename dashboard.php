<?php
 include 'header.php' ; 
$rr=0;	  
$r = mysqli_query($con,"SELECT COUNT(id) as iCount FROM appointments WHERE clinic_id ='19'  and status = 'pending' " ); while ($s = mysqli_fetch_assoc($r)){$rr=$s['iCount'];}include 'nav.php' ;

error_reporting(100);
?>	
 

<div class="container-fluid">
    
 <div class="col-md-10 col-xs-6 ml-auto">  
	<div >
	 
	</div>
    <?php
$datediffx = 5;
$colrfinal = ["#2d2d2d","#2d9845","#e74a3b"];
$colr = ["#c0392b","#dc7633","#808b96","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99","#cd6155","#d98880","#e74c3c","#ec7063","#f1948a","#2c3e50","#566573","#808b96","#34495e","#5d6d7e","#85929e","#d35400","#dc7633","#edbb99","#f1c40f","#dc7633","#e59866","#edbb99"];
                 $today = date("Y-m-d");
				$futureDate = date("Y-m-d", strtotime($today . "+". $datediffx."days"));
          

			?>
			         <?php 
        if ($_POST['SearchDate']){
        
            
           $datediffx  =  date_diff(date_create($_POST['date1']),date_create($_POST['date2']));
            $datediffx= $datediffx -> format('%a');
            
                $today = $_POST['date1'];
				$futureDate = $_POST['date2'];
        }
          ?>
<div>
<div>
 <p class="bg-danger" ><?php echo $_SESSION['iError'];?></p>
</div>


<form Method = "POST" >
		<div>
            <h6>Covered Date</h6>
			From : <input type="date"  name="date1" id="date1" value='<?php echo $today; ?>'> To : <input type="date" name="date2" value='<?php echo $futureDate; ?>'>
       
            <input type="Submit" name="SearchDate" value="Search">
		</div>
    </form>
	<div class="row table-responsive ">
   
<!-- <!-		<div class="col-md-6" style="margin-top: 50px;">  -->
			<table class="table responsive" >
			
				<thead>
					<tr>
                       
						<th scope="col"><p>Time</p></th>
						<?php
							for ($ii=0; $ii < $datediffx+1 ; $ii++) { 
								echo 	"<th >";
								 echo 	"<p  style='width:100% !important;' name='"."date".$ii."'>".date("m/d/Y", strtotime($today . "+" . $ii . "days")).'</p>';
								echo 	"</th>";
							}
						?>
                      
					</tr>
				</thead>
				<tbody>					
					<!-- fixed time -->
					<?php 
 $ixxx = 0;
                    for ($y=1; $y < 11 ; $y++){
                       if  ($ixxx == 0){
						echo '<tr  style="Background-color:#eaeaea;">';
					   echo '<td style="Position:absolute;background-color:#eaeaea;  "><p style="background-color:#eaeaea;height:100%;"> '.($y + 7). ':00'.'</p></td>'; 
					   $ixxx =1;
					   }else{
					   echo '<tr  style="Background-color:#f9f9f9;">';
					   echo '<td style="Position:absolute;background-color:#f9f9f9;  "><p style="background-color:#f9f9f9;height:100%;"> '.($y + 7). ':00'.'</p></td>';  
					    $ixxx =0;
					   }
					   
                                        
                                            for($x=1;$x < $datediffx+2 ; $x++){
                                                $cc = 0;
                                                $DateS = date("m/d/Y", strtotime($today . "+" .($x-1) . "days"));
                                           
                                                $DateS = explode("/",$DateS);
                                                $DateS =  $DateS[2].'-'.$DateS[0].'-'.$DateS[1];
												 
                                                   $select2 = mysqli_query($con,"SELECT 
												   
																		a.id 			as id_a,
																		a.status		as status_a,
																		u.id 			as id_u,
																		a.idServ 		as idServs,
																		a.timeApnted 	as iTimexcx ,
																		u.id 			as uId, 
																		a.id 			as idx,
																		a.description, 
																		B.id 			as id_s , 
																		B.service_name 	as service_name , 
																		B.price 		as iPrice,
																		C.id 			as id_c,
																		CONCAT_WS(' ', u.fname, u.mname, u.lname) as fullname 
																		
																		FROM appointments as a  
																		LEFT JOIN clinic_services as B ON B.clinic_id = A.clinic_id
																		LEFT JOIN clinic as c ON c.id = a.clinic_id 
																		LEFT JOIN user as u ON u.id = a.user_id 
																		WHERE  c.id = '".$_SESSION['ClinicID']."' and   status <> 'pending' and  status <> 'cancel'  and a.dateApnted = '".$DateS."' and a.timeApnted LIKE '%".($y + 7). ':00'."%' ;"); 
                                                while ($row2 = mysqli_fetch_array($select2)) :  

                                                        //
                                                
                                                            if ($cc == 0 ){ 
                                                                        $iDay1st  =  explode('|',$row2['iTimexcx']);
                                                                $ix =  "".(($y + 7).":00");
                                                                 $iDay1st =  $iDay1st[0]."";
                                                               if  ( $ix == $iDay1st)   {
                                                               
                                                                     
                                                                ?>
																 <td style="height:1px!important;background-color:<?php echo $colr[$x]; ?>;  height:100%;" > 
																 <?php 
																	/*if ($row2['status_a'] <> 'accepted'){
																	?>
																	<center> <P  style="color:#fff;"><?php echo $row2['fullname'];?></p><center> 
																	<?php
																	}else{
																	?>
																	<button style="color:#fff;background-color:<?php echo $colr[$x]; ?>; border:solid 0px black; width:100%;height:100%;"  type="button"  data-toggle="modal" data-target="<?php echo "#iMoadlOption".$y.$x;?>"><?php echo $row2['fullname'].'<br><i class="fas fa-cog"></i>';?></button>
																	<?php
																	}*/
																	
																 ?>
																 <button style="color:#fff;background-color:<?php echo $colr[$x]; ?>; border:solid 0px black; width:100%;height:100%;"  type="button"  data-toggle="modal" data-target="<?php echo "#iMoadlOption".$y.$x;?>"><?php echo $row2['fullname'].'<br><i class="fas fa-cog"></i>';?></button>
																	
																 </td>
																 <?php
																 
																		
																		?>
						<div class="modal fade" id="<?php echo "iMoadlOption".$y.$x; ?>" role="dialog">
							<div class="modal-dialog"> 
								<div class="modal-content">
									<div class="modal-header">
										<p>
											
										</p> 
										<button type="button" class="close" data-dismiss="modal">&times;</button> 
									</div>
									<form action="<?php echo "dashboard_modal.php?id_u=".$row['uId']."&id_c=".$row['id_c']."&id_s=".$row['id_s']."&id_a=".$row['id_a'];   ?>" > 
									<?php 	$xcc = explode('|', $row2['iTimexcx']); ?>
									<input type="hidden" name="id_u" value="<?php echo $row2['id_u'];?>" />
									<input type="hidden" name="id_c" value="<?php echo $row2['id_c'];?>" />
									<input type="hidden" name="id_s" value="<?php echo $row2['id_s'];?>" />
									<input  type="hidden" name="id_a" value="<?php echo $row2['id_a'];?>" />  
									
										<div class="container-fluid">
											<div class="container-fluid">
												<br> 
															<div class="row" > 
																<div class="col-sm-6" style="border-right:solid 1px  #eaeaea ; text-align: right;">
																	 <b>
																	 	<p> PATIENT </p>
																		<p> TIME </p>
																		<p> SERVICES </p>
																		<p> PRICE </p></b>
																		
																	 </b>
																	 
																</div>
															 
																<div class="col-sm-6" >
																	 <b>	
																		<p> <?php echo $row2['fullname'];?> </p>
																		<p> <?php
																		 
																	if  (count($xcc) ==1  ){
																	echo $xcc[0] ;
																	}else{
																		echo $xcc[0] .' To '. $xcc[count($xcc)-1];
																		}
																		?> </p>
																		<p> <?php echo $row2['service_name'];?> </p>
																		<p> <?php echo $row2['iPrice'];?> </p>
																	 </b>
																</div> 
															</div> 
															
															<?php 
																if ($row2['status_a'] == 'accepted'){
															?>
									<div class="row"   style="border-top:solid 1px  #eaeaea ">
									<div class="col-sm-4" ><br> <center><input type="submit"  name="<?php echo "modalDELTE"; ?>"   style="border:0; width:50px;height:25px; background-color:#d44a26;color:#f7f7f7;" value='Delete'/>   </div>
									<div class="col-sm-4" > <center><!--<input type="submit"  name="Edit" style="border:0; width:50px;height:25px; background-color:#01a31c;color:#f7f7f7;" value='Edit'/>--> </div>
									<div class="col-sm-4" ><br> <center><input type="submit"  name="<?php echo "modalSAVE"; ?>" style="border:0; width:50px;height:25px; background-color:#377796;color:#f7f7f7;" value='Save'/>   </div>
									</div> 
									<?php }else{ 
									?>
									<div class="row"   style="border-top:solid 1px  #eaeaea ">
									<div class="col-sm-4" ><br> </div>
									<?php 
										if ($row2['status_a'] == 'delete'){
											?> 
											<div class="col-sm-4" > <Br><center><P   style="border:0; width:120px;height:50px; background-color:#444444;color:#f7f7f7;" /><br> Transaction Deleted <br></p></div>
											<?php
										}elseif ($row2['status_a'] == 'done'){
											?> 
											<div class="col-sm-4" > <Br><center><P   style="border:0; width:120px;height:50px; background-color:#01a31c;color:#f7f7f7;" /><br> Transaction Completed <br></p></div>
											<?php
										}elseif ($row2['status_a'] == 'cancelled'){ ?> 
											<div class="col-sm-4" > <Br><center><P   style="border:0; width:120px;height:50px; background-color:#cf3811;color:#f7f7f7;" /><br> Transaction Cancelled <br></p></div>
											<?php } ?> 
									<div class="col-sm-4" ><br> </div>
									</div> 
									<?php
									}
									
									
									?>
													<br><br> 	
											</div> 
										</div> 
									</form>
								</div>
							</div>
						</div>
																		
																		<?php

														}else{
															echo "<td style='background-color:" .$colr[$x]."; '></td>"; 
														}
														 $cc++;   
														} 
                                                endwhile;
                                                
                                                    if ($cc == 0 ){echo '<td></td>'; $xcc = 0; $xcc = 0; }
                                             
                                                 
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
                               
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php 
  $i =1; 
	$ix = 0 ;
$select = mysqli_query($con,"CALL procedure_names(" . $_SESSION['uid'] . ")"); 
while ($row = mysqli_fetch_array($select)) : 
    $shirtx = 'hidden';
  if($row['id'] > 0 ) {
    echo $shirtx = '';
  } 
 
$ix++;
?>
<form action="update_appointments.php" method="POST" <?php echo $shirtx;  ?> >
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10 table-responsive ml-auto">
			<div class="card">
				<table class="table">
					<thead>
 
                        

					<tr>
				 
						
						<th scope="col">Patient Name and Request</th>
							<th scope="col">Time</th>
							<th scope="col"></th>
							<th scope="col">Date</th>
							<th scope="col">Options</th>
							<!--<th scope="col">Action</th>-->
		
						</tr>
					</thead>
					<tbody>

					 

						<tr>
							<td> 
                            
                               	<input hidden type="input"  name="countx"  value="<?php echo $i; ?>">
                               	<input  hidden type="input"  name="<?php echo 'id'.$i; ?>"  value="<?php echo  $row['id']; ?>">
								<?php echo $row['fullname'];?>
                                	
                                
							</td>

							<td>
								From :
                                <select class="form-control" name="<?php echo "from_time".$i; ?>">
<option>8:00</option><option>9:00</option><option>10:00<s/option><option>11:00</option><option>12:00</option><option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option>
                                </select>
                            
							</td>
							<td>
								To :
                                <select class="form-control"  name="<?php echo "to_time".$i; ?>">
                                   
<option>8:00</option><option>9:00</option><option>10:00</option><option>11:00</option><option>12:00</option><option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option>
                                </select>
                            
							</td>
							<td>
                                Set Date :<br>
								<input type="date" name="<?php echo 'idate'.$i; ?>" value='<?php  date("m/d/Y"); ?>' required/>
                                
							</td>
							<td>
                             <br>
						<input type="submit" name="<?php echo 'delete'.$i; ?>" value='Delete' formnovalidate/>  
						<input type="submit" name="<?php echo 'Save'.$i; ?>" value='Save' formnovalidate/>
							</td>
							 
						</tr>


                        <tr> 

                            <td colspan="5" style="background:#e6e6e6;">
                                <?php echo $row['description']. " ".$row['iServName'];?> 
                            </td>
                        </tr>
						<?php 
 $i++; 
endwhile; ?>
                                <tr> 
                                <td>
                              
                                </td>
                                    <td>
                              
                                </td>
                                    <td>
                              
                                </td>
                                      <td>
                            
                                </td>
                                </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

</form>
        <!--  
            // if done (submit) then
make a for loop / check if all input in one row is done then 
add that row in the database
            End of form
        -->
<br><br><br><br>
</div>
</div>

 <img a="">
 <!--<img class="img-resposive" src="flat-design-color-chart.png" style="width:100%; height: 100%;"> --!>
<br> -->



<?php include 'footer.php' ?>





