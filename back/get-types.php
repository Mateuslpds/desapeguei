<?php
include 'main.php';

$stmt = $conn->query('SELECT * FROM tipo');
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>