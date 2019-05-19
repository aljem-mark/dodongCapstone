<?php include'config.php'; ?>

<?php

    $redirectUrl = 'addclinic.php';

    if(isset($_POST['save'])) {

        if($_POST['p1'] === $_POST['p2']) {
            $password == $_POST['p1'];
        } else {
            $_SESSION['error'] == "Password does not match";
            http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;
        }

        $userQuery = "";
        $userWhere = [];

        $password = "";
        $userType = 2;
        
        $address = stripslashes($_POST['address']);
		$address = htmlentities($address);
		$address = strip_tags($address);
		$address = addslashes($address);
        
        $description = stripslashes($_POST['desc']);
		$description = htmlentities($description);
		$description = strip_tags($description);
		$description = addslashes($description);

        $userQuery = "INSERT INTO `user`
        (
            `fname`,
            `mname`,
            `lname`,
            `email`,
            `pass`,
            `gender`,
            `description`,
            `address`,
            `type`,
            `contact`
        ) VALUES (
            '{$_POST['fname']}',
            '{$_POST['mname']}',
            '{$_POST['lname']}',
            '{$_POST['email']}',
            '{$password}',
            '{$_POST['gender']}',
            '{$description}',
            '{$address}',
            '{$userType}',
            '{$_POST['phone']}'
        )";

        $userWhereClause = implode(' AND ', $userWhere);
        $userFinalQuery = "{$userQuery} {$userWhereClause}";

        $userResult = mysqli_query($con, $userQuery);
        $userId = mysqli_insert_id($con);

        if($_FILES['media']) {
            $target_dir = "uploads/";
            $filename = time()."_".basename($_FILES["media"]["name"]);
            $target_file = $target_dir . $filename;
            $uploadId = 0;

            if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
                $uploadResult = mysqli_query($con, "INSERT INTO uploads (filename) VALUES ('". $filename ."')");
                $uploadId = mysqli_insert_id($con);
                echo "The file ". basename( $_FILES["media"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            $uploadId = 0;
        }

        $clinicQuery = "";
        $clinicWhere = [];
        $embedMap = htmlspecialchars($_POST['map']);

        $clinicQuery = "INSERT INTO `clinic`
        (
            `name`,
            `address`,
            `description`,
            `contact`,
            `profile_media_id`,
            `user_id`,
            `embed`
        ) VALUES (
            '{$_POST['name']}',
            '{$address}',
            '{$description}',
            '{$_POST['phone']}',
            '{$uploadId}',
            '{$userId}',
            '{$embedMap}'
        )";

        $clinicWhereClause = implode(' AND ', $clinicWhere);
        $clinicFinalQuery = "{$clinicQuery} {$clinicWhereClause}";

        $clinicResult = mysqli_query($con, $clinicQuery);

        $_SESSION['success'] = 1;
    }

    http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;