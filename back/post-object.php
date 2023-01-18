<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$target_dir = "imagens/";
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);

$q = $conn->prepare('INSERT INTO obj VALUES (null, :descricao, :imagem, :tipo, :userid)');
$q->bindValue(':descricao', $_POST['descricao']);
$q->bindValue(':imagem', basename($_FILES["imagem"]["name"]));
$q->bindValue(':tipo', $_POST['tipo']);
$q->bindValue(':userid', $_SESSION['user']['USUARIO_ID']);
$q->execute();
$objId = $conn->lastInsertId();

move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file);

?>

