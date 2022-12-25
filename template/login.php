<?php

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $auth = usersession::authenticate($username, $password);
}
if ($auth) {
    $token = Session::get('session_token');
    if ($token) {
        $userclass = new user($username); //constructs id
        if ($userclass) {
            $usersession = new usersession($token);
            $IsValid = $usersession->isValid($token);
            if ($IsValid) {
                ?><h4>Login Success....</h4><?php
				loadAc("album");
            } else {
                ?><h4>Token Expired, Login Again</h4><?php
                loadAccess("loginform");
            }
        } else {
            ?><h4>ID Construction Failed, check usersession->constructor</h4><?php
            loadAccess("loginform");
        }
    } else {
        ?><h3>Token not in Session, login again</h3><?php
        loadAccess("loginform");
    }
} else {
    loadAccess("loginform");
}
