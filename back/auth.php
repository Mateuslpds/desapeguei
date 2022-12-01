<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('SELECT id FROM users WHERE email = :email AND senha = :senha');
    $q->bindValue(':email', $_POST['email']);
    $q->bindValue(':senha', $_POST['senha']);
    $q->execute();
    $auth = $q->fetch();
    if(!$auth){err('user not found', __LINE__);}
    $res = $auth;
    $_SESSION['userid'] = json_encode($res);
    echo json_encode($res);
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