<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}



$stmt = $conn->query('SELECT * FROM agenda INNER JOIN usuario ON agenda.USUARIO_DOADOR_ID = usuario.USUARIO_ID INNER JOIN obj ON agenda.AGD_OBJ_ID = obj.OBJ_ID WHERE agenda.USUARIO_RECEPTOR_ID = ' . $_SESSION['user']['USUARIO_ID']);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);


?>