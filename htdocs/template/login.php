<?php
try {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fingerprint = $_POST['fingerprintJSid'];
        $sessionToken = usersession::authenticate($username, $password, $fingerprint);
        Session::set('sessionUsername', $username);
        Session::set('sessionFingerprintJSid', $fingerprint);
        Session::set('sessionToken', $sessionToken);
    }
    if (isset($_GET['logout'])) {
        if (Session::get('sessionToken')) {
            $token = Session::get('sessionToken');
            $usersession = new usersession($token);
            $usersession->logout();
            Session::delete('sessionUsername');
            Session::delete('sessionToken');
        }
    }

    $token = Session::get('sessionToken');
    if ($token) {
        $fingerprintJSid = Session::get('sessionFingerprintJSid');
        if (usersession::authorize($token, $fingerprintJSid)) {
            $username = Session::get('sessionUsername');
            $userclass = new user($username);
            if ($userclass) {
                $usersession = new usersession($token);
                $IsValid = $usersession->isValid();
                if ($IsValid) {
                    // echo "<br>Welcome " . $userclass->getUsername() . "<br>";
                    // usersession::dispError("Welcome, " . $userclass->getUsername(), "success");
?>
                    <main id="main" role="main">
                        <?php
                        Session::loadTemplate("index/photogram");
                        Session::loadTemplate('index/cards');
                        ?>
                    </main>
<?php
                } else {
                    $IsValid = null;
                    Session::delete('sessionUsername');
                    Session::delete('sessionToken');
                    throw new Exception("Login Time Over, Login again..");
                }
            } else {
                Session::delete('sessionUsername');
                throw new Exception("Something went wrong, Login again...");
            }
        } else {
            Session::delete('sessionUsername');
            throw new Exception("User is not Authorised, Login again..");
        }
    } else {
        Session::delete('sessionUsername');
        throw new Exception("Login Now !!");
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    if ($error == "Login Time Over, Login again..") {
        $status = "warning";
    }
    if ($error == "Something went wrong, Login again...") {
        $status = "danger";
    }
    if ($error == "User is not Authorised, Login again..") {
        $status = "danger";
    }
    if ($error == "Login Now !!") {
        $status = "primary";
    }
    usersession::dispError($error, $status);
    Session::loadTemplate('_loginbody');
}
