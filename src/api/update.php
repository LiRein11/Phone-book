<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type");

    include_once 'config/database.php';
    include_once 'class/user.php';
    
    $database = new DB();
    $db = $database->getConnection();
    
    $item = new User($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    $item->name = $data->name;
    $item->phone = $data->phone;
    $item->organization = $data->organization;
   
    
    if($item->updateUser()){
        echo json_encode("User record updated.");
    } else{
        echo json_encode("User record could not be updated.");
    }
?>