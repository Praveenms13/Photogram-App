<?php
class Database
{
    public static $conn = null;
    public static function getConnection()
    {
        if (Database::$conn == null) {
            $mysql_servername = "mysql.selfmade.ninja";
            $mysql_username = "Praveen_mysql";
            $mysql_password = "Welcome@2003";
            $mysql_dbname = "Praveen_mysql_13";
            $connection = new mysqli($mysql_servername, $mysql_username, $mysql_password, $mysql_dbname);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } else {
                //echo("New Connection...");
                Database::$conn = $connection;
                return  Database::$conn;
            }
        } else {
            //echo("Existing Connection...");
            return Database::$conn;
        }
    }
}
