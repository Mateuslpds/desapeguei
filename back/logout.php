<?php 
    header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
    header('Access-Control-Allow-Credentials: true');

    require_once(__DIR__.'/protected/database.php');

    session_start();

    session_destroy();
?>