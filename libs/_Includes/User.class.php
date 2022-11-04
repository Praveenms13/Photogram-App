<?php

class user
{
    private $user_conn;    
    private $id;
    private $username;
    private $userbio;
    public static function check_new_user($username, $phone, $email, $password)
    {
        //$password = md5(strrev(sha1(md5(md5($password)))));  //Security Obsecurity
        //$password = password_hash($password, PASSWORD_DEFAULT);  //Default hashing
        $costAmount = ['cost' => 8];//--0.016sec for cost 8 for hashing passwords
        //cost shld not more than 10 for a nrml server
        $password = password_hash($password, PASSWORD_BCRYPT, $costAmount);
        $login_conn = Database::getConnection();
        $signup_query = "INSERT INTO `auth` (`username`, `phone`, `email`, `password`)
                VALUES ('$username', '$phone', '$email', '$password');";

        $error = false;
        if ($login_conn->query($signup_query) === true) {
            $error = false;
        } else {
            $error = $login_conn->error;
        }
        $login_conn->close();
        return $error;
    }
    public static function login($username, $password)
    {
        //$password = md5(strrev(sha1(md5(md5($password))))); //Security Obsecurity
        $loginQuery = "SELECT * FROM `auth` WHERE `username` = '$username'";
        $signup_conn = Database::getConnection();
        $result = $signup_conn->query($loginQuery);
        if ($result->num_rows == 1) {
            $row_DB = $result->fetch_assoc();
            if (password_verify($password, $row_DB['password'])) {
                return $row_DB;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //all users frameworks
    public function __construct($username)
    {
        $this->username = $username;
        $this->user_conn = Database::getConnection();
        $userQuery = "SELECT * FROM `user` WHERE `username` = '$username'";
        $result = $this->user_conn->query($userQuery);
        if ($result->num_rows == 1) {
            $row_DB = $result->fetch_assoc();
            $this->id = $row_DB['id'];
        } else {
            $this->id = null;
        }
    }
    public function authenticate()
    {
    }
    public function getbio($userbio)
    {
        $this->userbio = $userbio;
        $bioQuery = "SELECT * FROM `bio` WHERE `id` = '$this->id'";
        $result = $this->user_conn->query($bioQuery);
    }
    public function setbio()
    {
    }
    public function getavatar()
    {
    }
    public function setavatar()
    {
    }
}

