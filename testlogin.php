<?php
include "libs/load.php";    //git test
error_reporting(0);
ini_set('display_errors', 0);
$username = "Praveen102";
//$password = "Praveen102";
$password = isset($_GET['password']) ? $_GET['password'] : "";
$isConnect = null;

if(isset($_GET['logout'])){
    Session::destroy();
    die("Session Destroyed, Login again <a href='testlogin.php'>Login</a>");
}

if (Session::get('_is_Login')) {
    $userdata = Session::get('sessionDetails');
    print("Welcome Back, $userdata[username]");
    $isConnect = $userdata;
} else {
    print("No Sessions Found, Please try to Login Now!<br>");
    $isConnect = User::login($username, $password);
    if ($isConnect) {
        echo "Login Success";
        Session::set('_is_Login', true);
        Session::set('sessionDetails', $isConnect);
    } else {
        echo "Login Failed!";
    }
}


echo <<<EOL
<br><br><br>
<a href = "testlogin.php?logout">Logout</a>
EOL;
