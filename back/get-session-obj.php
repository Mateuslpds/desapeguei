<?php
include 'main.php';

$obj = $_GET['obj'];
$_SESSION['obj'] = $obj;
echo $_SESSION['obj'];
?>