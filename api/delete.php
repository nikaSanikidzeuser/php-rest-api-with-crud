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

if ($item->deleteUser()) {
    $response = array(
        "code" => 200,
        "message" => "user deleted"
    );
    echo json_encode($response);
} else {
    $response = array(
        "code" => 400,
        "message" => "user does not exist"
    );
    echo json_encode($response);
}
