<h3 class="fw-bold fs-e text-primary mt-3">Login:</h3>
<form class="row g-3 needs-validation mt-4" method="POST" novalidate>
    <div class="col-12">
        <div class="col-md-6 position-relative">
            <label for="email-username" class="form-label fw-bold">Email or Username</label>
            <input type="text" class="form-control rounded-0" id="email-username" name="email-username" required/>
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="col-md-6 position-relative">
            <label for="password" class="form-label fw-bold">Password</label>
            <div class="input-group">
                <input type="password" class="form-control  rounded-0" id="password" name="password" required/>
                <span class="input-group-text" id="eye-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                </span>
                <div class="invalid-feedback">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input  rounded-0" type="checkbox" value="stay-signed-in" id="stay-signed-in"/>
            <label class="form-check-label" for="stay-signed-in">
                Stay signed in
            </label>
        </div>
    </div>
    <div class="col-12">
        <p id="message"></p>
    </div>
    <div class="col-12">
        <div class="col-md-6 d-grid pe-1">
            <input class="btn btn-primary btn-lg rounded-0" type="submit" value="Login" name="login" id="login-submit"/>
        </div>
    </div>
</form>

<div class="col-12 mt-3">
    <div class="col-md-6 d-grid pe-1">
        <a href="sign-up.php" class="btn btn-primary btn-lg rounded-0">Sign Up</a>
    </div>
</div>