"use strict";

const image = document.getElementById("v-image");
const image_field = document.getElementById("u-image");
const userName_field = document.getElementById("u-userName");
const psw_field = document.getElementById("u-psw");
const c_psw_field = document.getElementById("u-psw-confirm");
const email_field = document.getElementById("u-email");
const psw_button = document.getElementById("u-psw-button");
const email_button = document.getElementById("u-email-button");
const userName_button = document.getElementById("u-userName-button");
const apply_button = document.getElementById("u-apply-button");

let  email = document.getElementById("u-email").value;
let userName = document.getElementById("u-userName").value;

email_button.addEventListener("click", event => {
    changeEmailState(!email_button.children[0].classList.contains("d-none"));
});

psw_button.addEventListener("click", event => {
    changePswState(!psw_button.children[0].classList.contains("d-none"));
});

userName_button.addEventListener("click", event => {
    changeUserNameState(!userName_button.children[0].classList.contains("d-none"));
});

image_field.addEventListener("input", event => {
    if (image_field.value === '' || image_field.files.lenght === 0) {
        showFieldInvalid(images_field, "No images selected!");
        return;
    } else {
        showIfEmptyField(image_field, true);

    }
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
    if (userName_field.classList.contains("is-valid")) {
        const usernameData = new FormData();
        usernameData.append('username', userName_field.value);
        axios.post('api-account-settings.php', usernameData).then(response => {
            console.log(response);
            userName = userName_field.value;
            changeUserNameState(false);
        });
    }

    if (email_field.classList.contains("is-valid")) {
        const emailData = new FormData();
        emailData.append('email', email_field.value);
        axios.post('api-account-settings.php', emailData).then(response => {
            console.log(response);
            email = email_field.value;
            changeEmailState(false);
        });
    }

    if (psw_field.classList.contains("is-valid") && c_psw_field.classList.contains("is-valid")) {
        const pswData = new FormData();
        pswData.append('password', psw_field.value);
        axios.post('api-account-settings.php', pswData).then(response => {
            console.log(response);
            changePswState(false);
        });
    }

    if (image_field.classList.contains("is-valid")) {
        const imageData = new FormData();
        imageData.append('image', image_field.files[0]);
        axios.post('api-account-settings.php', imageData).then(response => {
            console.log(response.data);
            image.src = "profilePhotos/" + response.data["image"];
        });
    }
});

function changeUserNameState(enable) {
    userName_field.disabled = false == userName_field.disabled;
    if (enable) {
        userName_button.children[1].classList.remove("d-none");
        userName_button.children[0].classList.add("d-none");
        userName_button.children[2].innerHTML = "Cancel";
    } else {
        userName_field.value = userName;
        userName_field.classList.remove("is-invalid");
        userName_field.classList.remove("is-valid");
        userName_button.children[1].classList.add("d-none");
        userName_button.children[0].classList.remove("d-none");
        userName_button.children[2].innerHTML = "Edit";
    }
}

function changeEmailState(enable) {
    email_field.disabled = false == email_field.disabled;
    if (enable) {
        email_button.children[1].classList.remove("d-none");
        email_button.children[0].classList.add("d-none");
        email_button.children[2].innerHTML = "Cancel";
    } else {
        email_field.value = email;
        email_button.children[0].classList.remove("d-none");
        email_button.children[1].classList.add("d-none");
        email_button.children[2].innerHTML = "Edit";
        email_field.classList.remove("is-invalid");
        email_field.classList.remove("is-valid");
    }
}

function changePswState(enable) {
    psw_field.disabled = false == psw_field.disabled;
    c_psw_field.disabled = false == c_psw_field.disabled;
    if (enable) {
        psw_button.children[1].classList.remove("d-none");
        psw_button.children[0].classList.add("d-none");
        psw_button.children[2].innerHTML = "Cancel";
    } else {
        psw_field.value = "";
        c_psw_field.value = "";
        psw_button.children[0].classList.remove("d-none");
        psw_button.children[1].classList.add("d-none");
        psw_button.children[2].innerHTML = "Edit";
        psw_field.classList.remove("is-invalid");
        psw_field.classList.remove("is-valid");
        c_psw_field.classList.remove("is-invalid");
        c_psw_field.classList.remove("is-valid");
    }
}