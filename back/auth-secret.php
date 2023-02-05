<?php
require 'main.php';

$S_secret = $_POST['secreto'];
$email = $_POST['email'];

$stmt = $conn->prepare('SELECT * FROM usuario WHERE USUARIO_SECRET = :secreto AND USUARIO_EMAIL = :email');
$stmt->execute([
    'secreto' => $S_secret,
    'email' => $email
]);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (sizeof($data) == 0) {
    http_response_code(401);
    exit();
}

$user = $data[0];
$_SESSION['user'] = $user;
http_response_code(200);
?>