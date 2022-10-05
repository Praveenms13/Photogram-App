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
	<?php } else { ?>
		<style>
			.praveen {
				position: relative;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
			}
		</style>
		<div class="praveen">
			<main class="form-signup">
				<form method="POST" action="signup.php">
					<img class="mb-4" src="https://img.icons8.com/color/344/drone-with-camera.png" alt="" width="72" height="57">
					<h1 class="h3 mb-3 fw-normal">Please sign up</h1>
					<div class="form-floating">
						<input name="username" type="text" class="form-control" id="floatingInputUsername" placeholder="name@example.com">
						<label for="floatingInput">Username</label>
					</div>
					<div class="form-floating">
						<input name="phone" type="text" class="form-control" id="floatingInputphone" placeholder="name@example.com">
						<label for="floatingInput">Phone</label>
					</div>
					<div class="form-floating">
						<input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Email address</label>
					</div>
					<div class="form-floating">
						<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
						<label for="floatingPassword">Password</label>
					</div>
					<button class="w-100 btn btn-lg btn-primary hvr-wobble-vertical" type="submit">Sign up</button>
					<p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
				</form>
			</main>
		</div>
		<?php } ?><?php
			} catch (Exception $e) {
				//echo 'Message: ' . $e->getMessage();
				?><main class="container">
			<div class="bg-light p-5 rounded mt-3">
				<h1>Sign-up Failed!</h1>
				<p class="lead">Something went wrong <?= $e->getMessage() ?></p>
			</div>
		</main><?php
			}
				?>