<?php
    header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
    header('Access-Control-Allow-Credentials: true');

    $dsn = 'mysql:dbname=desapeguei;host=127.0.0.1;port=3306';
    $conn = new PDO($dsn, 'root', '');

    session_start();
    //nao se esquecer de trocar o host
?>

