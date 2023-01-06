<?php
    include 'main.php';

    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        exit();
    }

    $q = $conn->prepare('INSERT INTO tipo VALUES(null, :tipo');
    $q->bindValue(':tipo', $_POST['tipo']);
    $q->execute();
    $typeId = $conn->lastInsertId();
    

    $data = $q->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['tipo'] = $typeId;

?>