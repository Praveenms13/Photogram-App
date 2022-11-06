<?php
include "libs/load.php";
try {
    $username = "kanav";
    //$password = "Praveen102";
    $password = isset($_GET['password']) ? $_GET['password'] : "";
    $isConnect = null;

    if (isset($_GET['logout'])) {
        Session::destroy();
        die("Session Destroyed, Login again <a href='testlogin.php'>Login</a>");
    }

    /*
    1.check if session token is available in php sessions (user logged in)
    2.if yes, construct usersession and see if its successfull
    3.check if the user session is valid one (expiry, isValid())
    4.if valid, print session validated else print session invalid and ask user to login
    */
    if (Session::get('_is_Login')) {
        $username = Session::get('session_username');
        $userobj = new user($username);
        print("<br>Welcome Back, ".$userobj->getfirstname());
        print("<br>" . $userobj->getbio());
        $userobj->setbio("I am a programmer");
        print("<br>" . $userobj->getbio());
    } else {
        print("No Sessions Found, Please try to Login Now!<br>");
        $isConnect = User::login($username, $password);
        if ($isConnect) {
            $userobj = new user($username);
            echo "Login Success ,$userobj->getbio()";
            Session::set('_is_Login', true);
            Session::set('session_username', $isConnect);
        } else {
            echo "Login Failed! ,$username";
        }
    }


    echo <<<EOL
<br><br><br>
<a href = "testlogin.php?logout">Logout</a>
EOL;
} catch (Exception $e) {
    echo "Message :" . $e->getMessage();
}
?>