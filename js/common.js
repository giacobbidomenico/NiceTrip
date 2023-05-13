/**
 * Function that requests the server if the email entered in the form corresponds to an existing account.
 * If does not happen, an error message is shown in the form.
 * 
 */
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

/**
 * Function that makes the password field of the form visible if the user requests it.
 * 
 */
function viewPassword(field) {
    if(field.type === 'password') {
        field.type = 'text';
    } else {
        field.type = 'password';
    }
}