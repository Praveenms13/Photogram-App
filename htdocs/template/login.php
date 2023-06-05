<?php

include "../libs/load.php";
error_reporting(0);
ini_set('display_errors', 0);
try {
    Session::start('mode', 'web');
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fingerprintJSid = $_POST['fingerprintJSid'];
        Session::set('sessionUsername', $username);
        Session::set('sessionFingerprintJSid', $fingerprintJSid);
        $sessionToken = usersession::authenticate($username, $password, $fingerprintJSid); // this one save the token in session as well as return it
        Session::set('sessionToken', $sessionToken);
    }
    if (isset($_GET['logout'])) {
        if (Session::get('sessionToken')) {
            $token = Session::get('sessionToken');
            $usersession = new usersession($token);
            $usersession->logout();
            Session::delete('sessionUsername');
            Session::delete('session_token');
            Session::delete('sessionToken');
        }
    }

    $token = Session::get('sessionToken');
    if ($token) {
        $fingerprintJSid = Session::get('sessionFingerprintJSid');
        if (usersession::authorize($username, $password, $token, $fingerprintJSid)) {
            $username = Session::get('sessionUsername');
            $userclass = new user($username);
            if ($userclass) {
                $usersession = new usersession($token);
                $IsValid = $usersession->isValid($token);
                if ($IsValid) {
                    //echo "<br>Welcome " . $userclass->getUsername() . "<br>";
                    loadAccess("access");
                    usersession::dispError("Welcome, " . $userclass->getUsername(), "success");
                } else {
                    $IsValid = null;
                    Session::delete('sessionUsername');
                    Session::delete('session_token');
                    Session::delete('sessionToken');
                    throw new Exception("Login Time Over, Login again..");
                }
            } else {
                Session::delete('sessionUsername');
                Session::delete('session_token');
                throw new Exception("Something went wrong, Login again...");
            }
        } else {
            Session::delete('sessionUsername');
            Session::delete('session_token');
            throw new Exception("Something went wrong, Login again..");
        }
    } else {
        Session::delete('sessionUsername');
        Session::delete('session_token');
        print("Disable adblocker for this website and try again...");
        throw new Exception("Login Now !!.");
    }

} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    if ($error == "Login Time Over, Login again..") {
        $status = "warning";
    }
    if ($error == "Something went wrong, Login again...") {
        $status = "danger";
    }
    if ($error == "Login again !!") {
        $status = "primary";
    }
    usersession::dispError($error, $status);
    print("<br>Redirecting to Login Page in 3 seconds...");
    header("Refresh: 3; url=../login.php");
}
