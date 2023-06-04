<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../DbConnection.php';
include_once '../user.php';

$DbConnection = new DbConnection();
$db = $DbConnection->getConnection();
$item = new user($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getSingleUser();
if ($item->id != null) {
    $user_arr = array(
        "id" => $item->id,
        "name" => $item->name,
        "email" => $item->email,
        "cv" => $item->cv,
        "job" => $item->job,
        "user_image" => $item->user_image
    );

    http_response_code(200);
    echo json_encode($user_arr);
} else {
    http_response_code(404);
    echo json_encode("User not Found");
}
