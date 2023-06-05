<div class="b-example-divider"></div>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Login now !!</h1>
        <span>Are you a new user ? &nbsp;<a href="signup.php">signup</a></span>
      </div>

      <div class="modal-body p-5 pt-0">
        <form method="POST" action="login.php">
          <div class="form-floating mb-3">
            <input name="username" type="text" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <input name="fingerprintJSid" type="hidden">
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Sign up</button>
          <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
          <hr class="my-4">
          <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
          <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit">
            <svg class="bi me-1" width="16" height="16">
              <use xlink:href="#google"></use>
            </svg>
            Sign up with Google &nbsp;&nbsp;<i class="fa-brands fa-google"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="b-example-divider"></div>
<script>
  const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
    .then(FingerprintJS => FingerprintJS.load())
  fpPromise
    .then(fp => fp.get())
    .then(result => {
      const visitorId = result.visitorId
      document.cookie = "visitorId=" + visitorId;
      document.getElementsByName("fingerprintJSid")[0].value = visitorId;
    })
</script>