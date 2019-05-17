<?php

	include 'config.php';

	$select = mysqli_query($con,"SELECT A.*, B.service_name as iServ ,
		B.description as iDescription  ,
		B.price as iPrice ,
		B.id as iServID

		FROM clinic as A LEFT JOIN clinic_services as B on A.id = B.clinic_id 
		WHERE A.id = ".$_GET['clinicId'].";");

	$html = "";

	while($rr = mysqli_fetch_assoc($select)) {
	  $html .= '<option value="'.$rr['iServID'].'">'.$rr['iServ'].'</option>';
	}

	echo json_encode(['message' => $html]);

?>