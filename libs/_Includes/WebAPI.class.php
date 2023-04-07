<?php

global $__DBconfig;
global $__DBconfigPath;
class WebAPI
{
    public function __construct()
    {
        Database::getConnection();
    }

    public function initiateSession()
    {
        Session::start();
    }
}
