"use strict";

const form =  document.getElementsByTagName("form")[0];
const email_username_field = document.getElementById("email-username");
const password_field = document.getElementById("password");
const stay_signed_in_checkbox = document.getElementById("stay-signed-in");
const login_submit = document.getElementById("login-submit");
const eye_button = document.getElementById("eye-button");

email_username_field.addEventListener("input", event => verifyEmailOrUsername(email_username_field, false));

eye_button.addEventListener("click", event =>  viewPassword(password_field));


login_submit.addEventListener("click", event => {
    event.preventDefault();
    login();
});

function verifyEmailOrUsername(field, order) {
    if(showIfEmptyField(field)) {
        return;
    }
    verifyAccount(field, order, "email-username", "no matching accounts");
}

/**
 * Function that requests the server if the email and password entered in the form correspond to an existing account.
 * If this happens it means that the user has been logged in and the user is redirected to the feed, otherwise he is 
 * warned that the password is incorrect.
 * 
 */
function login() {

    showEmptyFields(form);

    //check that the email has been validated
    if(!email_username_field.classList.contains("is-valid")) {
        return;
    }

    const formData = new FormData();

    formData.append('type-request', 'login');
    formData.append('email-username', email_username_field.value);
    formData.append('password', password_field.value);
    formData.append('stay-signed-in', stay_signed_in_checkbox.checked);

    //sending data to server
    axios.post('api-authentication.php', formData).then(response => {
        if(response.data['error'] === 'error-account-not-activated') {
            showFieldValid(password_field, '');
            showMessage("Error, your account has not been verified", 'error');
        }else if(response.data['error'] === 'error-login-data' && response.data["found-users"] <= 0) {
            if(!showIfEmptyField(password_field, false)) {
                if (!email_username_field.classList.contains('is-valid')) {
                    email_username_field.classList.add("is-invalid");
                }
                showFieldInvalid(password_field, 'Error, password is incorrect!');
            }
        } else {
            window.location.replace("feed.php");
        }
    });
}