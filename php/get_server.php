<?php
$filePath = "../json/card_read.json";

$file = fopen($filePath, "c+");
if(filesize($filePath) == 0){
    die(json_encode(array("success" => false, "message" => "File is Empty.")));
}
if (flock($file, LOCK_EX)) { // Exclusive lock for writing
    $contents = fread($file, filesize($filePath));
    ftruncate($file, 0); // Truncate the file
    fflush($file); // Ensure all data is written to disk
    flock($file, LOCK_UN); // Release the lock
} else {
    throw new Exception("Could not lock file for writing");
}
fclose($file);

die(json_encode(array("success" => true, "content" => $contents)));
?>