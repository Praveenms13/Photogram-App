<?php

try {
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
        throw new Exception("Login Now !!");
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
    if ($error == "Login Now !!") {
        $status = "primary";
    }
    usersession::dispError($error, $status);
    loadTemplate("userForm");
}
