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
            Session::set('__redirectFrom', basename(__FILE__));
            ?>
            <script>
                window.location.href = "<?php echo "/login.php" ?>";
            </script>
            <?php
        } else {
            Session::loadTemplate('_signupbody', [
                'title' => "Signup Here !!"
            ]);
            throw new Exception($error . "Please try again.");
        }
    } else {
        Session::loadTemplate('_signupbody', [
            'title' => "Signup Here !!"
        ]);
        throw new Exception("Signup Now !!");
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    $errorSubject = "Error !!";
    if ($errorMessage == "Signup Now !!") {
        $errorSubject = "Welcome !!";
    }
    usersession::dispError($errorSubject, $errorMessage);
    Session::loadTemplate('_signupbody', [
        'title' => "Signup Here !!"
    ]);

}
?>