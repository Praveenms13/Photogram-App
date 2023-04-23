<?php

try {
    class usersession
    {
        public function __construct($token)
        {
            $this->conn = Database::getConnection();
            $this->token = $token;
            $this->userQuery = "SELECT * FROM `session` WHERE `token` = '$this->token'";
            $result = $this->conn->query($this->userQuery);
            if ($result->num_rows) {
                $row_DB = $result->fetch_assoc();
                $this->data = $row_DB;
                $this->uid = $row_DB['uid'];
            }
        }


        /*this fun() will return a session id if username and password is correct
        */
        public static function authenticate($username, $password, $fingerprint = null)//I think returns error(return statement of login)
        {
            $username = user::login($username, $password)['username'];
            if ($username and isset($fingerprint)) {
                $userobj = new user($username);
                $connection = Database::getConnection();
                $ip = $_SERVER['REMOTE_ADDR'];
                $userAgent = $_SERVER['HTTP_USER_AGENT'];
                $token = md5($username . $ip . $userAgent . time() . rand(0, 999));
                $costAmount = ['cost' => 8];
                $fingerprint = password_hash($fingerprint, PASSWORD_BCRYPT, $costAmount);
                $query = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `useragent`, `fingerPrintId` , `active`)
                     VALUES ('$userobj->id', '$token', now(), '$ip', '$userAgent', '$fingerprint' , '1');";
                $queryresult = $connection->query($query);
                if ($queryresult) {
                    return $token;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        public static function authorize($username, $password, $token, $fingerprint = null)
        {
            $authSession = new usersession($token);
            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER['HTTP_USER_AGENT'])) {
                if ($authSession->isValid($token) and $authSession->isActive()) {
                    if ($_SERVER['REMOTE_ADDR'] == $authSession->getIP() and $_SERVER['HTTP_USER_AGENT'] == $authSession->getUserAgent()) {
                        if (password_verify($fingerprint, $authSession->getFingerPrintId())) {
                            return true;
                        } else {
                            throw new Exception("FingerPrint JS Doesn't Match");
                        }
                    } else {
                        throw new Exception("User IP and Browser Doesn't Match");
                    }
                } else {
                    Session::unset();
                    throw new Exception("Login Expired, Login Again");
                }
            } else {
                throw new Exception("IP or UserAgent or FingerPrint JS may be NULL");
                return false;
            }
        }
        public function getuser()
        {
            return new user($this->uid);
        }
        public static function isValid($token)
        {
            $connection = Database::getConnection();
            $connquery = "SELECT `login_time` FROM `session` WHERE `token` = '$token'";
            $result = $connection->query($connquery);
            if ($result) {
                $sqldata = mysqli_fetch_row($connection->query($connquery));
                $sqltime = strtotime($sqldata[0]);
                // echo time() . " "  . "sqltime" . $sqltime + 10;
                if (($sqltime + 60) > time()) {
                    return true;
                } else {
                    $sql = "UPDATE `session` SET `active` = '0' WHERE `token` = '$token'";
                    $connection->query($sql);   //due to this there is some glitch in login page.......
                    return false;
                }
            } else {
                return false;
            }
        }
        public function logout()
        {
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            if (isset($this->uid)) {
                if ($this->isActive() == "1") {
                    $this->deactivate();
                    $sql = "DELETE FROM `session` WHERE `uid` = $this->uid";
                    return $this->conn->query($sql) ? true : false;
                } else {
                    $sql = "DELETE FROM `session` WHERE `uid` = $this->uid";
                    return $this->conn->query($sql) ? true : false;
                }
            } else {
                return false;
            }
        }
        public function isActive()
        {
            return $this->data['active'];
        }
        public function deactivate()
        {
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $sql = "UPDATE `session` SET `active` = 0 WHERE `uid`=$this->uid";

            return $this->conn->query($sql) ? true : false;
        }
        public function getIP()
        {
            return $this->data['ip'];
        }
        public function getUserAgent() //can also do with IP address(getIP)
        {
            return $this->data['useragent'];
        }
        public function getFingerPrintId()
        {
            return $this->data['fingerPrintId'];
        }
        public static function dispError($message, $status)
        { ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<style>
	.alert {
		margin-top: 20px;
	}
</style>
<div class="alert alert-<?php echo $status ?> position-absolute"
	style="top: 0;">
	<?php echo $message ?>
</div>
<?php
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    if ($error == "Login Expired, Login Again") {
        $status = "warning";
    }
    if ($error == "FingerPrint JS Doesn't Match") {
        $status = "danger";
    }
    if ($error == "User IP and Browser Doesn't Match") {
        $status = "danger";
    }
    if ($error == "IP or UserAgent or FingerPrint JS may be NULL") {
        $status = "danger";
    }
    if ($error == "User Not Found") {
        $status = "danger";
    }
    if ($error == "Password Doesn't Match") {
        $status = "danger";
    }
    usersession::dispError($error, $status);
}
?>