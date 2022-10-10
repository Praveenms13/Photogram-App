<?php
class login{
	public static $status = 0;
	public static function oldLogin($username, $password){
		//$password = md5(strrev(sha1(md5(md5($password)))));
        $conn = Database::getConnection();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$dbTableName = "SELECT username, password FROM student";
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = $conn->query($dbTableName);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				if ($username == $row['username'] and $password == $row["password"]) {
					login::$status = 1;
				}else{
					login::$status = 2;
				}
			}
		}
		return login::$status;
	}
}
$ans_result = login::$status;?>
<script>
	console.log(<?php echo login::$status; ?>)
</script>
<?php
if($ans_result){
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
				<img class="mb-4" src="https://img.icons8.com/color/344/drone-with-camera.png" alt="" width="72" height="57">
				<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

				<div class="form-floating">
					<input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
					<label for="floatingInput">User Name</label>
				</div>
				<div class="form-floating">
					<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
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
<?php } ?>