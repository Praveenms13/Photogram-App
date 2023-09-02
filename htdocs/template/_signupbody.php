<div class="b-example-divider"></div>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-bottom-0"> <!-- p-5 pb-4 -->
        <h1 class="fw-bold mb-0 fs-2">Signup</h1>
      </div>

      <div class="modal-body pt-0"> <!-- p-5 --> 
        <form method="POST" action="signup.php">
          <div class="form-floating mb-3">
            <input name="username" type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput1">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input name="email" type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput2">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input name="phone" type="text" class="form-control rounded-3" id="floatingInput" placeholder="phonenumber">
            <label for="floatingInput3">Phone Number</label>
          </div>
          <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword4">Password</label>
            <hr class="my-2">
            <p>&nbsp;Allowed Password Charecters: [A-Z,a-z,0-9,*]</p>
          </div>
          <input name="fingerprintJSid" type="hidden">
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Sign up</button>
          <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
          <p>Already have an account? <a href="login.php" class="link-primary">login here</a></p> 
          <hr class="my-3">
        </form>
        <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="button" id="googleButton">
          <svg class="bi me-1" width="16" height="16">
            <use xlink:href="#google"></use>
          </svg>
          Sign up with Google &nbsp;&nbsp;<i class="fa-brands fa-google"></i>
        </button>
        <script>
          document.getElementById("googleButton").addEventListener("click", function() {
            window.location.href = "google.php";
          });
        </script>
      </div>
    </div>
  </div>
</div>
<div class="b-example-divider"></div>