<?php
$fingerprint = "I am Cookie...";
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sessionToken = usersession::authenticate($username, $password, $fingerprint);
    Session::set('sessionUsername', $username);
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
if (Session::get('sessionToken')) {
    $token = Session::get('sessionToken');
    if (usersession::authorize($username, $password, $token, $fingerprint)) {
        if ($token) {
            $username = Session::get('sessionUsername');
            $userclass = new user($username); //constructs id from username
            if ($userclass) {
                $usersession = new usersession($token);
                $IsValid = $usersession->isValid($token);
                if ($IsValid) {
                    // echo "<br>Welcome " . $userclass->getUsername() . "<br>";
                    // echo "Your Token is " . $token. "<br>";
                    // echo "User ID is " . $userclass->id;
                    loadAc("album");
                } else {
                    $IsValid = null;
                    Session::delete('sessionUsername');
                    Session::delete('session_token');
                    Session::delete('sessionToken');
                    ?>
<!-- <h4>Token Expired, Login Again</h4>--><?php
                    loadAccess("userForm");
                }
            } else {
                ?>
<h4>ID Construction Failed, check usersession->constructor</h4><?php
                loadAccess("userForm");
            }
        } else {
            ?>
<h3>Token not in Session, login again</h3><?php
            loadAccess("userForm");
        }
    } else {
        loadAccess("userForm");
    }
} else {
    loadAccess("userForm");
}
?>