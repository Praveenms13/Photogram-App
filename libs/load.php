<?php

include "_Includes/User.class.php";
include "_Includes/Database.class.php";
include "_Includes/Session.class.php";
global $__DBconfig;
$__DBconfig = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../config_files/photogram.json");

Session::start();

function get_config($key, $default_key = 0){
    global $__DBconfig;
    $config = json_decode($__DBconfig, true);
    if (isset($config[$key])) {
        return $config[$key];
    }else{
        return $default_key;
    }
}
function loadAccess($file_form)
{
    // include __DIR__ . "/../template/$file_form.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/photogram/template/$file_form.php";
}
function loadAc($file)
{
    include $_SERVER['DOCUMENT_ROOT'] . "/photogram/album/$file.php";
}
