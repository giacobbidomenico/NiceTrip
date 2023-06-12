"use strict";

const userName_field = document.getElementById("u-userName");
const psw_field = document.getElementById("u-psw");
const c_psw_field = document.getElementById("u-psw-confirm");
const email_field = document.getElementById("u-email");
const psw_button = document.getElementById("u-psw-button");
const email_button = document.getElementById("u-email-button");
const userName_button = document.getElementById("u-userName-button");
const apply_button = document.getElementById("u-apply-button");

const email = document.getElementById("u-email").value;
const userName = document.getElementById("u-userName").value;

email_button.addEventListener("click", event => {
    if (email_button.children[0].classList.contains("d-none")) {
        email_field.value = email;
        email_button.children[0].classList.remove("d-none");
        email_button.children[1].classList.add("d-none");
        email_button.children[2].innerHTML = "Edit";
        email_field.classList.remove("is-invalid");
        email_field.classList.remove("is-valid");
    } else {
        email_button.children[1].classList.remove("d-none");
        email_button.children[0].classList.add("d-none");
        email_button.children[2].innerHTML = "Cancel";
    }
    email_field.disabled = false == email_field.disabled;
});

psw_button.addEventListener("click", event => {
    if (psw_button.children[0].classList.contains("d-none")) {
        psw_button.children[0].classList.remove("d-none");
        psw_button.children[1].classList.add("d-none");
        psw_button.children[2].innerHTML = "Edit";
        psw_field.classList.remove("is-invalid");
        psw_field.classList.remove("is-valid");
    } else {
        psw_button.children[1].classList.remove("d-none");
        psw_button.children[0].classList.add("d-none");
        psw_button.children[2].innerHTML = "Cancel";
    }
    psw_field.disabled = false == psw_field.disabled;
    c_psw_field.disabled = false == c_psw_field.disabled;
});

userName_button.addEventListener("click", event => {
    if (userName_button.children[0].classList.contains("d-none")) {
        userName_field.value = userName;
        userName_field.classList.remove("is-invalid");
        userName_field.classList.remove("is-valid");
        userName_button.children[1].classList.add("d-none");
        userName_button.children[0].classList.remove("d-none");
        userName_button.children[2].innerHTML = "Edit";
    } else {
        userName_button.children[1].classList.remove("d-none");
        userName_button.children[0].classList.add("d-none");
        userName_button.children[2].innerHTML = "Cancel";
    }
    userName_field.disabled = false == userName_field.disabled;
});

const userName_feedback = document.getElementById("u-userName-feedback");
let psw_feedback = document.getElementById("u-psw-feedback");
let email_feedback = document.getElementById("u-email-feedback");

userName_field.addEventListener("input", event => verifyUsername(userName_field, true, userName_feedback));
email_field.addEventListener("input", event => verifyEmail(email_field, true));
psw_field.addEventListener("input", event => {
    checkPasswordStrength(psw_field);
    checkPasswordConfirmation(psw_field, c_psw_field);
});
c_psw_field.addEventListener("input", event => checkPasswordConfirmation(psw_field, c_psw_field));


apply_button.addEventListener("click", event => {

});