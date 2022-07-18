<?php
    $filename = "data/data.json";
    include_once("library.php");

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $task_array = json_decode(file_get_contents("php://input"), true);
    $counter = getCounterValue();

    $better_array = taskAddId($counter, $task_array);
    fileWrite($better_array, $filename);    
?>