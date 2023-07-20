<?php
include_once 'libs/load.php';

$imageTmp = $_FILES['up_image']['tmp_name'];
$text = $_POST['up_text'];
if (isset($imageTmp) and isset($text)) {
  posts::registerPost($text, $imageTmp);
} else {
  throw new Exception("Invalid Parameters......");
}
