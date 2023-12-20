<?php

try {
    class usersession
    {
        public $conn;
        public $token;
        public $userQuery;
        public $data;
        public $uid;
        // TODO :To ADD a parameterized query and statements to prevent SQL injection in all the queries
        public function __construct($token)
        {
            $this->conn = Database::getConnection();
            $this->token = $token;
            $table = get_config('SessionTable');
            $this->userQuery = "SELECT * FROM `$table` WHERE `token` = '$this->token'";
            $result = $this->conn->query($this->userQuery);
            if ($result->num_rows) {
                $this->data = $result->fetch_assoc();
                $this->uid = $this->data['uid'];
            }
        }
        public static function authenticate($username, $password, $fingerprint = null) //I think returns error(return statement of login)
        {
            $username = user::login($username, $password)['username'];
            if ($fingerprint == null) {
                $fingerprint = $_COOKIE['fingerprintJSid'];
            }
            if ($username) {
                $userobj = new user($username);
                $connection = Database::getConnection();
                $ip = $_SERVER['REMOTE_ADDR'];
                $userAgent = $_SERVER['HTTP_USER_AGENT'];
                $token = md5($username . $ip . $userAgent . time() . rand(0, 999));
                $costAmount = ['cost' => 8];
                $fingerprint = password_hash($fingerprint, PASSWORD_BCRYPT, $costAmount);
                $table = get_config('SessionTable');
                $query = "INSERT INTO `$table` (`uid`, `token`, `login_time`, `ip`, `useragent`, `fingerPrintId` , `active`)
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
        //Below function is used in login.php and it is used to check whether the user is valid or not
        // Prevents Cookie Hijacking, Session Hijacking, Session Fixation, Session Expiration
        public static function authorize($token)
        {
            $authSession = new usersession($token);
            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER['HTTP_USER_AGENT'])) {
                if ($authSession->isValid() and $authSession->isActive()) {
                    if ($_SERVER['REMOTE_ADDR'] == $authSession->getIP() and $_SERVER['HTTP_USER_AGENT'] == $authSession->getUserAgent()) {
                        // TODO: The below code is useless and session or cookie hijacking is still possible
                        // TODO: The below code is always true and the fingerprint is not verified
                        // TODO: Possible Solution: Again generate the fingerprint and compare it with the fingerprint stored in the database
                        if (password_verify($_COOKIE['fingerprintJSid'], $authSession->getFingerPrintId())) {
                            Session::$user = $authSession->getuser();
                            return $authSession;
                        } else {
                            throw new Exception("FingerPrint JS Doesn't Match .....");
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
            // TODO: I think this code will not work .......
            return new user($this->uid);
        }
        public function isValid()
        {
            if (isset($this->data['login_time'])) {
                $sqltime = strtotime($this->data['login_time']);
                if (($sqltime + 3600) > time()) {
                    return true;
                } else {
                    $this->deactivate();
                    return false;
                }
            } else {
                throw new Exception("Login Time is not set");
            }

        }
        public function removeSession()
        {
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            if (isset($this->uid)) {
                $table = get_config('SessionTable');
                $sql = "DELETE FROM `$table` WHERE `uid` = $this->uid";
                return $this->conn->query($sql) ? true : false;
            } else {
                return false;
            }
        }
        public function isActive()
        {
            return $this->data['active'] ? true : false;
        }
        public function deactivate()
        {
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $table = get_config('SessionTable');
            $sql = "UPDATE `$table` SET `active` = 0 WHERE `uid`=$this->uid";

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
            return $this->data['fingerPrintId'] ? $this->data['fingerPrintId'] : false;
        }
        public static function dispError($message, $status)
        { 
            ?> 
            <style>
                /* Style the notification to look like an alert and place it at the top center */
                #demo {
                    position: fixed;
                    top: 120px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 300px;
                    background-color: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                    padding: 10px;
                    border-radius: 4px;
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                @media (max-width: 599px) {
                    #demo {
                        top: 70px;
                    }
                }
            </style>

            <div id="demo">
                <?php echo $message; ?>
            </div>

            <script>
                function loadDoc() {
                    var notification = document.getElementById("demo");
                    setTimeout(function() {
                        notification.style.display = "none";
                    }, 6000);
                }
                loadDoc();
            </script>
            <?php
        }


    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    usersession::dispError($error, $status);
}
