<?php

class user
{
    private $conn;
    private $username;
    public static function check_new_user($username, $phone, $email, $password)
    {
        //$password = md5(strrev(sha1(md5(md5($password)))));  //Security Obsecurity
        //$password = password_hash($password, PASSWORD_DEFAULT);  //Default hashing
        $costAmount = ['cost' => 8];//--0.016sec for cost 8 for hashing passwords 
        //cost shld not more than 10 for a nrml server
        $password = password_hash($password, PASSWORD_BCRYPT, $costAmount);
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
        //$password = md5(strrev(sha1(md5(md5($password))))); //Security Obsecurity
        $dbQuery = "SELECT * FROM `auth` WHERE `username` = '$username'";
        $sqlConn = Database::getConnection();
        $result = $sqlConn->query($dbQuery);
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
        $this->conn = Database::getConnection();
        $this->conn->query();
        $this->username = $username;
    }
    public function authenticate(){

    }
    public function getbio(){

    }
    public function setbio(){
        
    }
    public function getavatar(){

    }
    public function setavatar(){
        
    }
}
