<?php include'config.php'; ?>

<?php

    if (isset($_POST['save']) && $_POST['save']) {
        $query = "INSERT INTO appointments
            (
            `clinic_id`,
            `customer_name`,
            `customer_contact`,
            `description`,
            `date_created`,
            `status`,
            `idServ`
            )
            VALUES
            (
            '".$_POST['clinic_id']."',
            '".$_POST['customer_name']."',
            '".$_POST['customer_contact']."',
            '".$_POST['description']."',
            CURDATE(),
            'pending',
            '".$_POST['clinic_services_list']."'
            )";

        $insert = mysqli_query($con, $query);
        
        if($insert) {
            $_SESSION['success'] = true;
        } else {
            $_SESSION['error'] = true;
        }

        http_response_code( 303 ); header( "Location: appointment.php?clinic_id={$_POST['clinic_id']}" ); exit;
    }