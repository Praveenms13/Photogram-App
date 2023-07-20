<?php

include_once "libs/load.php";
$upload_path = get_config('ImgUploadPath');
$fname = $_GET['name'];
$file = $upload_path . $fname;
// TODO: Lots of security issues here....
if (is_file($file)) {
    header("Content-Type: " . mime_content_type($file));
    header("Content-Length: " . filesize($file));
    echo file_get_contents($file);
} else {
    echo "File Not Found";
}
