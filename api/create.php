<?php
error_reporting(0);
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

$item->name = $_GET['name'];
$item->email = $_GET['email'];
$item->cv = $_GET['cv'];
$item->job = $_GET['job'];
$item->user_image = $_GET['user_image'];

if (empty($item->name) || empty($item->email) || empty($item->cv) || empty($item->job) || empty($item->user_image)) {

    $response = array(
        "code" => 400,
        "message" => "Incomplete data. All fields are required."
    );
    echo json_encode($response);
} else {
    if ($item->createUser()) {
        // No output
        http_response_code(204); // No Content
    } else {
        http_response_code(500); // Internal Server Error
    }
}
