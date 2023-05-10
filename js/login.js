"use strict";

const email_username_field = document.getElementById("email-username");
const password_field = document.getElementById("password");
const stay_signed_in_checkbox = document.getElementById("stay-signed-in");
const login_submit = document.getElementById("login-submit");
const eye_button = document.getElementById("eye-button");

email_username_field.addEventListener("focusout", event => verifyEmail());
eye_button.addEventListener("click", event =>  viewPassword());


login_submit.addEventListener("click", event => {
    event.preventDefault();
    login();
});

function verifyEmail() {
    const formData = new FormData();
    formData.append('type-request', 'verify-email-username');
    formData.append('email-username', email_username_field.value);

    axios.post('api-login.php', formData).then(response => {
        if(response.data["error"] || response.data["found-emails-usernames"] == 0) {
            email_username_field.classList.remove("is-valid");
            email_username_field.classList.add("is-invalid");
        } else {
            email_username_field.classList.remove("is-invalid");
            email_username_field.classList.add("is-valid");
        }
    });
}

function login() {
    const formData = new FormData();

    formData.append('type-request', 'login');
    formData.append('email-username', email_username_field.value);
    formData.append('password', password_field.value);
    formData.append('stay-signed-in', stay_signed_in_checkbox.checked);

    axios.post('api-login.php', formData).then(response => {
        console.log(response);
        if(response.data["error"] || response.data["found-users"] <= 0) {
            if(!email_username_field.classList.contains('is-valid')) {
                email_username_field.classList.add("is-invalid");
            }
            password_field.classList.add("is-invalid");
        } else {
            window.location.replace("feed.php");
        }
    });
}

function viewPassword() {
    if(password_field.type === 'password') {
        password_field.type = 'text';
    } else {
        password_field.type = 'password';
    }
}