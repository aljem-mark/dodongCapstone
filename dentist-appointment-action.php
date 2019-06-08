<?php include 'config.php'; ?>
<?php include 'auth-checker.php'; ?>

<?php

    if(isset($_POST['filter']))
    if($_POST['filter']) {
        $getQueryString = "?".http_build_query($_POST);
    }

    if(isset($_POST['action']))
    if($_POST['action']) {
        if($_POST['action'] == 'delete') {
            $updateQuery = "UPDATE `appointments`
                SET `deleted_at`=CURDATE()";
        } else {
            $updateQuery = "UPDATE `appointments`
                SET `status`='{$_POST['action']}'";

            if($_POST['action'] == 'accepted') {
                $updateQuery .= ", `appointment_date`='{$_POST['appointment_date']}'";

                $apiKey = urlencode('D7AQFNNY9Sk-yKXwrma3PCZHAsFCqUctyUcto9ccnY');
	
                // Message details
                $newNumber = preg_replace('/^0?/', '63', $_POST['contact_number']);
                $numbers = array($newNumber);
                $sender = urlencode($_SESSION['clinic_name']);
                $newDateFormat = date('F j, Y', strtotime($_POST['appointment_date']));
                $messageBody = "This is from {$_SESSION['clinic_name']}. Your appointment has been {$_POST['action']} and it will be on {$newDateFormat}. For further questions contact us at {$_SESSION['clinic_number']}.";
                $message = rawurlencode($messageBody);       
                $numbers = implode(',', $numbers);
            
                // Prepare data for POST request
                $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

                // Send the POST request with cURL
                $ch = curl_init('http://api.txtlocal.com/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                // Process your response here
                echo $response;
            } elseif ($_POST['action'] != 'done') {
                $apiKey = urlencode('D7AQFNNY9Sk-yKXwrma3PCZHAsFCqUctyUcto9ccnY');

                // Message details
                $newNumber = preg_replace('/^0?/', '63', $_POST['contact_number']);
                $numbers = array($newNumber);
                $sender = urlencode($_SESSION['clinic_name']);
                $messageBody = "This is from {$_SESSION['clinic_name']}. Your appointment has been {$_POST['action']}. For further questions contact us at {$_SESSION['clinic_number']}.";
                $message = rawurlencode($messageBody);       
                $numbers = implode(',', $numbers);
            
                // Prepare data for POST request
                $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

                // Send the POST request with cURL
                $ch = curl_init('http://api.txtlocal.com/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                // Process your response here
                echo $response;
            }
        }

        $whereClause = "WHERE `id`={$_POST['id']}";

        $updateResult = mysqli_query($con, "{$updateQuery} {$whereClause}");
    }

    http_response_code( 303 ); header( "Location: dentist-index.php{$getQueryString}" ); exit;