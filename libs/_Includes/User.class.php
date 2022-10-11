<?php

class user
{
    private static $conn;
    public static function check_new_user($username, $phone, $email, $password)
    {
        $password = md5(strrev(sha1(md5(md5($password)))));
        $conn = Database::getConnection();
        $sql = "INSERT INTO `auth` (`username`, `phone`, `email`, `password`)
                VALUES ('$username', '$phone', '$email', '$password');";

        $error = false;
        if ($conn->query($sql) === true) {
            $error = false;
        } else {
            $error = $conn->error;
        }
        $conn->close();
        return $error;
    }
    public static function login($username, $password)
    {
        $password = md5(strrev(sha1(md5(md5($password)))));
        $dbQuery = "SELECT * FROM `auth` WHERE `username` = '$username'";
        $sqlConn = Database::getConnection();
        $result = $sqlConn->query($dbQuery);
        if ($result->num_rows == 1) {
            $row_DB = $result->fetch_assoc();
            if ($row_DB['password'] == $password) {
                return $row_DB;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->conn->query();
    }
}
