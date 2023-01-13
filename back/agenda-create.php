<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
};

$a = $conn->prepare('INSERT INTO agenda VALUES(null, :userdoar, :usereceber, :objeid, :datahora, :cep )');
$a->bindValue(':userdoar', $_SESSION['obj']['OBJ_USUARIO_ID']);
$a->bindValue(':usereceber', $_SESSION['user']['USUARIO_ID']);
$a->bindValue(':objeid', $_SESSION['obj']['OBJ_ID']);
$a->bindValue(':datahora', $_POST['datahora']);
$a->bindValue(':cep', $_POST['cep']);
$a->execute();
$agdid = $conn->lastInsertId();


?>