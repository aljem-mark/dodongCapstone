<?php

    include 'config.php';
    include 'auth-checker.php';

    $appointmentDate = $_GET['date'];
    $days = [
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'
    ];
    $dotd = $days[date('w', strtotime($_GET['date']))];


    if (strtotime($appointmentDate) < strtotime(date('Y-m-d'))) {
        $error = "Please select present or future dates.";
        $return = ['error' => $error];
    } else {
        $allowedCountInitialQuery = "";
        $allowedCountWhere = [];

        $allowedCountInitialQuery = "SELECT *
            FROM `appointment_schedules`";
        
        $allowedCountWhere[] = "clinic_id={$_SESSION['ClinicID']}";

        $allowedCountWhereClause = $allowedCountWhere ? "WHERE " : "";
        $allowedCountWhereClause .= implode(" AND ", $allowedCountWhere);
        $allowedCountQuery = "{$allowedCountInitialQuery} {$allowedCountWhereClause}";
        $allowedCountResult = mysqli_query($con, $allowedCountQuery);

        while ($row = mysqli_fetch_assoc($allowedCountResult)) :
            $allowedCount = $row;
        endwhile;

        $initialQuery = "";
        $where = [];

        $initialQuery = "SELECT count(*) as appointment_count
            FROM `appointments`";
    
        $where[] = "appointment_date='{$appointmentDate}'";
        $where[] = "clinic_id={$_SESSION['ClinicID']}";
        $where[] = "status IN ('pending', 'accepted')";
        $where[] = "deleted_at IS NULL";

        $whereClause = $where ? "WHERE " : "";
        $whereClause .= implode(" AND ", $where);
    
        $query = "{$initialQuery} {$whereClause}";
    
        if ($result = mysqli_query($con, $query)) : while ($row = mysqli_fetch_assoc($result)) :
       
            $error = $row['appointment_count'] >= $allowedCount[$dotd] ? "This date is already fully booked." : 0;
    
        endwhile; mysqli_free_result($result); endif;

        $return = ['error' => $error];
    }

    echo json_encode($return);
?>