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

$item->id = isset($_GET['id']) ? $_GET['id'] : '';

$item->name = isset($_GET['name']) ? $_GET['name'] : '';
$item->email = isset($_GET['email']) ? $_GET['email'] : '';
$item->cv = isset($_GET['cv']) ? $_GET['cv'] : '';
$item->job = isset($_GET['job']) ? $_GET['job'] : '';
$item->user_image = isset($_GET['user_image']) ? $_GET['user_image'] : '';


if (empty($item->id)) {

    $response = array(
        "code" => 400,
        "message" => "id parameter is empty or doesnt exist"
    );
    echo json_encode($response);
} elseif (empty($item->name)) {

    $response = array(
        "code" => 400,
        "message" => "name parameter is empty or bad format"
    );
    echo json_encode($response);
} elseif (empty($item->email)) {

    $response = array(
        "code" => 400,
        "message" => "email parameter is empty or bad format"
    );
    echo json_encode($response);
} elseif (empty($item->cv)) {

    $response = array(
        "code" => 400,
        "message" => "cv parameter is empty or bad format"
    );
    echo json_encode($response);
} elseif (empty($item->job)) {

    $response = array(
        "code" => 400,
        "message" => "job parameter is empty or bad format"
    );
    echo json_encode($response);
} elseif (empty($item->user_image)) {

    $response = array(
        "code" => 400,
        "message" => "user_iamge parameter is empty or bad format"
    );
    echo json_encode($response);
} else {

    if ($item->updateUser()) {
        $response = array(
            "code" => 200,
            "message" => "User data updated."
        );
        echo json_encode($response);
    } else {

        $response = array(
            "code" => 400,
            "message" => "user data could not be updated."
        );
        echo json_encode($response);
    }
}
