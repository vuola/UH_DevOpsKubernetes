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

    $item = new Task($db);

    $data = json_decode(file_get_contents("php://input"));

    if (strlen($data->description) <= 140)
        $item->description = $data->description;
    else {
        trigger_error("Task description is too long (over 140).", E_USER_ERROR);
        exit;
    }
    $item->owner = $data->owner;
    $item->status = $data->status;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createTask()){
        echo 'Task created successfully.';
    } else{
        trigger_error("Task could not be created.", E_USER_ERROR);
    }
?>