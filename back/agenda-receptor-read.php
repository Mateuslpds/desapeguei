<?php

include 'main.php';

if (!isset($_SESSION["user"])) {
    http_response_code(401);
    exit();
}

$stmt = $conn->query('SELECT * FROM agenda INNER JOIN usuario ON agenda.USUARIO_DOADOR_ID = usuario.USUARIO_ID ');
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);

//tentativa de fazer um inner join para que pudesse aparecer o nome de todos os doadores dos quais o receptor agendou

// é interessante usar um inner join para tentar fazer aparecer a descrição do objeto também
?>