<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/tasks.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Task($db);

    $len = isset($_GET['len']) ? $_GET['len'] : '';
    $owner = isset($_GET['owner']) ? $_GET['owner'] : '';

    if (($len == '') && ($owner == '')) {
        sprintf('! PING !');
        $stmt = $items->getTasks();
    }
    else
        $stmt = $items->getLatestTasks($len, $owner);

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
