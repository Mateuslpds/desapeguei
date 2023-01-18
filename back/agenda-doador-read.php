<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$stmt = $conn->query('SELECT * FROM agenda WHERE USUARIO_DOADOR_ID =' . $_SESSION['user']['USUARIO_ID']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);

//quero inserir um inner join neste, para que apareça o nome de todos os receptores dos quais agendaram
?>