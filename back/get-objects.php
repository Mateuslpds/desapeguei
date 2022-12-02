<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('SELECT * FROM obj');
    $q->execute();
    $rows = $q->fetchAll();
    echo '{"status":1, "data":'.json_encode($rows).'}';
    exit();
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