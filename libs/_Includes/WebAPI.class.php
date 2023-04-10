<?php

class WebAPI
{
    public function __construct()
    {
        if (php_sapi_name() == 'cli') {
            global $__DBconfig;
            $__DBconfigPath = "/home/mspraveenkumar77/config_files/photogram.json";
            $__DBconfig = file_get_contents($__DBconfigPath);
        } elseif (php_sapi_name() == 'apache2handler') {
            global $__DBconfig;
            $__DBconfigPath = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']);
            $__DBconfig = file_get_contents($__DBconfigPath . "/../config_files/photogram.json");
        }
        Database::getConnection();
    }

    public function initiateSession()
    {
        Session::start();
    }
}
