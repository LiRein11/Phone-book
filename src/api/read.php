<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Headers: *");
    header("Referrer-Policy: \"no-referrer\";");
    
    include_once 'config/database.php';
    include_once 'class/user.php';

    $database = new DB();
    $db = $database->getConnection();

    $items = new User($db);

    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $userArr = array();
       

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "phone" => $phone,
                "organization" => $organization
            );

            array_push($userArr, $e);
        }
        echo json_encode($userArr, JSON_UNESCAPED_UNICODE);
    }

?>