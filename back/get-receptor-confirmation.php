<?php

include 'main.php';


$ConfirmaReceptor = true;

session_destroy($_SESSION['CD']);
$stmt = $conn->prepare('DELETE FROM AGENDA WHERE AGD_ID = ? AND USUARIO_RECEPTOR_ID = ?');
$stmt->execute([
    $_SESSION['user']['USUARIO_ID']
])
?>