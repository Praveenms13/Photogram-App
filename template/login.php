<?php

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $auth = usersession::authenticate($username, $password);
    Session::set('auth_session', $auth);
    Session::set('session_username', $username);
}
if (Session::get('auth_session')) {
    $token = Session::get('session_token');
    if ($token) {
        $username = Session::get('session_username');
        $userclass = new user($username); //constructs id from username
        if ($userclass) {
            $usersession = new usersession($token);
            $IsValid = $usersession->isValid($token);
            if ($IsValid) {
                echo "<br>Welcome " . $userclass->getUsername() . "<br>";
                echo "Your Token is " . $token. "<br>";
                echo "User ID is " . $userclass->id;
                loadAc("album");
            } else {
                $IsValid = null;
                Session::delete('session_username');
                Session::delete('session_token');
                Session::delete('auth_session');
                ?>
<h4>Token Expired, Login Again</h4><?php
                loadAccess("loginform");
            }
        } else {
            ?>
<h4>ID Construction Failed, check usersession->constructor</h4><?php
            loadAccess("loginform");
        }
    } else {
        ?>
<h3>Token not in Session, login again</h3><?php

        loadAccess("loginform");
    }
} else {
    echo "Login Now";
    loadAccess("loginform");
}
?>