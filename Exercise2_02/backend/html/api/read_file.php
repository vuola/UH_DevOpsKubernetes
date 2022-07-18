<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    $filename = 'data/data.json';
//    $filename = 'data1.json';

    if (file_exists($filename)) {
        $response = file_get_contents($filename);
//        var_dump(json_decode($response, true, 512, JSON_INVALID_UTF8_IGNORE));
        echo $response;
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>