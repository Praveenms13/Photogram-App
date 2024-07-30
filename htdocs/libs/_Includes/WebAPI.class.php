<?php

class WebAPI
{
    public function __construct()
    {
        if (php_sapi_name() == 'cli') {
            global $__DBconfig;
            $__DBconfigPath = "/home/mspraveenkumar77/htdocs/photogram/WorkSpaceConfiguration/photogram.json";
            $__DBconfig = file_get_contents($__DBconfigPath);
        } elseif (php_sapi_name() == 'apache2handler') {
            global $__DBconfig;
            // checks if the server is a symlink
            $__DBconfigPath = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']);
            $__DBconfig = file_get_contents($__DBconfigPath . "/WorkSpaceConfiguration/photogram.json");
        }
        Database::getConnection();
    }

    public function initiateSession()
    {
        Session::start();
        try {
            if (Session::get('sessionToken')) {
                Session::$usersession = usersession::authorize(Session::get('sessionToken'), Session::get('sessionFingerprintJSid'));
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorSubject = "Error !!";
            usersession::dispError($errorSubject, $errorMessage);
        }
    }
}
