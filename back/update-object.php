<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$q = $conn->prepare('UPDATE obj SET OBJ_DESCRICAO = :descricao, OBJ_IMG = :imagem WHERE OBJ_ID = :id;');
$q->bindValue(':descricao', $_POST['descricao']);
$q->bindValue(':imagem', $_POST['imagem']);
$q->bindValue(':id', $_POST['id']);
$q->execute();
exit();
?>