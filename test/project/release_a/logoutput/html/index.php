<?php 
$filename = "label.txt"; // This is at root of the file using this script.
if (file_exists($filename)) {
    $fd = fopen ($filename, "r"); // opening the file in read mode
    $contents = fread ($fd, filesize($filename)); // reading the content of the file
    fclose ($fd); // Closing the file pointer
    echo "$contents "; 
    echo '<br />';
}

$filename = "/tmp/kube/counter.txt"; 
if (file_exists($filename)) {
    $fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
    $contents = fread ($fd, filesize($filename)); // reading the content of the file
    fclose ($fd); // Closing the file pointer
}
else {
    $contents = "0";
}

echo "Ping / Pongs: $contents\n"; // printing the incremented counter value

?>