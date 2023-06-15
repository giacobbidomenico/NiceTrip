<h3 class="fw-bold fs-e text-primary mt-4">Sign Up:</h3>

<form class="row g-3 needs-validation mt-4" method="POST" novalidate>

    <div class="col-12 col-md-5 d-inline-block me-md-4 position-relative">
        <label for="username" class="form-label fw-bold">Username</label>
        <input type="text" class="form-control rounded-0" id="username" name="username" autocomplete="on" required/>
        <div class="invalid-feedback"></div>
    </div>

    <div class="col-12 col-md-5 d-inline-block position-relative">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control rounded-0" id="email" name="email" autocomplete="on" required/>
        <div class="invalid-feedback"></div>
    </div>

    <div class="col-12 col-md-5 d-inline-block me-md-4 position-relative">
        <label for="name" class="form-label fw-bold">Name</label>
        <input type="text" class="form-control rounded-0" id="name" name="name" autocomplete="on" required/>
        <div class="invalid-feedback"></div>
    </div>

    <div class="col-12 col-md-5 d-inline-block position-relative">
        <label for="last-name" class="form-label fw-bold">Last Name</label>
        <input type="text" class="form-control rounded-0" id="last-name" name="last-name" required/>
        <div class="invalid-feedback"></div>
    </div>

    <div class="col-12 col-md-5 d-inline-block me-md-4">
        <label for="password" class="form-label fw-bold">Password</label>
        <div class="input-group position-relative">
            <input type="password" class="form-control  rounded-0" id="password" name="password" required/>
            <span class="input-group-text" id="eye-button1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
            </span>
            <div class="invalid-feedback">
            </div>
        </div>
    </div>

    <div class="col-12 col-md-5 d-inline-block">
        <label for="confirm-password" class="form-label text-nowrap fw-bold">Confirm Password</label>
        <div class="input-group position-relative">
            <input type="password" class="form-control  rounded-0" id="confirm-password" name="confirm-password" required/>
            <span class="input-group-text" id="eye-button2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
            </span>
            <div class="invalid-feedback text-wrap">
                
            </div>
        </div>
    </div>

    <div class="col-12">
        <p id="message"><p>
    </div>
    <div class="col-12">
        <div class="col-md-6 d-grid pe-1">
            <input class="btn btn-primary btn-lg rounded-0 fw-bold" type="submit" value="Sign Up" name="signup" id="sign-up-submit"/>
        </div>
    </div>
</form>

<div class="col-md-6 d-grid pe-1 mt-3 mb-5">
    <a href="index.php" class="btn btn-primary btn-lg rounded-0">Login</a>
</div>
