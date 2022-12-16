<?php
session_start();

header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');


require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('SELECT * FROM usuario WHERE USUARIO_EMAIL = :email AND USUARIO_SENHA = :senha');
    $q->bindValue(':email', $_POST['email']);
    $q->bindValue(':senha', $_POST['senha']);
    $q->execute();
    $auth = $q->fetch();
    if(!$auth){err('user not found', __LINE__);}
    $_SESSION['userid'] = json_encode($auth['USUARIO_ID']);
    echo json_encode($auth);
    exit();
}catch(PDOException $ex){
    err('doideira', __LINE__);
}

function err($message = 'error', $debug = 0){
    echo '{
            "status":0,
            "message":"'.$message.'",
            "debug":'.$debug.'
        }';
    exit();
}