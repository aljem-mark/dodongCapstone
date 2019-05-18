<?php include'config.php'; ?>

<?php

    if(isset($_POST['filter']))
    if($_POST['filter']) {
        $getQueryString = "?".http_build_query($_POST);
    }

    if(isset($_POST['action']))
    if($_POST['action']) {
        $updateQuery = "UPDATE `appointments`
            SET `status`='{$_POST['action']}'";

        if($_POST['action'] == 'accepted') {
            $updateQuery .= ", `appointment_date`='{$_POST['appointment_date']}'";
        }

        $whereClause = "WHERE `id`={$_POST['id']}";

        $updateResult = mysqli_query($con, "{$updateQuery} {$whereClause}");
    }

    http_response_code( 303 ); header( "Location: dentist-index.php{$getQueryString}" ); exit;