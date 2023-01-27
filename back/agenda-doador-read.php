<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$AgdStatus = "em andamento";

$stmt = $conn->prepare('UPDATE agenda SET AGD_STATUS = :StatusAgenda');
$stmt->bindValue(':StatusAgenda', $AgdStatus);
$stmt = $conn->query('SELECT * FROM agenda INNER JOIN usuario ON agenda.USUARIO_RECEPTOR_ID = usuario.USUARIO_ID WHERE agenda.USUARIO_DOADOR_ID = ' . $_SESSION['user']['USUARIO_ID']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);


?>