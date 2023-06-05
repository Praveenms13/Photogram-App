<?php
include "../libs/load.php";
try { ?>
    <?php
    $signup = false;
    if (isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error = User::check_new_user($username, $phone, $email, $password);
        if (!$error) {
            $signup = true;
        } else {
            $signup = false;
        }
    }
    if ($signup) {
        if (!$error) {
            // $status = "success";
            // $error = "Sign-up Successful!, You can Login now.";
            // usersession::dispError($error, $status);
    ?>
            <style>
                #footer {
                    position: fixed;
                    bottom: 0;
                    width: 100%;
                }
            </style>
            <section class="jumbotron text-center" id="mainBanner">
                <div class="container">
                    <h2 class="jumbotron-heading">Signup Successful!!</h2>
                    <h2 class="jumbotron-heading">You can Login now, Redirecting to Login Page in 5 seconds....</h2>
                    <p>
                        <a type="button" class="btn btn-success" href="../login.php">Skip Time and Login Now &nbsp;<i class="fa-solid fa-exclamation"></i></a>
                    </p>
                </div>
            </section>
    <?php
            header("Refresh: 5; url=../login.php");
        } else {
            loadTemplate('_signupbody');
            throw new Exception($error . "Please try again.");
        }
    } else {
        loadTemplate('_signupbody');
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    usersession::dispError($error, $status);
    ?>
    <section class="jumbotron text-center" id="mainBanner">
        <div class="container">
            <h2 class="jumbotron-heading">Signup Error Occured!!</h2>
            <h2 class="jumbotron-heading">Error Message: <?php echo $error; ?></h2>
            <p>
                <a type="button" class="btn btn-success" href="../signup.php">Signup again &nbsp;<i class="fa-solid fa-exclamation"></i></a>

            </p>
        </div>
    </section>
    <style>
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
<?php
}
?>