    <h3 class="fw-bold fs-e text-primary">Login:</h3>
    <form class="row g-3 needs-validation mt-4" method="POST" novalidate>
        <div class="col-12">
            <div class="col-md-6">
                <label for="email-username" class="form-label">Email or Username</label>
                <input type="text" class="form-control rounded-0" id="email-username" name="email-username" required>
                <div class="invalid-feedback">
                    Please provide a valid email or username!
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control  rounded-0" id="password" name="password" required>
                <div class="invalid-feedback">
                    Password is incorrect!
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input  rounded-0" type="checkbox" value="staySignedIn" id="staySignedIn">
                <label class="form-check-label" for="staySignedIn">
                    Stay signed in
                </label>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="col-md-6 d-grid pe-1">
                <input class="btn btn-primary btn-lg rounded-0" type="submit" value="Login" name="login" id="loginSubmit">
            </div>
        </div>
    </form>

    <div class="col-12 mt-3">
        <div class="col-md-6 d-grid pe-1">
            <a href="sign-in.php" class="btn btn-primary btn-lg rounded-0">Sign Up</a>
        </div>
    </div>