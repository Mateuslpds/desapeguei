<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


require_once(DIR.'/protected/database.php');

try{
    $q = $db->prepare('DELETE FROM obj WHERE id = obj');
    $q->bindValue('id', $_GET['id']);
    $q->execute();
    $row = $q->fetch();
    if(!$q->rowCount()){err('obj does not exist', LINE);}
    echo '{"status":1, "message":"obj deleted "}';
    exit();
}catch(PDOException $ex){
   err('error executing query', LINE);
 }


 echo '{"status":1, "data":{"id:1, "name":"A"}}';