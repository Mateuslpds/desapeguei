<?php
include 'main.php';

$q = $conn->prepare('SELECT * FROM obj');
$q->execute();
$rows = $q->fetchAll();
echo '{"status":1, "data":'.json_encode($rows).'}';
exit();