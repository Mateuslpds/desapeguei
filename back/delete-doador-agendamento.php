<?php

include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$id = $_POST['id'];

$stmt = $conn->prepare('DELETE FROM AGENDA WHERE AGD_ID = ? AND USUARIO_DOADOR_ID = ?');
$stmt->execute([
    $id,
    $_SESSION['user']['USUARIO_ID']
])
?>