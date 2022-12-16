<?php
try{
    $dbUsername = 'root';
    $dbPassword = '';
    $dbConnection = 'mysql:host=localhost; dbname=desapeguei; charset=utf8';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $db = new PDO(
        $dbConnection,
        $dbUsername,
        $dbPassword,
        $options
    );
}catch(PDOException $ex){
    echo '{
        "status":0,
        "message":"nao foi possivel se conectar com o banco",
        "debug":'.__LINE__.'
    }';
    exit();
}