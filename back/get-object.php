<?php
include 'main.php';

$stmt = $conn->query('SELECT * FROM obj WHERE OBJ_ID = ' . $_SESSION['obj']['OBJ_ID']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>