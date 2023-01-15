<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$stmt = $conn->query('SELECT * FROM agenda WHERE AGD_OBJ_ID =' . $_SESSION['obj']['OBJ_USUARIO_ID']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);


?>