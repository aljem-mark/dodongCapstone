		<?php
		include'config.php';
		  
		//
		   $selHas = 0;
			  for ($ixi=0; $ixi < $_POST['countx'] ; $ixi++){ 
				if($_POST['delete'.($ixi+1)]){ 

				$delete = mysqli_query($con,"UPDATE appointments SET status = 'delete', read_notification = '1' WHERE appointments.id = '".$_POST['id'.($ixi+1)]."';");
				
				 
				}elseif($_POST['Save'.($ixi+1)]){ 
						if ( $_POST['idate'.($ii+1)] == ""){
						echo 	$_SESSION['iError'] = 'Date  Error';
						}else{
						$from_xp= explode(":",$_POST['from_time'.($ixi+1)]);
						$to_xp= explode(":",$_POST['to_time'.($ixi+1)]);
						$iTo =   $to_xp[0] - $from_xp[0] ; 
						   $iTime = $_POST['from_time'.($ixi+1)] ;
						   
						   	  $s = mysqli_query($con,"SELECT id FROM appointments WHERE  dateApnted = '". $_POST['idate'.($ii+1)] ."' and timeApnted like '%".$iTime."%'");
							  while ($r = mysqli_fetch_assoc($s)){
									echo $selHas = 1;// >> has hit!
									 $_SESSION['iError'] = " Time Conflict ";
								
								}
						    echo "h2";
							 for ($i=1; $i < $iTo+1 ; $i++) { 
							 echo "h1";
								 $Concatx = $i + $from_xp[0];
									  $iTime =$iTime .  "|".   $Concatx.":00";	 
									  echo $Concatx.":00";
									  $s = mysqli_query($con,"SELECT id FROM appointments WHERE  dateApnted = '". $_POST['idate'.($ii+1)] ."' and timeApnted like '%".$Concatx.":00"."%'");
									  while ($r = mysqli_fetch_assoc($s)){
											echo $selHas = 1;// >> has hit!
											$_SESSION['iError'] = " Time Conflict ";
										
										}
							}	
				
							
						if ($selHas==0){
							$iUpdate = mysqli_query($con,"UPDATE appointments SET   read_notification = '1' , timeApnted = '".$iTime."', dateApnted = '".$_POST['idate'.($ii+1)]."', status = 'accepted'  WHERE id = '".$_POST['id'.($ii+1)]."'");
						 $_SESSION['iError'] = "";
						}
		
 }
				}
		   }

		header("location: dashboard.php");	
	 /* 
		if($_POST['save']){
		  for ($ii=0; $ii < $_POST['countx'] ; $ii++) { 
			echo $ii.'<br>';
						$from_xp= explode(":",$_POST['from_time'.($ii+1)]);
						$to_xp= explode(":",$_POST['to_time'.($ii+1)]);
						$iTo =   $to_xp[0] - $from_xp[0] ; 
						   $iTime = $_POST['from_time'.($ii+1)] ;
						   
							 for ($i=1; $i < $iTo+1 ; $i++) { 
								 $Concatx = $i + $from_xp[0];
									echo  $iTime =$iTime .  "|".   $Concatx.":00";	 
							}
			
			  $iUpdate = mysqli_query($con,"UPDATE appointments SET   read_notification = '1' , timeApnted = '".$iTime."', dateApnted = '".$_POST['idate'.($ii+1)]."', status = 'accepted'  WHERE id = '".$_POST['id'.($ii+1)]."'");
		   echo $iTime.'<br>';
				echo $iUpdate;	
				
				$_SESSION['iError'] = 'Date Time Error'
		   }
		// header("location: dashboard.php");
		}  
	*/
		?>



