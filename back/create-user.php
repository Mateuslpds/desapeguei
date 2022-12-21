<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

session_start();

if(!isset($_POST['nome'])){err('nome esta faltando', __LINE__);}
if(!isset($_POST['senha'])){err('senha esta faltando', __LINE__);}
if(!isset($_POST['email'])){err('email esta faltando', __LINE__);}
if(!isset($_POST['cpf'])){err('cpf esta faltando', __LINE__);}
if(!isset($_POST['telefone'])){err('telefone esta faltando', __LINE__);}

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('INSERT INTO usuario VALUES (null, :nome, :senha, :email, :cpf, :telefone)');
    $q->bindValue(':nome', $_POST['nome']);
    $q->bindValue(':senha', $_POST['senha']);
    $q->bindValue(':email', $_POST['email']);
    $q->bindValue(':cpf', $_POST['cpf']);
    $q->bindValue(':telefone', $_POST['telefone']);
    $q->execute();
    $userId = $db->lastInsertId();
}catch(PDOException $ex){
    err('nao foi possivel cadastrar o usuario', __LINE__);
}

echo '{"status":1, "message": "usuario criado", "id":"'.$userId.'"}';

function err($message = 'error', $debug = 0){
    echo '{
        "status":0,
        "message":"'.$message.'",
        "debug":'.$debug.'
    }';
    exit();
}