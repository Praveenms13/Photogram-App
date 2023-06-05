<?php
class Session
{
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
    function loadIndex($file)
    {
        include $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "$file.php";
    }
    public static function loadTemplate($file_form)
    {
        include $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "template/$file_form.php";
    }
    public static function loadAccess($file)
    {
        include $_SERVER['DOCUMENT_ROOT'] . get_config('path') . "access/$file.php";
    }
    public static function renderPage()
    {
        Session::loadTemplate('_master');
    }
    public static function currentScript()
    {
        return basename($_SERVER['PHP_SELF'], '.php');
    }
}
