<?php
try {
    $signup = false;
    if (isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error = User::signup($username, $phone, $email, $password);
        if (!$error) {
            $signup = true;
        } else {
            $signup = false;
        }
    }
    if ($signup) {
        if (!$error) {
            ?>
            <section class="jumbotron text-center" id="mainBanner">
                <div class="container">
                    <h2 class="jumbotron-heading">Signup Successful!!</h2>
                    <h2 class="jumbotron-heading">You can Login now, Redirecting to Login Page in 5 seconds....</h2>
                    <p>
                        <a type="button" class="btn btn-success" href="../login.php">Skip Time and Login Now &nbsp;<i class="fa-solid fa-exclamation"></i></a>
                    </p>
                </div>
            </section><?php header("Refresh: 5; url=../login.php");
        } else {
            Session::loadTemplate('_signupbody');
            throw new Exception($error . "Please try again.");
        }
    } else {
        Session::loadTemplate('_signupbody');
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    $errorSubject = "Error !!";
    usersession::dispError($errorSubject, $errorMessage);
    Session::loadTemplate('_signupbody');
    
}
?>