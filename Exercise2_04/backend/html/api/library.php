<?php

function fileWrite($new_row, $filename) {
    $message = "<label class='text-success'>fileWrite failed.</p>";

    if(file_exists($filename)) {
        $master_array = json_decode(file_get_contents($filename), true);
        var_dump($master_array);
    }
    else {
        $master_array = array();
        var_dump($master_array);
    }
    $final_array = cumulativeArray($new_row, $master_array);
    var_dump($final_array);

    if (file_put_contents($filename, json_encode($final_array)))
        $message = "<label class='text-success'>Data added Successfully</p>";

    return $message;
}

function cumulativeArray($new_row, $master_array) {

        $master_array[] = $new_row;
		return $master_array;
}

function getCounterValue() {

    $filename = "counter.txt";

    if (file_exists($filename)) {
        $fd = fopen ($filename, "r"); 
        $value = fread ($fd, filesize($filename)); 
        fclose ($fd); 
    } 
    else {
        $value = "1";
    }

    $new_value = $value + 1; 
    $fp = fopen ($filename, "w"); 
    fwrite ($fp, $new_value); 
    fclose ($fp); 

    return $value; 
}

function taskAddId($id, $task_array) {
    $sub = array_reverse($task_array);
    $sub["id"] = $id;
    $sub = array_reverse($sub);
    return $sub;
}

?>