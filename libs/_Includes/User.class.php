<?php
try {
    class user
    {
        private $conn;
        public function __call($name, $arguments)
        {
            //echo "This is printing from __call method\n";
            //using regular expression (REGEX)
            $securestring = strtolower(preg_replace("/\B([A-Z])/", "_$1", preg_replace("/[^0-9a-zA-z]/", "", substr($name, 3))));
            if (substr($name, 0, 3) == "get") {
                return $this->_get_data($securestring);
            } else if (substr($name, 0, 3) == "set") {
                return $this->_set_data_($name, $arguments[0]);
            }
        }
        public static function check_new_user($username, $phone, $email, $password)
        {
            //$password = md5(strrev(sha1(md5(md5($password)))));  //Security Obsecurity
            //$password = password_hash($password, PASSWORD_DEFAULT);  //Default hashing
            $costAmount = ['cost' => 8]; //--0.016sec for cost 8 for hashing passwords
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
                    return $row_DB['username'];
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
            $userQuery = "SELECT `id` FROM `auth` WHERE `username` = '$username'";
            $result = $this->user_conn->query($userQuery);
            if ($result->num_rows) {
                $row_DB = $result->fetch_assoc();
                $this->id = $row_DB['id'];
            } else {
                throw new Exception("User not found");
                $this->id = null;
            }
        }
        public function authenticate()
        {
        }
        private function _get_data($var)
        {
            //print("Hello, " . $var . "<br>");
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $dataQuery = "SELECT `$var` FROM `user` WHERE `id` = $this->id";
            //print($dataQuery);
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
            $dataQuery = "UPDATE `user` SET `$var` = '$data' WHERE `id` = '$this->id'";
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
        public function getusername()
        {
            return $this->username;
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
    echo "Message :" . $e->getMessage();
}
