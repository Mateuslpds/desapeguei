<?php
header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

if(!isset($_POST['nome'])){err('nome esta faltando', __LINE__);}
if(!isset($_POST['descricao'])){err('descricao esta faltando', __LINE__);}
if(!isset($_POST['foto'])){err('foto esta faltando',__LINE__);}

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('INSERT INTO obj VALUES (null, :nome, :descricao, :foto)');
    $q->bindValue(':nome', $_POST['nome']);
    $q->bindValue(':descricao', $_POST['descricao']);
    $q->bindValue(':foto', $_POST['foto']);
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