<?php

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sessionToken = usersession::authenticate($username, $password); // this one save the token in session as well as return it
    Session::set('sessionUsername', $username);
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
    if (usersession::authorize($username, $password, $token)) {
        $username = Session::get('sessionUsername');
        $userclass = new user($username);
        if ($userclass) {
            $usersession = new usersession($token);
            $IsValid = $usersession->isValid($token);
            if ($IsValid) {
                // echo "<br>Welcome " . $userclass->getUsername() . "<br>";
                loadAc("album");
            } else {
                $IsValid = null;
                Session::delete('sessionUsername');
                Session::delete('session_token');
                Session::delete('sessionToken');
                echo "Session Time Over, Login again..";
                loadAccess("userForm");
            }
        } else {
            Session::delete('sessionUsername');
            Session::delete('session_token');
            loadAccess("userForm");
        }
    } else {
        Session::delete('sessionUsername');
        Session::delete('session_token');
        loadAccess("userForm");
    }
} else {
    Session::delete('sessionUsername');
    Session::delete('session_token');
    loadAccess("userForm");
}
