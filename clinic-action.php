<?php include'config.php'; ?>

<?php

    $redirectUrl = $_SESSION['homepage'];

    if(isset($_POST['save'])) {
        $redirectUrl = 'addclinic.php';

        $userQuery = "";
        $userWhere = [];

        $password = "";
        $userType = 2;

        if($_POST['p1'] === $_POST['p2']) {
            $password = md5($_POST['p1']);
        } else {
            $_SESSION['error'] == "Password does not match";
            http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;
        }
        
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
            `fname`,
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
        
        if (mysqli_error($con)) {
            $_SESSION['error'] = "Email <span class='font-weight-bold'>{$_POST['email']}</span> already exists!";
            http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;
        }

        $userId = mysqli_insert_id($con);

        if(!$_FILES['media']['error']) {
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

    if (isset($_POST['update'])) {
        $redirectUrl = "profile-edit.php?user_id={$_POST['uid']}";

        if($_POST['updatePassword']) {
            if($_POST['p1'] === $_POST['p2']) {
                $password = md5($_POST['p1']);
            } else {
                $_SESSION['error'] == "Password does not match";
                http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;
            }
        }

        if ($_POST['type'] == 2) {

            if(!$_FILES['media']['error']) {
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
            }

            $clinicInitialQuery = "";
            $uploadInitialQuery = "";
            
            $clinicWhere = [];
            $uploadWhere = [];
            
            $address = stripslashes($_POST['address']);
            $address = htmlentities($address);
            $address = strip_tags($address);
            $address = addslashes($address);
            
            $description = stripslashes($_POST['desc']);
            $description = htmlentities($description);
            $description = strip_tags($description);
            $description = addslashes($description);

            $embedMap = htmlspecialchars($_POST['map']);

            $clinicInitialQuery = "UPDATE `clinic`
                SET
                `name`='{$_POST['name']}',
                `address`='{$address}',
                `description`='{$description}',
                `contact`='{$_POST['phone']}',
                `embed`='{$embedMap}'";

            if (!$_FILES['media']['error']) {
                $clinicInitialQuery .=",
                    `profile_media_id`='{$uploadId}'";
            }

            $clinicWhere[] = "`user_id`={$_POST['uid']};";
            $clinicWhereClause = $clinicWhere ? "WHERE " : "";
            $clinicWhereClause .= implode(' AND ', $clinicWhere);
            $clinicQuery = "{$clinicInitialQuery} {$clinicWhereClause}";

            $clinicResult = mysqli_query($con, $clinicQuery);
        }

        $userInitialQuery = "";
        $userWhere = [];

        $userInitialQuery = "UPDATE `user`
            SET
            `email`='{$_POST['email']}',
            `fname`='{$_POST['fname']}',
            `mname`='{$_POST['mname']}',
            `lname`='{$_POST['lname']}',
            `address`='{$address}',
            `description`='{$description}',
            `contact`='{$_POST['phone']}',
            `gender`='{$_POST['gender']}'";

        if ($_POST['updatePassword']) {
            $userInitialQuery .=",
                `pass`='{$password}'";
        }

        $userWhere[] = "`id`={$_POST['uid']};";
        $userWhereClause = $userWhere ? "WHERE " : "";
        $userWhereClause .= implode(' AND ', $userWhere);

        $userQuery = "{$userInitialQuery} {$userWhereClause}";

        $userResult = mysqli_query($con, $userQuery);

        if (mysqli_error($con)) {
            $_SESSION['error'] = "Email <span class='font-weight-bold'>{$_POST['email']}</span> already exists!";
            http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;
        }

        $_SESSION['success'] = 1;
    }

    http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;