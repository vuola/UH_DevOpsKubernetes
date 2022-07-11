<?php 

$filename = "counter.txt"; // This is at root of the file using this script.
$fd = fopen ($filename, "r"); // opening the file counter.txt in read mode
$contents = fread ($fd, filesize($filename)); // reading the content of the file
fclose ($fd); // Closing the file pointer
echo 'PONG ' . $contents; // printing the incremented counter value
$contents=$contents+1; // incrementing the counter value by one
/*
The above code will do the reading and displaying the counter to the screen, now we have to store the above value in the same counter.txt file by overwriting the old data with the new counter data. We will open the counter.txt file in write mode and then write to it.
*/

$fp = fopen ($filename, "w"); // Open the file in write mode
fwrite ($fp,$contents); // Write the new data to the file
fclose ($fp); // Closing the file pointer

?>