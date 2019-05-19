<?php include 'config.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

    $redirectUrl = 'admin-index.php';

    if(isset($_POST['filter']))
    if($_POST['filter']){
        $getQueryString = "?".http_build_query($_POST);
        $redirectUrl .= $getQueryString;
    }

    if(isset($_POST['action'])) {
        $initialQuery = "";
        $where = [];

        $initialQuery = "UPDATE `clinic`
            SET `status`='{$_POST['action']}'";

        $where[] = "`id`={$_POST['id']}";

        $whereClause = $where ? "WHERE " : "";
        $whereClause .= implode(' AND ', $where);
        $query = "{$initialQuery} {$whereClause}";

        $result = mysqli_query($con, $query);
    }

    http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;