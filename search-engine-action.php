<?php include'config.php'; ?>

<?php

    if(isset($_POST['filter']))
    if($_POST['filter']){
        $getQueryString = "?".http_build_query($_POST);
    }

    if(isset($_POST['action'])) {
        $initialQuery = "";
        $where = [];

        $whereClause = implode(' AND ', $where);
        $query = "{$initialQuery} {$whereClause}";

        $result = mysqli_query($con, $query);
    }

    http_response_code( 303 ); header( "Location: cliniclist.php{$getQueryString}" ); exit;