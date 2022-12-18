<?php
    header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
    header('Access-Control-Allow-Credentials: true');

    require_once(__DIR__.'/protected/database.php');

    session_start();

    if (isset($_SESSION['user'])) {
        http_response_code(200);
        exit();
    }
    
    http_response_code(401);
?>