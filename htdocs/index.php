<?php
include "libs/load.php";

if (isset($_GET['logout'])) {
    echo "Logging Out...";
    if (Session::isset('sessionToken')) {
        $token = Session::get('sessionToken');
        $usersession = new usersession($token);
        if ($usersession->removeSession()) {
            echo "You are logged out successfully...";
        } else {
            echo "Logout failed...";
        }
        Session::destroy();
        header("Location: /");
    }
} else {
    Session::renderPage();
}
