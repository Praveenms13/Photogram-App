<?php
class usersession{
    /*this fun() will return a session id if username and password is correct  
    */ 
    public static function authenticate($username, $password)
    {
        $username = user::login($username, $password);
        $user = new user($username);
        if($username){
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5($username . $ip . $userAgent . time() . rand(0, 999));
            $query = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `useragent`, `active`)
                      VALUES ('$user->id', '$token', now(), '$ip', '$userAgent', '1');";
            if ($conn->query($query)) {
                Session::set('session_token', $token);
                return $token;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public function authorize($token)
    {
        $authSessionConstruct = new usersession($token);
    }
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
    public function getuser()
    {
        return new user($this->uid);
    }
    public function isValid() //check is the validity of the session is within 1 hour else set it inactive
    {
    }
    public function getIP()
    {
    }
    public function getUserAgent() //can also do with IP address(getIP)
    {
    }
    public function deactivate()
    {
    }
}