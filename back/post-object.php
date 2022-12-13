<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(!isset($_POST['descricao'])){err('descricao esta faltando', __LINE__);}
if(!isset($_POST['foto'])){err('foto esta faltando',__LINE__);}

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('INSERT INTO obj VALUES (null, :descricao, :foto, :userid)');
    $q->bindValue(':descricao', $_POST['descricao']);
    $q->bindValue(':foto', $_POST['foto']);
    $q->bindValue(':userid', $_SESSION['userid']);
    $q->execute();
    $objId = $db->lastInsertId();
}catch(PDOException $ex){
    err('nao foi possivel postar a doação', __LINE__);
}

echo '{"status":1, "message": "doação postada", "id":"'.$objId.'"}';

function err($message = 'error', $debug = 0){
    echo '{
        "status":0,
        "message":"'.$message.'",
        "debug":'.$debug.'
    }';
    exit();
}

?>