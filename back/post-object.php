<?php
session_start();

header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}
if(!isset($_POST['descricao'])){err('descricao esta faltando', __LINE__);}
if(!isset($_POST['imagem'])){err('imagem esta faltando',__LINE__);}

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('INSERT INTO obj VALUES (null, :descricao, :imagem, :tipoid, :userid)');
    $q->bindValue(':descricao', $_POST['descricao']);
    $q->bindValue(':imagem', $_POST['imagem']);
    $q->bindValue(':userid', $_SESSION['tipo']['TIPO_ID']);
    $q->bindValue(':userid', $_SESSION['user']['USUARIO_ID']);
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