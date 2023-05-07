showLoginForm();
document.getElementById("main-content").addEventListener("submit", login());

function showLoginForm() {
    document.getElementById("main-content").innerHTML = `
        <h3 class="fw-bold fs-e text-primary">Login:</h3>
        <form class="row g-3 needs-validation mt-4" novalidate>
            <div class="col-12">
                <div class="col-md-6">
                    <label for="username-email" class="form-label">Email or Username</label>
                    <input type="text" class="form-control rounded-0" id="username-email" name="username-email" required>
                    <div class="invalid-feedback">
                        Please provide a valid email or username
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control  rounded-0" id="password" name="password" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input  rounded-0" type="checkbox" value="staySignedIn" id="staySignedIn" required>
                    <label class="form-check-label" for="staySignedIn">
                    Stay signed in
                    </label>
                    <div class="invalid-feedback">
                    You must agree before submitting.
                    </div>
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
        </div>`;
}

function login() {
    console.log("hello");
}