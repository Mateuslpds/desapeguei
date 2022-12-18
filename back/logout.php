<?php 
    header('Access-Control-Allow-Origin: http://localhost:5173');
    header('Access-Control-Allow-Credentials: true');

    require_once(__DIR__.'/protected/database.php');

    session_start();

    session_destroy();
?>