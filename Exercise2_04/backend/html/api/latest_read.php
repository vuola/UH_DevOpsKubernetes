<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/tasks.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Task($db);

    $len = isset($_GET['len']) ? $_GET['len'] : die();

    $stmt = $items->getLatestTasks($len);
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $taskArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $t = array(
                "id" => $id,
                "description" => $description,
                "owner" => $owner,
                "status" => $status,
                "created" => $created
            );

            array_push($taskArr, $t);
        }
        echo json_encode($taskArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
