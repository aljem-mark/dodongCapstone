<?php include 'config.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

    if(isset($_POST['filter']))
    if($_POST['filter']){
        $getQueryString = "?".http_build_query($_POST);
    }

    if(isset($_POST['action'])) {
        $initialQuery = "";
        $where = [];

        if($_POST['action'] == 'save') {
            if($_POST['id']) {
                $initialQuery = "UPDATE `clinic_services`
                    SET
                    `service_name`='{$_POST['service_name']}',
                    `description`='{$_POST['description']}',
                    `price`='{$_POST['price']}',
                    `date_updated`=CURDATE()";
                
                $where[] = "WHERE `id`={$_POST['id']}";
            } else {
                $initialQuery = "INSERT INTO `clinic_services`
                    (
                        `clinic_id`,
                        `service_name`,
                        `description`,
                        `price`,
                        `date_created`
                    ) 
                    VALUES
                    (
                        {$_SESSION['ClinicID']},
                        '{$_POST['service_name']}',
                        '{$_POST['description']}',
                        '{$_POST['price']}',
                        CURDATE()
                    )";
            }
        } else {
            $enabled = $_POST['action'] == 'enable' ? 1 : 0;
            $initialQuery = "UPDATE `clinic_services`
                SET
                `enabled`='{$enabled}'";
                
            $where[] = "WHERE `id`={$_POST['id']}";
        }

        $whereClause = implode(' AND ', $where);
        $query = "{$initialQuery} {$whereClause}";

        $result = mysqli_query($con, $query);
    }

    http_response_code( 303 ); header( "Location: services.php{$getQueryString}" ); exit;