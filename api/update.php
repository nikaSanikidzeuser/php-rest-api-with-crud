<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-type,Access-Control-Allow-Headers,Authorization,X-requested-With");

include_once '../DbConnection.php';
include_once '../user.php';
$DbConnection = new DbConnection();
$db = $DbConnection->getConnection();
$item = new User($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->name = $_GET['name'];
$item->email = $_GET['email'];
$item->cv = $_GET['cv'];
$item->job = $_GET['job'];
$item->user_image = $_GET['user_image'];

if($item->updateUser()){
    $item->updateUser();
    echo json_encode("User data updated");

}else{
    echo json_encode("data could not be updated");
}
