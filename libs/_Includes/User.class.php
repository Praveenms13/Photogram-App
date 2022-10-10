<?php

class user
{
    private static $conn;
    public static function check_new_user($username, $phone, $email, $password)
    {
        //$password = md5(strrev(sha1(md5(md5($password)))));
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
    public function __construct($username){
        $this->conn = Database::getConnection();
        $this->conn->query();
    }
}
