<?php
include'config.php';
  
 $transac_id= $_GET['id_a']; 
 
 
 
 IF(ISSET($_GET['modalDELTE'] )){
 //delete
 //DELETE FROM `appointments` WHERE `appointments`.`id` = 13
 
 mysqli_query($con,"UPDATE `appointments` SET `status` = 'delete' WHERE `appointments`.`id` = ".$transac_id);
 echo "Delete!";
 }
 
 
 IF(ISSET($_GET['modalSAVE'] )){ 
 mysqli_query($con,"UPDATE `appointments` SET `status` = 'done' WHERE `appointments`.`id` = ".$transac_id);
 echo "saved!";
 }
 
header("location: dashboard.php");	
?>



