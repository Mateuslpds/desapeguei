<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}


$q = $conn->prepare('UPDATE usuario SET USUARIO_SENHA = :Novasenha WHERE USUARIO_EMAIL = :email');
$q->bindValue(':Novasenha', $_POST['senha']);
$q->bindValue(':email', $_POST['email']);
$q->execute();



?>