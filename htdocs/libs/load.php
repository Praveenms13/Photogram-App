<?php

//------------------------------------------------------------
#TODO: Implement of autoload of class files
include_once "_Includes/User.class.php";
include_once "_Includes/Database.class.php";
include_once "_Includes/Session.class.php";
include_once "_Includes/UserSession.class.php";
include_once "_Includes/WebAPI.class.php";
include_once "_app/Post.class.php";
// include "_traits/SQLGetterSetter.trait.php";
//------------------------------------------------------------
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
