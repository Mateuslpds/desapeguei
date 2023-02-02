<?php
include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$AgdStatus = "fechado";

$stmt = $conn->prepare('UPDATE agenda SET AGD_OBJ_ID = null, AGD_STATUS = :StatusAgenda WHERE AGD_ID = :id AND AGD_STATUS != "aberto"');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();

http_response_code(200);
?>