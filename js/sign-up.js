"use strict";

const form = document.querySelector("form");
const username_field = document.getElementById("username");
const email_field = document.getElementById("email");
const name_field = document.getElementById("name");
const last_name_field = document.getElementById("last-name");
const password_field = document.getElementById("password");
const confirm_password_field = document.getElementById("confirm-password");

username_field.addEventListener("input", event => verifyUsername(username_field, true));
email_field.addEventListener("input", event => verifyEmail(email_field, true));
name_field.addEventListener("input", event => showIfEmptyField(name_field));
last_name_field.addEventListener("input", event => showIfEmptyField(last_name_field));
password_field.addEventListener("input", event => {
    checkPasswordStrength();
    checkPasswordConfirmation();
});
confirm_password_field.addEventListener("input", event => checkPasswordConfirmation());


const eye_button1 = document.getElementById("eye-button1");
const eye_button2 = document.getElementById("eye-button2");

eye_button1.addEventListener("click", event =>  viewPassword(password_field));
eye_button2.addEventListener("click", event =>  viewPassword(confirm_password_field));

const sign_up_submit = document.getElementById("sign-up-submit");
sign_up_submit.addEventListener("click", event => {
    event.preventDefault();
    event.stopPropagation();
    sign_up();
});

function checkPasswordStrength() {
    if(showIfEmptyField(password_field)) {
        return;
    }
    const strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    if(!strongRegex.test(password_field.value)) {
        showFieldInvalid(password_field,'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character');
    } else {
        showFieldValid(password_field);
    }
}

function checkPasswordConfirmation() {
    if(showIfEmptyField(confirm_password_field)) {
        return;
    }
    if(password_field.value === confirm_password_field.value) {
        showFieldValid(confirm_password_field);
    } else {
        showFieldInvalid(confirm_password_field, 'password does not match!');
    }
}

function verifyEmail(field, order) {
    if(showIfEmptyField(field)) {
        return;
    }
    if(!field.checkValidity()) {
        showFieldInvalid(field, "invalid email format!");
        return;
    }
    verifyAccount(field, order, 'email', 'email is already used!');
}

function verifyUsername(field, order) {
    if(showIfEmptyField(field)) {
        return;
    }
    verifyAccount(field, order, 'username', 'username is already used!');
    showIfEmptyField(field);
}

function sign_up() {
    for(let item of form.getElementsByTagName("input")) {
        if(!item.classList.contains("is-invalid") && item.type !== 'submit') {
            showIfEmptyField(item);
        }
    }

    if(form.getElementsByClassName('is-valid').length !== 6) {
        return;
    }

    const formData = new FormData();
    formData.append("username", username_field.value);
    formData.append("email", email_field.value);
    formData.append("name", name_field.value);
    formData.append("last-name", last_name_field.value);
    formData.append("password", password_field.value);


    axios.post('api-signup.php', formData).then(response => {
        if(response.data["error"]) {
            showMessage("Error, your account has not been verified", 'error');
        }else {
            showMessage("A link has been sent by email, click it to verify your account", 'success');
        }
    });
}


