<?php
try { ?>
<?php
    $signup = false;
    //$login = false;
    if (isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $error = User::check_new_user($username, $phone, $email, $password);
        $signup = true;
    }
    if ($signup) { ?>
<?php if (!$error) {
        ?>
<div class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Sign-up Success!</h1>
		<h2 class="lead">You can Login <a href="../login.php">Here</a></h2>
	</div>
</div>
<?php } else { ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Sign-up Failed!</h1>
		<h2>Something went wrong <?= $error ?></h2>
	</div>
</main>
<?php } ?>
<?php } else {
    loadAccess("userForm");
} ?><?php
} catch (Exception $e) {
    //echo 'Message: ' . $e->getMessage();
    ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Sign-up Failed!</h1>
		<p class="lead">Something went wrong <?= $e->getMessage() ?>
		</p>
	</div>
</main><?php
}
?>