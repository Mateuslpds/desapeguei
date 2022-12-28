<?php
/*
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

require_once(__DIR__.'/protected/database.php');

session_start();

if(!isset($_SESSION['user'])){
    http_response_code(401);
    exit();
}

try{
    $q = $db->query('SELECT * FROM obj WHERE OBJ_USUARIO_ID = ' . $_SESSION['user']['USUARIO_ID']);
    $rows = $q->fetchAll();
    echo json_encode($rows);
    //exit();
}catch(PDOException $ex){
    err('erro executando a query', __LINE__);
}

function err($message = 'error', $debug = 0){
    echo '{
        "status":0,
        "message":"'.$message.'",
        "debug":'.$debug.'
    }';
    exit();
}
*/
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$stmt = $conn->query('SELECT * FROM obj WHERE OBJ_USUARIO_ID = ' . $_SESSION['user']['USUARIO_ID']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>