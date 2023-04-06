<?php
// macho enna acho
try {

    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fingerprintJSid = $_POST['fingerprintJSid'];
        Session::set('sessionUsername', $username);
        Session::set('sessionFingerprintJSid', $fingerprintJSid);
        $sessionToken = usersession::authenticate($username, $password, $fingerprintJSid); // this one save the token in session as well as return it
        Session::set('sessionToken', $sessionToken);
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

    $token = Session::get('sessionToken');
    if ($token) {
        $fingerprintJSid = Session::get('sessionFingerprintJSid');
        if (usersession::authorize($username, $password, $token, $fingerprintJSid)) {
            $username = Session::get('sessionUsername');
            $userclass = new user($username);
            if ($userclass) {
                $usersession = new usersession($token);
                $IsValid = $usersession->isValid($token);
                if ($IsValid) {
                    // echo "<br>Welcome " . $userclass->getUsername() . "<br>";
                    loadAccess("accessHome");
                } else {
                    $IsValid = null;
                    Session::delete('sessionUsername');
                    Session::delete('session_token');
                    Session::delete('sessionToken');
                    loadTemplate("userForm");
                    throw new Exception("Session Time Over, Login again...");
                }
            } else {
                Session::delete('sessionUsername');
                Session::delete('session_token');
                loadTemplate("userForm");
            }
        } else {
            Session::delete('sessionUsername');
            Session::delete('session_token');
            loadTemplate("userForm");
        }
    } else {
        Session::delete('sessionUsername');
        Session::delete('session_token');
        loadTemplate("userForm");
    }

} catch (Exception $e) {
    ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<style>
    .container {
        margin-top: 10px;
    }
</style>
<div class="container">
    <div class="alert alert-danger" role="alert"> <?php
    echo $e->getMessage() ?>
    </div>
</div>
<?php

}
?>