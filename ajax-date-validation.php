<?php

    include 'config.php';
    include 'auth-checker.php';

    $appointmentDate = $_GET['date'];

    if(strtotime($appointmentDate) < strtotime(date('Y-m-d'))) {
        $error = "Please select present or future dates.";
        $return = ['error' => $error];
    } else {
        $initialQuery = "";
        $where = [];

        $initialQuery = "SELECT count(*) as appointment_count
            FROM `appointments`";
    
        $where[] = "appointment_date='{$appointmentDate}'";
        $where[] = "clinic_id={$_SESSION['ClinicID']}";
        $where[] = "status IN ('pending', 'accepted')";

        $whereClause = $where ? "WHERE " : "";
        $whereClause .= implode(" AND ", $where);
    
        $query = "{$initialQuery} {$whereClause}";
    
        if($result = mysqli_query($con, $query)) : while ($row = mysqli_fetch_assoc($result)) :
       
            $error = $row['appointment_count'] >= 2 ? "This date is already fully booked." : 0;
    
        endwhile; mysqli_free_result($result); endif;

        $return = ['error' => $error];
    }

    echo json_encode($return);
?>