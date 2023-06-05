<?php

class Session
{
    public static $user = null;
    public static $usersession = null;
    public static function start()
    {
        session_start();
    }
    public static function unset()
    {
        session_unset();
    }
    public static function destroy()
    {
        session_destroy();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function isset($key)
    {
        return isset($key);
    }
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }
    public static function get($key, $default = 0)
    {
        if (Session::isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }
    public static function getUser()
    {
        return Session::$user;
    }
    public static function getUserSession()
    {
        return Session::$usersession;
    }
    public static function loadTemplate($file_form)
    {
        $script = $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "template/$file_form.php";
        if (is_file($script)) {
            include $script;
        } else {
            Session::loadIndex('404.php');
        }
    }
    public function loadIndex($file)
    {
        include $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "$file.php";
    }
    public static function renderPage()
    {
        Session::loadTemplate('_master');
    }
    public static function currentScript()
    {
        return basename($_SERVER['PHP_SELF'], '.php');
    }
    public static function isAuthenticated()
    {
        //TODO : Is it a correct way to check the user is authenticated or not?
        if (is_object(Session::getUserSession())) {
            return Session::getUserSession()->isValid();
        }
        return false;
    }
    public static function ensureLogin()
    {
        if (!Session::isAuthenticated()) {
            header('Location: /login.php');
            die();
        }
    }
}
