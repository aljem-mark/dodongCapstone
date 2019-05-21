<?php include 'config.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

    $redirectUrl = preg_replace('/\?.*/', '', basename($_SERVER['HTTP_REFERER']));

    if(isset($_POST['action'])) {
        if($_POST['action'] == 'resetPassword') {
            $initialQuery = "";
            $where = [];
            $newPassword = md5(1234);

            $initialQuery = "UPDATE `user`
                SET `pass`='{$newPassword}'";

            $where[] = "`id`={$_POST['id']}";

            $whereClause = $where ? "WHERE " : "";
            $whereClause .= implode(' AND ', $where);
            $query = "{$initialQuery} {$whereClause}";

            $result = mysqli_query($con, $query);
        }
        elseif ($_POST['action'] == 'delete') {
            $initialQuery = "UPDATE `{$_POST['delete-table']}`
                SET `deleted_at`=CURDATE()";

            $where[] = "`id`={$_POST['id']}";

            $whereClause = $where ? "WHERE " : "";
            $whereClause .= implode(' AND ', $where);
            $query = "{$initialQuery} {$whereClause}";

            $result = mysqli_query($con, $query);
        }
        else {
            $_SESSION['success'] = $_POST['email'];

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
    }

    if(isset($_POST['filter']))
    if($_POST['filter']){
        $getQueryString = "?".http_build_query($_POST);
        $redirectUrl .= $getQueryString;
    }

    http_response_code( 303 ); header( "Location: {$redirectUrl}" ); exit;