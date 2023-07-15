<?php
include "libs/load.php";

// TODO : To fix the bug of logout button once logged in (Logout button is not Showing)
if (isset($_GET['logout'])) {
    echo "Logging Out...";
    if (Session::isset('sessionToken')) {
        $usersession = new usersession(Session::get('sessionToken'));
        if ($usersession->removeSession()) {
            echo "You are logged out successfully...";
        } else {
            echo "Logout failed...";
        }
    }
    Session::destroy();
    header("Location: /");
    die();
} else {
    Session::renderPage();
}
