<?php include'config.php'; ?>

<?php

	if (isset($_POST['login']))
	if ($_POST['login']) {
		$email = $_POST['email'];
		$password = $_POST['p1'];
	
		$query = "SELECT A.*, ifnull(B.id,'No Clinic') as idClinic FROM user as A LEFT JOIN clinic as B ON A.id = B.user_id WHERE email = '".$email."'  AND  pass = '".$password."' LIMIT 1";

		if(!$result = mysqli_query($con, $query)) {
			$_SESSION['error'] = 'Invalid Username/Password';
			header("location: index.php");
		} else {
			while($row = mysqli_fetch_assoc($result)){
				$_SESSION['userFullname'] = ucwords($row['fname']." ".$row['mname']." ".$row['lname']); 
				$_SESSION['userType'] = $row['type'];
				$_SESSION['uid'] = $row['id'];
				$_SESSION['ClinicID'] = $row['idClinic'];

				if ($row['type'] == 2) {
					header("location: dashboard.php");
				} elseif ($row['type'] == 3) {
					header("location: cliniclist.php");
				} elseif ($row['type'] == 1) {
					header("location: admin.php");
				} else {
					header("location: index.php");
				}
			}
		}
	}
?>