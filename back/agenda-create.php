<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
};

date_default_timezone_set("America/Recife");
$datahora = date ('Y-m-d H:i:s');

$a = $conn->prepare('INSERT INTO agenda VALUES(null, :userdoar, :usereceber, :objeid, :dh, :CEP)');
$a->bindValue(':userdoar', $_SESSION['obj']['OBJ_USUARIO_ID']);
$a->bindValue(':usereceber', $_SESSION['user']['USUARIO_ID']);
$a->bindValue(':objeid', $_SESSION['obj']['OBJ_ID']);
$a->bindValue('dh', $datahora);
$a->bindValue(':CEP', $_POST['CEP']);
$a->execute();
$agdid = $conn->lastInsertId();


?>