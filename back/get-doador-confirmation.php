<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$AgdStatus = "semi fechado";

$stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda WHERE AGD_ID = :id');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($data['AGD_STATUS'] == $AgdStatus) {
    http_response_code(401);
    exit();
}

http_response_code(200);

?>