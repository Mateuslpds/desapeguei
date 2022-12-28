<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$q = $conn->prepare('INSERT INTO obj VALUES (null, :descricao, :imagem, :userid)');
$q->bindValue(':descricao', $_POST['descricao']);
$q->bindValue(':imagem', $_POST['imagem']);
$q->bindValue(':userid', $_SESSION['user']['USUARIO_ID']);
$q->execute();
$objId = $conn->lastInsertId();
?>