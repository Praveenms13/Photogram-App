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
    ?>
    <!-- <script>
        alert("Hi!, Due to unavoidable situations, All the datas in the database are deleted, even I dont have any backup for this database 😭. I am working on it and will fix as soon as possible 🥰. Users Can't Login, Signup, Post Images, Videos, do likes and shares.")
    </script> -->
    <?php
    Session::renderPage();
}
