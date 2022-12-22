<?php
session_start();

header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
header('Access-Control-Allow-Credentials: true');

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('SELECT * FROM usuario WHERE USUARIO_EMAIL = :email AND USUARIO_SENHA = :senha');
    $q->bindValue(':email', $_POST['email']);
    $q->bindValue(':senha', $_POST['senha']);
    $q->execute();

    $auth = $q->fetchAll();

    if (sizeof($auth) == 0) {
        http_response_code(401);
        exit();
    }

    $user = $auth[0];
    $_SESSION['user'] = $user;
    http_response_code(200);
    exit();
}catch(PDOException $ex){
    err('nao foi possivel realizar o login', __LINE__);
}

function err($message = 'error', $debug = 0){
    echo '{
            "status":0,
            "message":"'.$message.'",
            "debug":'.$debug.'
        }';
    exit();
}