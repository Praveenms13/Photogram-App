<?php
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
            throw new Exception("Sign-up Successful!, You can Login now.");
        } else {
            throw new Exception($error . "Please try again.");
        }
    } else {
        loadAccess("userForm");
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $status = "danger";
    if ($error == "Sign-up Successful!, You can Login now.") {
        $status = "success";
    }
    usersession::dispError($error, $status);
    loadTemplate("userForm");

}
?>