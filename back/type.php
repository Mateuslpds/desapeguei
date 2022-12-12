<?php
   
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once(DIR.'/protected/database.php');

try{
    $q= $db->prepare('INSERT INTO tipo VALUES (null, :descricao)');
    $q= bindValue(':descricao',$_POST['descricao']);
    $typeid= $db->lastInsertId();

}catch(PDOException $ex){
    err('nao foi possivel inserir o tipo', __LINE__);
}

echo '{"status":1, "message": "tipo inserido", "id":"'.$typeid.'"}';

function err($message = 'error', $debug = 0){
    echo '{
        "status":0,
        "message":"'.$message.'",
        "debug":'.$debug.'
    }';
    exit();
}

?>