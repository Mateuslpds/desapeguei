<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$q = $conn->prepare('UPDATE AGENDA SET AGD_DATETIME = :hora WHERE AGD_ID = :id;');
$q->bindValue(':hora', $_POST['hora']);
$q->bindValue(':id', $_POST['id']);
$q->execute();

?>