<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login or Signup</title>
	<link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
	<link rel="stylesheet" href=<?php echo get_config('cssPath')?>>
</head>

<body>
	<html>
	<div class="container">
		<div class="blueBg">
			<div class="box signin">
				<h2>Already Have An Account?</h2>
				<button class="signinBtn">Sign in</button>
			</div>
			<div class="box signup">
				<h2>Don't Have An Account?</h2>
				<button class="signupBtn">Sign Up</button>
			</div>
		</div>
		<div class="formBx">
			<div class="form signinForm">
				<form method="POST" action="login.php">
					<h3>Sign In</h3>
					<input name="username" type="text" placeholder="Username">
					<input name="password" type="password" placeholder="Password">
					<div class="social">
						<i class='bx bxl-facebook-circle facebook'></i>
						<i class='bx bxl-google google'></i>
						<i class='bx bxl-twitter twitter'></i>
						<i class='bx bxl-linkedin-square linkdein'></i>
					</div>
					<input type="submit" value="Sign In">
					<a href="#" class="forgot">Forgot Password</a>
				</form>
			</div>
			<div class="form signupForm">
				<form method="POST" action="signup.php">
					<h3>Sign Up</h3>
					<input name="username" type="text" placeholder="Username">
					<input name="email" type="text" placeholder="Email Address">
					<input name="phone" type="text" placeholder="phone">
					<input name="password" type="password" placeholder="Password">
					<input type="submit" value="Sign Up">
					<a href="#" class="forgot">Forgot Password</a>
				</form>
			</div>
		</div>
	</div>

	</html>
	<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
	<script src="../js/login|signup.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
			.then(FingerprintJS => FingerprintJS.load())
		fpPromise
			.then(fp => fp.get())
			.then(result => {
				const visitorId = result.visitorId
				console.log(visitorId);
				<?php
                   session_start();
                   $_SESSION['fingerprint_vID'] = $visitorId;
	?>
			})
	</script>
</body>

</html>