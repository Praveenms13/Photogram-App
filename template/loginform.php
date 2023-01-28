<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>CodePen - SignUp and SignIn Form Responsive</title>
	<link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
	<style>
		@import url("https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap");

		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
			font-family: "Poppins", sans-serif;
		}

		body {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			background: url("https://images.pexels.com/photos/2559941/pexels-photo-2559941.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
			background-size: cover;
			transition: all 0.5s;
		}

		.container {
			position: relative;
			width: 800px;
			height: 500px;
			margin: 20px;
		}

		.blueBg {
			position: absolute;
			display: flex;
			justify-content: center;
			align-items: center;
			top: 40px;
			width: 100%;
			height: 420px;
			background: rgba(0, 0, 0, 0.5);
			box-shadow: 0 5px 45px rgba(0, 0, 0, 0.15);
		}

		.blueBg .box {
			position: relative;
			width: 50%;
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}

		.blueBg .box h2 {
			color: #fff;
			font-size: 1.2em;
			font-weight: 500;
			margin-bottom: 10px;
		}

		.blueBg .box button {
			cursor: pointer;
			padding: 10px 30px;
			background: #fff;
			color: #333;
			font-size: 16px;
			font-weight: 500;
			border: none;
		}

		.formBx {
			position: absolute;
			top: 0;
			left: 0;
			width: 50%;
			height: 100%;
			background: #fff;
			z-index: 1000;
			display: flex;
			justify-content: center;
			align-items: center;
			box-shadow: 0 5px 45px rgba(0, 0, 0, 0.15);
			transition: 0.5s ease-in-out;
			overflow: hidden;
		}

		.formBx.active .signupForm {
			left: 0px;
		}

		.formBx:not(.active) .signupForm {
			left: 100%;
		}

		.formBx .signinForm {
			transitoin-delay: 0.25s;
		}

		.formBx.active .signinForm {
			left: -100%;
			transition-delay: 0;
		}

		.formBx.active {
			left: 50%;
		}

		.formBx.active .signupForm input[type=submit] {
			background: #f43648;
		}

		.formBx .form {
			position: absolute;
			left: 0;
			width: 100%;
			transition: 0.5s;
			padding: 50px;
		}

		.formBx .form form {
			width: 100%;
			display: flex;
			flex-direction: column;
		}

		.formBx .form form h3 {
			font-size: 1.5em;
			color: #333;
			margin-bottom: 20px;
			font-weight: 500;
		}

		.formBx .form form input {
			width: 100%;
			margin-bottom: 20px;
			outline: none;
			background: #eee;
			padding: 10px;
			border: 1px solid #e3e3e3;
		}

		.formBx .form form input[type=submit] {
			background: #03a9f4;
			color: #fff;
			max-width: 100px;
			cursor: pointer;
			border: none;
		}

		.formBx .form form .forgot {
			color: #666;
			text-decoration: none;
		}

		.formBx .social {
			display: flex;
			justify-content: space-around;
			margin-bottom: 20px;
		}

		.formBx .social i {
			font-size: 25px;
			cursor: pointer;
		}

		.formBx .social i.facebook {
			color: #1877F2;
		}

		.formBx .social i.google {
			color: #ea4335;
		}

		.formBx .social i.twitter {
			color: #1da1f2;
		}

		.formBx .social i.linkdein {
			color: #0A66C2;
		}

		@media (max-width: 991px) {
			.container {
				max-width: 400px;
				height: 650px;
				display: flex;
				justify-content: center;
				align-items: center;
			}

			.container .blueBg {
				top: 0;
				height: 100%;
			}

			.container .blueBg .box {
				position: absolute;
				width: 100%;
				height: 150px;
				bottom: 0;
			}

			.container .blueBg .box.signin {
				top: 0;
			}

			.container .formBx {
				width: 100%;
				height: 500px;
			}

			.container .formBx.active {
				left: 0;
				top: 150px;
			}
		}
	</style>
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
					<input type="text" placeholder="Username">
					<input type="text" placeholder="Email Address">
					<input type="password" placeholder="Password">
					<input type="password" placeholder="Confirm Password">
					<input type="submit" value="Sign Up">
					<a href="#" class="forgot">Forgot Password</a>
				</form>
			</div>
		</div>
	</div>

	</html>
	<!-- partial -->
	<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>

	<script>
		// const signinBtn = document.querySelector('.signinBtn')
		// const signupBtn = document.querySelector('.signupBtn')
		// const formBx    = document.querySelector('.formBx')
		// signupBtn.addEventListener('click', () =>{
		//   console.log('click')
		//   formBx.classList.add('active')
		// })

		$(document).ready(function() {
			$('.signupBtn').on('click', function() {
				$('.formBx').addClass('active')
				$('body').addClass('active')
			})

			$('.signinBtn').on('click', function() {
				$('.formBx').removeClass('active')
				$('body').removeClass('active')
			})
		});
	</script>

</body>

</html>