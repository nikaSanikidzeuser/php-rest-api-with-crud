<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "../DbConnection.php";
include_once "../user.php";

$DbConnection = new DbConnection();
$db = $DbConnection->getConnection();
$items = new user($db);
$records = $items->getUsers();
$itemCount = $records->num_rows;

if($itemCount > 0)
{
    $userArr = array();
    $userArr["body"] = array();
   
    while($row = $records->fetch_assoc()){
        array_push($userArr["body"], $row);
    }
    echo json_encode($userArr);
} else {
    
    $response = array(
        "code" => 400,
        "message" => "no recod found"
    );
    echo json_encode($response);
}
