<?php 
	include 'config.php';

if($_POST['Update'.$_POST['idtoUpdateOrDel8']] != ""){


$update = mysqli_query($con,"UPDATE clinic_services SET service_name = '".$_POST['inputServiceName'.$_POST['idtoUpdateOrDel8']]."', description = '".$_POST['inputDescription'.$_POST['idtoUpdateOrDel8']]."', price = '".$_POST['inputPrice'.$_POST['idtoUpdateOrDel8']]."' WHERE  id = '".$_POST['idtoUpdateOrDel8']."' ");
  header("location: services.php");	 				 
}
if($_POST['Delete'.$_POST['idtoUpdateOrDel8']] != ""){

  
$del = mysqli_query($con,"DELETE FROM clinic_services WHERE id = '".$_POST['idtoUpdateOrDel8']."' ");
  header("location: services.php");	 				 
}
	?>