<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$id = $_POST['id'];
$target_dir = 'imagens/'.$_POST['imagem'];

$AgdStatus = "fechado";

$stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt->execute();

if(!isset($_SESSION['confirmation'])){

http_response_code(401);

};

http_response_code(200);
session_destroy($_SESSION['confirmation']);

$stmt = $conn->prepare('DELETE FROM agenda WHERE AGD_ID = ? AND USUARIO_RECEPTOR_ID = ?');
$stmt->execute([
    $id,
    $_SESSION['user']['USUARIO_ID']
]);

?>