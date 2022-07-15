<?php

    $ch = curl_init();
  
    $url = "http://pingpong-svc:2346/index.php";
    $dataArray = ['num' => 'true'];

    $filename = "label.txt"; // This is at root of the file using this script.

    $data = http_build_query($dataArray);

    $getUrl = $url."?".$data;

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $getUrl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
   
    $response = curl_exec($ch);
     

    if (curl_error($ch)) {
        echo 'Request Error:' . curl_error($ch);
    } else {
        if (file_exists($filename)) {
            $fd = fopen ($filename, "r"); // opening the file in read mode
            $contents = fread ($fd, filesize($filename)); // reading the content of the file
            fclose ($fd); // Closing the file pointer
            echo "$contents "; 
            echo '<br />';
        }
        echo "Ping / Pongs: " . $response;
    }

    curl_close($ch);

?>