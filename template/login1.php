<?php
include "../libs/load.php";
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
$isConnect = null;

if (isset($_GET['logout'])) {
    Session::destroy();
}
if (Session::get('_is_Login')) {
    $userclass = Session::get('session_username');
    loadAc("album");
} else {
    $isConnect = User::login($username, $password);
    if ($isConnect) {
        Session::set('_is_Login', true);
        Session::set('session_username', $isConnect);
    } else {
        loadAccess("loginform");
    }
}

// echo <<<EOL
// <br><br><br>
// <a href = "testlogin.php?logout">Logout</a>
// EOL; 
?>