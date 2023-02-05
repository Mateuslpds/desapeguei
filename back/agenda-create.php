<?php
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
};



$AgdStatus = "aberto";

$a = $conn->prepare('INSERT INTO agenda VALUES(null, :userdoar, :usereceber, :objeid, :dh, :statusAgenda)');
$a->bindValue(':userdoar', $_SESSION['obj']['OBJ_USUARIO_ID']);
$a->bindValue(':usereceber', $_SESSION['user']['USUARIO_ID']);
$a->bindValue(':objeid', $_SESSION['obj']['OBJ_ID']);
$a->bindValue(':dh', $_POST['datahora']);
$a->bindValue('statusAgenda', $AgdStatus);
$a->execute();
$agdid = $conn->lastInsertId();
?>