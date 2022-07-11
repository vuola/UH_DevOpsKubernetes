<?php 

$filename = "./file/label.txt"; // this is a shared location
if (file_exists($filename)) {
    $fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
    $contents = fread ($fd, filesize($filename)); // reading the content of the file
    fclose ($fd); // Closing the file pointer
    echo $contents; // printing the incremented counter value   
}

?>