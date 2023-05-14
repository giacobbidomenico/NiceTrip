const username_field = document.getElementById("username");
const email_field = document.getElementById("email");
const password_field = document.getElementById("password");
const confirm_password_field = document.getElementById("confirm-password");

username_field.addEventListener("change", event => verifyUsername(username_field, true));
email_field.addEventListener("change", event => verifyEmail(email_field, true));


const eye_button1 = document.getElementById("eye-button1");
const eye_button2 = document.getElementById("eye-button2");

eye_button1.addEventListener("click", event =>  viewPassword(password_field));
eye_button2.addEventListener("click", event =>  viewPassword(confirm_password_field));