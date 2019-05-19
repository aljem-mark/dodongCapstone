<?php

    if(!isset($_SESSION['uid'])) {
        http_response_code( 303 ); header( "Location: index.php" ); exit;
    }

?>