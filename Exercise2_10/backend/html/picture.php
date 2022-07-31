<?php
  
$url = 'https://picsum.photos/1200'; 
$img = '/tmp/kube/image.gif'; 

if (file_exists($img)) {
    $date1 = date("d/m/Y", filemtime($img)); // date of file
    $date2 = date("d/m/Y"); // today
    if ($date1 < $date2) {
        // Function to write image into file
        file_put_contents($img, file_get_contents($url));
    }    
}
else {
    // No file, retrieve one
    file_put_contents($img, file_get_contents($url));
}
 
$content = file_get_contents($img);
header('Content-Type: image/gif');
echo $content;
?>