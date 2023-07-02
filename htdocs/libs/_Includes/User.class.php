<?php

try {
    class user
    {
        private $conn;
        public $id;
        public $username;
        public $user_conn;
        public function __construct($username)
        {
            $this->username = $username;
            $this->user_conn = Database::getConnection();
            $table = get_config('UserTable');
            $userQuery = "SELECT `id` FROM `$table` WHERE `username` = '$username' OR `id` = '$username'";
            $result = $this->user_conn->query($userQuery);
            if ($result->num_rows) {
                $row_DB = $result->fetch_assoc();
                $this->id = $row_DB['id'];
            } else {
                throw new Exception("User not found");
                $this->id = null;
            }
        }

        public function __call($name, $arguments)
        {
            $securestring = strtolower(preg_replace("/\B([A-Z])/", "_$1", preg_replace("/[^0-9a-zA-z]/", "", substr($name, 3))));
            if (substr($name, 0, 3) == "get") {
                return $this->_get_data($securestring);
            } elseif (substr($name, 0, 3) == "set") {
                return $this->_set_data_($securestring, $arguments[0]);
            } else {
                throw new Exception("Method $name does not exist");
            }
        }
        public static function check_new_user($username, $phone, $email, $password)
        {
            $costAmount = ['cost' => 8];
            $password = password_hash($password, PASSWORD_BCRYPT, $costAmount);
            $login_conn = Database::getConnection();
            $table = get_config('UserTable');
            $signup_query = "INSERT INTO `$table` (`username`, `phone`, `email`, `password`)
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
            $table = get_config('UserTable');
            $loginQuery = "SELECT * FROM `$table` WHERE `username` = '$username' OR `email` = '$username'";
            $signup_conn = Database::getConnection();
            $result = $signup_conn->query($loginQuery);
            if ($result->num_rows == 1) {
                $row_DB = $result->fetch_assoc();
                if (password_verify($password, $row_DB['password'])) {
                    return $row_DB; //return $row_DB['username'];
                } else {
                    throw new Exception("Password is incorrect");
                }
            } else {
                throw new Exception("User not found");
            }
        }

        private function _get_data($var)
        {
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $table = get_config('UserTable');
            $dataQuery = "SELECT `$var` FROM `$table` WHERE `id` = $this->id";
            $result = $this->conn->query($dataQuery);
            if ($result and $result->num_rows) {
                $value = $result->fetch_assoc()["$var"];
                //print("<br>Res : " . $value);
                return $value;
            } else {
                return null;
            }
        }
        private function _set_data_($var, $data)
        {
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $table = get_config('UserTable');
            $dataQuery = "UPDATE `$table` SET `$var` = '$data' WHERE `id` = $this->id";
            //print($dataQuery);
            $result = $this->conn->query($dataQuery);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        public function setdob($year, $month, $day)
        {
            if (checkdate($month, $day, $year)) {
                return $this->_set_data_('dob', $year . '-' . $month . '-' . $day);
            }
        }
        //alternative of __call function
        // public function getdob(){
        //     return $this->_get_data('dob');
        // }
        // public function getbio(){
        //     return $this->_get_data('bio');
        // }
        // public function setbio($userbio){
        //     return $this->_set_data_('bio', $userbio);
        // }
        // public function getavatar(){
        //     return $this->_get_data('avatar');
        // }
        // public function setavatar($link){
        //     return $this->_set_data_('avatar', $link);
        // }
        // public function getfirstname(){
        //     return $this->_get_data('firstname');
        // }
        // public function setfirstname($firstname){
        //     return $this->_set_data_('firstname', $firstname);
        // }
        // public function getlastname(){
        //     return $this->_get_data('lastname');
        // }
        // public function setlastname($lastname){
        //     return $this->_set_data_('lastname', $lastname);
        // }
        // public function getinstagram(){
        //     return $this->_get_data('instagram');
        // }
        // public function setinstagram($instagram){
        //     return $this->_set_data_('instagram', $instagram);
        // }
        // public function getfacebook(){
        //     return $this->_get_data('facebook');
        // }
        // public function setfacebook($facebook){
        //     return $this->_set_data_('facebook', $facebook);
        // }
        // public function gettwitter(){
        //     return $this->_get_data('twitter');
        // }
        // public function settwitter($twitter){
        //     return $this->_set_data_('twitter', $twitter);
        // }
    }
}
// catch block
catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    if ($error == "User not found") {
        $status = "danger";
    }
    usersession::dispError($error, $status);
}
