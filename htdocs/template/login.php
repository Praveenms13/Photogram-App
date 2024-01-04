<?php
try {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //TODO:  Replace with the dummy fingerprint for your user to check it in a Postman.
        $fingerprint = $_COOKIE['fingerprintJSid']; 
        if (!isset($fingerprint)){
            usersession::dispError("Invalid Token", "Invalid Auth Token !!");
            Session::loadTemplate('_loginbody');
        }   
        $sessionToken = usersession::authenticate($username, $password, $fingerprint);
        Session::set('sessionUsername', $username);
        Session::set('sessionToken', $sessionToken);
    }

    $token = Session::get('sessionToken');
    if ($token) {
        if (usersession::authorize($token)) {
            $username = Session::get('sessionUsername');
            $userclass = new user($username);
            if ($userclass) {
                $usersession = new usersession($token);
                $IsValid = $usersession->isValid();
                if ($IsValid) {
                    $redirectTo = Session::get('_redirect');
                    $defaultRedirect = Session::loadTemplate('index');
                    if ($redirectTo) {
                        $defaultRedirect = $redirectTo;
                        Session::set('_redirectInfo', $defaultRedirect);
                        Session::delete('_redirect');
                    }?>
                    <script>
                        window.location.href = "<?php echo $defaultRedirect; ?>";
                        console.log("Redirecting to <?php echo $defaultRedirect ? $defaultRedirect : "/" ?>");
                        console.log("Session Token: <?php echo $token; ?>"); 
                    </script><?php
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
    $errorMessage = $e->getMessage();
    $errorSubject = "Error !!";
    if ($errorMessage == "Login Now !!") {
        $errorSubject = "Welcome !!";
    }
    if (Session::get("__redirectFrom") == "signup.php" or Session::get("__redirectFrom") == "signup"){
        usersession::dispError($errorSubject, "Signup Successfull, " . $errorMessage);    
    } else {
        usersession::dispError($errorSubject, $errorMessage);
    }
    Session::loadTemplate('_loginbody');
}
