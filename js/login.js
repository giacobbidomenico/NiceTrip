showLoginForm();
document.getElementById("main-content").addEventListener("submit", login());

function showLoginForm() {
    document.getElementById("main-content").innerHTML = `
        <h3 class="fw-bold fs-e text-primary">Login:</h3>
        <form class="row g-3 needs-validation mt-4" novalidate>
            <div class="col-12">
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Email or Username</label>
                    <input type="text" class="form-control rounded-0" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Password</label>
                    <input type="password" class="form-control  rounded-0" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input  rounded-0" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                    You must agree before submitting.
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="col-md-6 d-grid pe-1">
                    <a class="btn btn-primary btn-lg rounded-0" type="submit">Login</a>
                </div>
            </div>
            <div class="col-12">
                <div class="col-md-6 d-grid pe-1">
                    <a class="btn btn-primary btn-lg rounded-0" type="submit">Sign Up</a>
                </div>
            </div>
        </form>`;
}

function login() {
    console.log("hello");
}