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
password_field.addEventListener("input", event => showIfEmptyField(password_field));
confirm_password_field.addEventListener("input", event => showIfEmptyField(confirm_password_field));


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

function sign_up() {
    for(let item of form.getElementsByTagName("input")) {        
        if(!item.classList.contains("is-valid") && !item.checkValidity()) {
            item.classList.remove("is-valid");
            item.classList.add("is-invalid");
        }
        /*if(item.classList.contains("is-invalid") && item.checkValidity()) {
            item.classList.remove("is-invalid");
            item.classList.add("is-valid");
        }*/
    }
}