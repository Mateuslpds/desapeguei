<?php
include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$sql = $conn->prepare('SELECT AGD_STATUS FROM agenda WHERE AGD_ID = :id');
$sql->bindValue(':id', $_GET['id']);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

$status = print_r($result[0]['AGD_STATUS'], true);

if($status == 'aberto'){
    $AgdStatus = 'semi-confirm-doador';
    $stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda WHERE AGD_ID = :id');
    $stmt->bindValue(':StatusAgenda', $AgdStatus);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
}
if($status == 'semi-confirm-recep'){
    $AgdStatus = 'confirmado';
    $stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda WHERE AGD_ID = :id');
    $stmt->bindValue(':StatusAgenda', $AgdStatus);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
}

http_response_code(200);
?>