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
            $status = "success";
            $error = "Sign-up Successful!, You can Login now.";
            usersession::dispError($error, $status);
            echo "Sign-up Successful!, You can Login now.";
            echo "<br>Redirecting to Login Page in 3 seconds...";
            header("Refresh: 3; url=../login.php");
        } else {
            throw new Exception($error . "Please try again.");
        }
    } else {
        loadAccess("userForm");
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    usersession::dispError($error, $status);
    print("Something went wrong, Please try again...");
    print("<br>Redirecting to Signup Page in 3 seconds...");
    header("Refresh: 3; url=../signup.php");
}
?>