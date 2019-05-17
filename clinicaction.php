<?php
include'config.php';
?>
<?php

echo $_SESSION['uid'];
echo '<br>';
echo $_POST['address'];
echo '<br>';
echo $_POST['descrit'];
echo '<br>';
echo $_POST['cont']; 
echo '<br>';
 
	if (isset($_POST['save']) && $_POST['save']) {
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["media"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$filename = basename($_FILES["media"]["name"]);
		$uploadId = 0;

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["media"]["name"]). " has been uploaded.";
		        $uploadId = mysqli_query($con,"INSERT INTO uploads (id, filename) VALUES ('', '". $filename ."')");
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }

		}

		$embedMap = htmlspecialchars($_POST['map']);

		$insert = mysqli_query($con,"INSERT INTO clinic 
			(id,
			name,
			address,
			embed,
			description,
			contact,
			user_id,
			profile_media_id)".
			"VALUES
			('',
			'".$_POST['name']."',
			'".$_POST['address']."',
			'".$embedMap."',
			'".$_POST['descrit']."',
			'".$_POST['cont']."',
			'".$_SESSION['uid']."',
			'".$uploadId."')"); 
			
		if ($insert == true ){
			// update user to type 2 if not type 1
				ECHO "Saved!";
			mysqli_query($con,"UPDATE  `dbcapstone`.`user` SET  `type` =  '4' WHERE  `user`.`id` = '".$_SESSION['uid']."' ");
			$_SESSION['success'] = "Registration Complete";
			header("location: index.php");			
		}else{
ECHO "NOT Saved!";
		}
	}
?>
