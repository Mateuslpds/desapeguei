<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(!isset($_GET['id'])){err('id missing', __LINE__);}
if(!ctype_digit($_GET['id'])){err('id not valid', __LINE__);}

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('DELETE FROM obj WHERE OBJ_ID = :id');
    $q->bindValue(':id', $_GET['id']);
    $q->execute();
    if(!$q->rowCount()){err('obj does not exist', __LINE__);}
    echo '{"status":1, "message":"obj deleted "}';
    exit();
}catch(PDOException $ex){
   err('error executing query', __LINE__);
 }


 echo '{"status":1, "data":{"id:1, "name":"A"}}';

function err($message = 'error', $debug = 0){
  echo '{
          "status":0,
          "message":"'.$message.'",
          "debug":'.$debug.'
      }';
  exit();
}