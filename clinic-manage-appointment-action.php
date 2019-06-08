<?php include 'config.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php
    $where = [];

    $initialQuery = "UPDATE `appointment_schedules`
    SET
    sunday={$_POST['sunday']},
    monday={$_POST['monday']},
    tuesday={$_POST['tuesday']},
    wednesday={$_POST['wednesday']},
    thursday={$_POST['thursday']},
    friday={$_POST['friday']},
    saturday={$_POST['saturday']}";

    $where[] = "id={$_POST['id']}";
    $whereClause = $where ? "WHERE " : "";
    $whereClause .= implode(' AND ', $where);
    $query = "{$initialQuery} {$whereClause}";

    $result = mysqli_query($con, $query);

    http_response_code( 303 ); header( "Location: clinic-manage-appointment.php?clinic_id={$_SESSION['ClinicID']}" ); exit;

?>