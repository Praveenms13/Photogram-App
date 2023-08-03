<?php
// namespace praveen_db; if you want to use namespace then you have to use it in all files like /mysqli

class Database
{
    public static $conn = null;
    public static function getConnection()
    {
        if (Database::$conn == null) {
            $mysql_servername = get_config('DBservername');
            $mysql_dbname = get_config('DBname');
            $mysql_username = get_config('DBusername');
            $mysql_password = get_config('DBpassword');
            $connection = new mysqli($mysql_servername, $mysql_username, $mysql_password, $mysql_dbname);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } else {
                Database::$conn = $connection;
                return  Database::$conn;
            }
        } else {
            return Database::$conn;
        }
    }
}
