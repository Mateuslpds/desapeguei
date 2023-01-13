<?php
require 'main.php';

$obj = $_GET['obj'];

$stmt = $conn->prepare('SELECT * FROM obj WHERE OBJ_ID = :obj');
$stmt->execute([
    'obj' => $obj
]);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (sizeof($data) == 0) {
    http_response_code(401);
    exit();
}

$obj = $data[0];
$_SESSION['obj'] = $obj;
http_response_code(200);
?>