<?php
    include 'main.php';

    $stmt = $conn->query('SELECT * FROM obj INNER JOIN usuario  ON obj.OBJ_USUARIO_ID = usuario.USUARIO_ID');
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

?>