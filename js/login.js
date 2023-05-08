"use strict";

const email_username_field = document.getElementById("email-username");
const password_field = document.getElementById("password");


email_username_field.addEventListener("focusout", event => verifyEmail());


function verifyEmail() {
    const formData = new FormData();
    formData.append('type-request', 'verify-email');
    formData.append('email', email_username_field.value);

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