<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$id = $_POST['id'];
$target_dir = 'imagens/'.$_POST['imagem'];

$stmt = $conn->prepare('DELETE FROM obj WHERE OBJ_ID = ? AND OBJ_USUARIO_ID = ?');
$stmt->execute([
    $id,
    $_SESSION['user']['USUARIO_ID']
]);

if (!unlink($target_dir)) {
    echo ("$target_dir cannot be deleted due to an error");
}
else {
    echo ("$target_dir has been deleted");
}
?>