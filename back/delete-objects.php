<?php
/*
session_start();

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');

if(!isset($_POST['id'])){err('id missing', __LINE__);}
if(!ctype_digit($_POST['id'])){err('id not valid', __LINE__);}
if (!isset($_SESSION['user'])) {
  http_response_code(401);
  exit();
}

require_once(__DIR__.'/protected/database.php');

try{
    $q = $db->prepare('DELETE FROM obj WHERE OBJ_ID = :id AND OBJ_USUARIO_ID = :user_id');
    $q->bindValue(':id', $_POST['id']);
    $q->bindValue(':user_id', $_SESSION['user']['USUARIO_ID']);
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
*/
include 'main.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit();
}

$id = $_POST['id'];

$stmt = $conn->prepare('DELETE FROM obj WHERE OBJ_ID = ? AND OBJ_USUARIO_ID = ?');
$stmt->execute([
    $id,
    $_SESSION['user']['USUARIO_ID']
])
?>