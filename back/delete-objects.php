<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$id = $_POST['id'];

$stmt = $conn->prepare('DELETE FROM obj WHERE OBJ_ID = ? AND OBJ_USUARIO_ID = ?');
$stmt->execute([
    $id,
    $_SESSION['user']['USUARIO_ID']
])
?>