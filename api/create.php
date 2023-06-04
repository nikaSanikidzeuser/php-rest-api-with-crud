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

$item->name = $_GET['name'];
$item->email = $_GET['email'];
$item->cv = $_GET['cv'];
$item->job = $_GET['job'];
$item->user_image = $_GET['user_image'];

if ($item->createUser()) {
    echo "User created successfully";
} else {
    echo "User Could not be created";
}