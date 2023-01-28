<?php
include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$AgdStatus = "fechado";

if($stmt = $conn->query('SELECT AGD_STATUS FROM agenda') == "semi fechado"){
    $AgdStatus;
}

$stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda WHERE AGD_ID = :id');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();

http_response_code(200);
?>