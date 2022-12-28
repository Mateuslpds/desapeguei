<?php
require 'main.php';

$q = $conn->prepare('INSERT INTO usuario VALUES (null, :nome, :senha, :email, :cpf, :telefone)');
$q->bindValue(':nome', $_POST['nome']);
$q->bindValue(':senha', $_POST['senha']);
$q->bindValue(':email', $_POST['email']);
$q->bindValue(':cpf', $_POST['cpf']);
$q->bindValue(':telefone', $_POST['telefone']);
$q->execute();
$userId = $conn->lastInsertId();

http_response_code(201);
?>