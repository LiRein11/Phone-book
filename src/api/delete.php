<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type");

    include_once 'config/database.php';
    include_once 'class/user.php';
    
    $database = new DB();
    $db = $database->getConnection();
    
    $item = new User($db);
       
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    if($item->deleteUser()){
        echo json_encode("User deleted.");
    } else{
        echo json_encode("Not deleted");
    }
?>
