<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$old_file = 'imagens/'.$_POST['imgEdit'];

if (!unlink($old_file)) {
    echo ("$old_file cannot be deleted due to an error");
}
else {
    echo ("$old_file has been deleted");
}

$target_dir = "imagens/";
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);

$q = $conn->prepare('UPDATE obj SET OBJ_NOME = :nome, OBJ_DESCRICAO = :descricao, OBJ_IMG = :imagem, OBJ_TIPO_ID = :tipo WHERE OBJ_ID = :id;');
$q->bindValue(':nome', $_POST['nome']);
$q->bindValue(':descricao', $_POST['descricao']);
$q->bindValue(':imagem', basename($_FILES["imagem"]["name"]));
$q->bindValue(':tipo', $_POST['tipo']);
$q->bindValue(':id', $_POST['id']);
$q->execute();

move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file);
?>