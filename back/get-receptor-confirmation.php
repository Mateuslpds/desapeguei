<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$AgdStatus = "fechado";

$stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt->execute();

if(isset($_SESSION['confirmation'])){
    http_response_code(200);
    session_destroy($_SESSION['confirmation']);
};
?>