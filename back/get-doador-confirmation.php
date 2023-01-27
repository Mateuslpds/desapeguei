<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$AgdStatus = "semi fechado";

$stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($data['AGD_STATUS'] != $AgdStatus) {
    http_response_code(401);
    exit();
}


$_SESSION['confirmation'] = $data;
http_response_code(200);
echo $_SESSION['confirmation'];
?>