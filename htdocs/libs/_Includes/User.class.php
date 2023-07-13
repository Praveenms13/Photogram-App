<?php

try {
    class user
    {
        private $conn;
        public $id;
        public $username;
        public $user_conn = null;
        public function __construct($username)
        {
            $this->username = $username;
            $this->user_conn = Database::getConnection();
            $table = self::getTableName();
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

        public static function getTableName()
        {
            $tablename = get_config('UserTable');
            return $tablename;
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

        // --------------INPUT CHECK Start----------------//
        // TODO : Check if username is valid with regex with char and numbers
        // TODO : Check if password is valid and strong with regex with char and numbers
        // TODO : Check if phone is valid with regex starts with 6,7,8,9
        // TODO : Check if email is valid with regex and filter_var
        public static function CheckInput($username = null, $phone = null, $email = null, $password = null, $conn = null)
        {
            $calledBy = debug_backtrace()[1]['function'];
            if ($calledBy == 'signup') {
                if (empty($username)) {
                    throw new Exception("Username cannot be empty");
                }
                if (strlen($username) < 4) {
                    throw new Exception("Username must be at least 4 characters long");
                }
                if (!preg_match("/^[a-zA-Z0-9*]+$/", $username)) {
                    throw new Exception("Username must contain only [A-Z, a-z, 0-9, *]");
                }

                if (empty($password)) {
                    throw new Exception("Password cannot be empty");
                }
                if (strlen($password) < 8) {
                    throw new Exception("Password must be at least 8 characters long");
                }
                if (!preg_match("/^[a-zA-Z0-9*]+$/", $password)) {
                    throw new Exception("Password must contain only [A-Z, a-z, 0-9, *]");
                }

                if (empty($phone)) {
                    throw new Exception("Phone Number cannot be empty");
                }
                if (strlen($phone) != 10) {
                    throw new Exception("Phone Number must be 10 digits long");
                }
                if (!preg_match("/^[0-9]{10}$/", $phone)) {
                    throw new Exception("Invalid Phone Number");
                }

                if (empty($email)) {
                    throw new Exception("Email cannot be empty");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid Email");
                }

                $table = self::getTableName();
                // Check if username already exists
                $query = "SELECT `id` FROM `$table` WHERE `username` = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    throw new Exception("Username already exists");
                }

                // Check if phone number already exists
                $query = "SELECT `id` FROM `$table` WHERE `phone` = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $phone);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    throw new Exception("Phone Number already exists");
                }

                // Check if email already exists
                $query = "SELECT `id` FROM `$table` WHERE `email` = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    throw new Exception("Email already exists");
                }
                return true;
            } elseif ($calledBy == 'login') {
                if (empty($username)) {
                    throw new Exception("Username cannot be empty");
                }
                if (empty($password)) {
                    throw new Exception("Password cannot be empty");
                }
                if (!preg_match("/^[a-zA-Z0-9*]+$/", $password)) {
                    throw new Exception("Password must contain only [A-Z, a-z, 0-9, *]");
                }
                return true;
            } else {
                throw new Exception("Invalid function call");
            }
        }

        // --------------INPUT CHECK End----------------//

        public static function signup($username, $phone, $email, $password)
        {
            $signup_conn = Database::getConnection();
            if (self::CheckInput($username, $phone, $email, $password, $signup_conn)) {
                $username = strtolower($username);
                $email = strtolower($email);
                $costAmount = ['cost' => 8];
                $password = password_hash($password, PASSWORD_BCRYPT, $costAmount);
                $table = get_config('UserTable');
                $signup_query = "INSERT INTO `$table` (`username`, `phone`, `email`, `password`) VALUES (?, ?, ?, ?)";
                $error = false;
                $stmt = $signup_conn->prepare($signup_query);
                if ($stmt) {
                    $stmt->bind_param("ssss", $username, $phone, $email, $password);
                    if ($stmt->execute()) {
                        $error = false;
                    } else {
                        $error = $stmt->error;
                        throw new Exception($error);
                    }
                    $stmt->close();
                } else {
                    $error = $signup_conn->error;
                    throw new Exception($error);
                }
                $signup_conn->close();
                return $error;
            }

        }

        public static function login($username, $password)
        {
            $login_conn = Database::getConnection();
            $table = get_config('UserTable');
            if (self::CheckInput($username, null, null, $password, $login_conn)) {
                $username = strtolower($username);
                $loginQuery = "SELECT * FROM `$table` WHERE `username` = ? OR `email` = ?";
                $stmt = $login_conn->prepare($loginQuery);
                if ($stmt) {
                    $stmt->bind_param("ss", $username, $username);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows == 1) {
                        $row_DB = $result->fetch_assoc();
                        if (password_verify($password, $row_DB['password'])) {
                            return $row_DB; //return $row_DB['username'];
                        } else {
                            throw new Exception("Password is incorrect");
                        }
                    } else {
                        throw new Exception("User not found.....");
                    }
                    $stmt->close();
                } else {
                    $error = $login_conn->error;
                    throw new Exception($error);
                }
                $login_conn->close();
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
