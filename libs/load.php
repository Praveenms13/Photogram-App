<?php
//------------------------------------------------------------
include "_Includes/User.class.php";
include "_Includes/Database.class.php";
include "_Includes/Session.class.php";
include "_Includes/UserSession.class.php";
include "_Includes/WebAPI.class.php";
//------------------------------------------------------------
// global $__DBconfig;
// global $__DBconfigPath; // moved to WebAPI.class.php
// $__DBconfigPath = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']); //moved to WebAPI.class.php
//---------------------------For CI/CD Practises------------------------------------------------------------------------------------------------
// echo "Returned Path: " . $__DBconfigPath;
// if ($_SERVER['APPLICATION_ENV'] == "Production") {
//     // keep the config file outside the web root /var/www/html/|till here|/../config_files/photogram.json
//     $__DBconfig = file_get_contents($__DBconfigPath . "/../config_files/photogram.json");
// } else  {
//     // keep the config file outside the web root /var/www/|till here|/config_files/photogramDev.json
//     $__DBconfig = file_get_contents($__DBconfigPath . "/config_files/photogramDev.json");
// }
//-------------------------------CI/CD Practises Ends--------------------------------------------------------------------------------------------
//$__DBconfig = file_get_contents($__DBconfigPath . "/../config_files/photogram.json"); //moved to WebAPI.class.php
//------------------------------------------------------------
$webAPI = new WebAPI();
$webAPI->initiateSession();
//------------------------------------------------------------
function get_config($key, $default_key = 0)
{
    global $__DBconfig;
    $config = json_decode($__DBconfig, true);
    if (isset($config[$key])) {
        return $config[$key];
    } else {
        return $default_key;
    }
}
function loadTemplate($file_form)
{
    include $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "template/$file_form.php";
}
function loadAccess($file)
{
    include $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "access/$file.php";
}
