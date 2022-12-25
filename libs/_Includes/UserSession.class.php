<?php

class usersession
{
    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $userQuery = "SELECT * FROM `session` WHERE `token` = $token";
        $result = $this->user_conn->query($userQuery);
        if ($result->num_rows) {
            $row_DB = $result->fetch_assoc();
            $this->data = $row_DB;
            $this->uid = $row_DB['uid'];
        } else {
            throw new Exception("Session is invalid");
        }
    }


    /*this fun() will return a session id if username and password is correct
    */
    public static function authenticate($username, $password)//I think returns error(return statement of login)
    {
        $username = user::login($username, $password)['username'];
        $userobj = new user($username);
        if ($username) {
            $connection = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5($username . $ip . $userAgent . time() . rand(0, 999));
            $query = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `useragent`, `active`)
                     VALUES ('$userobj->id', '$token', now(), '$ip', '$userAgent', '1');";
            $queryresult = $connection->query($query);
            $queryresult = 1;
            if ($queryresult) {
                Session::set('session_token', $token);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function authorize($username, $password, $token)
    {
        try {
            $ans = usersession::authenticate($username, $password);
            $authSession = new usersession($token);
            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER['HTTP_USER'])) {
                if ($authSession->isValid() and $authSession->isActive()) {
                    if ($_SERVER['REMOTE_ADDR'] == $authSession->getIP() and $_SERVER['HTTP_USER'] == $authSession->getUserAgent()) {
                        return true;
                    } else {
                        throw new Exception("User IP and Browser Doesn't Match");
                    }
                } else {
                    Session::unset();
                    throw new Exception("Invalid Session");
                }
            } else {
                throw new Exception("IP and UserAgent is NULL");
                return false;
            }
        } catch (Exception $e) {
            echo "Message :" . $e->getMessage();
        }
    }
    public function getuser()
    {
        return new user($this->uid);
    }
    public function isValid() //check is the validity of the session is within 1 hour else set it inactive
    {
    }
    public function isActive()
    {
    }
    public function getIP()
    {
        $myIP = $_SERVER['REMOTE_ADDR'];
        return $myIP;
    }
    public function getUserAgent() //can also do with IP address(getIP)
    {
        $myBrowser = $_SERVER['HTTP_USER'];
        return $myBrowser;
    }
    public function deactivate()
    {
    }
}
