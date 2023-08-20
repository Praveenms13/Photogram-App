<?php
include "libs/load.php";

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
