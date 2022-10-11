<?php
if ($ans_result) {
    loadAc("album");
} else { ?>
<style>
	.praveen {
		position: relative;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
</style>
<div class="praveen">
	<main class="form-signin">
		<form method="POST" action="login.php">
			<img class="mb-4" src="https://img.icons8.com/color/344/drone-with-camera.png" alt="" width="72"
				height="57">
			<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

			<div class="form-floating">
				<input name="username" type="text" class="form-control" id="floatingInput"
					placeholder="name@example.com">
				<label for="floatingInput">User Name</label>
			</div>
			<div class="form-floating">
				<input name="password" type="password" class="form-control" id="floatingPassword"
					placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>

			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary hvr-wobble-vertical" type="submit">Sign in</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
		</form>
	</main>
</div>
<?php }
