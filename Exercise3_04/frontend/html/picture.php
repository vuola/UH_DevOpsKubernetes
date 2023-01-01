<?php
  
$url = 'https://picsum.photos/1200'; 
$img = '/tmp/kube/image.gif';
$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0"
        )
    )
);     

if (file_exists($img)) {
    $date1 = date("d/m/Y", filemtime($img)); // date of file
    $date2 = date("d/m/Y"); // today
    if ($date1 < $date2) {
        // Function to write image into file
        $content = file_get_contents($url, false, $context);
        file_put_contents($img, $content);
    }    
}
else {
    // No file, retrieve one
 
    $content = file_get_contents($url, false, $context);
    file_put_contents($img, $content);
}
 
$content = file_get_contents($img);
header('Content-Type: image/gif');
echo $content;
?>