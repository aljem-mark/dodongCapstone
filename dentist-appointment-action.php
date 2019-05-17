<?php include'config.php'; ?>

<?php


    if ($_POST['action'] == 'accepted') {
        $updateQuery = "UPDATE `appointments`
            SET `status`='" . $_POST['accept'] . "',
            `appointment_date`='" . $_POST['appointment_date'] . "'
            WHERE `id`=" . $_POST['id'];

        $updateResult = mysqli_query($con, $updateQuery);

        http_response_code( 303 ); header( "Location: dentist-index.php" ); exit;
    } else {
        $updateQuery = "UPDATE `appointments`
            SET `status`='" . $_POST['action']  . "'
            WHERE `id`=" . $_POST['id'];

        $updateResult = mysqli_query($con, $updateQuery);

        http_response_code( 303 ); header( "Location: dentist-index.php" ); exit;
    }

    // if ($_POST['decline']) {
    //     $updateQuery = "UPDATE `appointments`
    //         SET `status`='" . $_POST['decline'] . "'
    //         WHERE `id`=" . $_POST['id'];

    //     $updateResult = mysqli_query($con, $updateQuery);

    //     http_response_code( 303 ); header( "Location: dentist-index.php" ); exit;
    // }

    // if ($_POST['done']) {
    //     $updateQuery = "UPDATE `appointments`
    //         SET `status`='" . $_POST['done'] . "'
    //         WHERE `id`=" . $_POST['id'];

    //     $updateResult = mysqli_query($con, $updateQuery);

    //     http_response_code( 303 ); header( "Location: dentist-index.php" ); exit;
    // }

    // if ($_POST['cancel']) {
    //     $updateQuery = "UPDATE `appointments`
    //         SET `status`='" . $_POST['cancel'] . "'
    //         WHERE `id`=" . $_POST['id'];

    //     $updateResult = mysqli_query($con, $updateQuery);

    //     http_response_code( 303 ); header( "Location: dentist-index.php" ); exit;
    // }