<?php 

    $filename = "counter.txt";

    if (file_exists($filename)) {
        $fd = fopen ($filename, "r"); // opening the file in read mode
        $contents = fread ($fd, filesize($filename)); // reading the content of the file
        fclose ($fd); // Closing the file pointer
    } 
    else {
        $contents = "0";
    }

    if( isset($_GET['num']) )
    {     
      echo $contents;
      exit();
    }
    else echo "PONG " . $contents;

    $contents = $contents + 1;
    $fp = fopen ($filename, "w"); // Open the file in write mode
    fwrite ($fp, $contents); // Write the new data to the file
    fclose ($fp); // Closing the file pointer

?>