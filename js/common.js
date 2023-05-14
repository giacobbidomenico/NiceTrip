/**
 * Function that requests the server if the email entered in the form corresponds to an existing account.
 * If does not happen, an error message is shown in the form.
 * 
 */
function verifyAccount(field, order, type) {
    const formData = new FormData();

    formData.append('type-request', 'verify-'+ type);
    formData.append(type, field.value);

    axios.post('api-authentication.php', formData).then(response => {
        console.log(response);
        if(response.data["error"] || 
            field.value === '' ||
            !field.checkValidity() ||
            (response.data["num-"+type] == 0 && !order) ||
            (response.data["num-"+type] > 0 &&  order)) {
            showFieldInvalid(field);
        } else if ((response.data["num-"+type] > 0 && !order) ||
            (response.data["num-"+type]  == 0 && order)) {
            showFieldValid(field);
        }
    });
}

function verifyEmailOrUsername(field, order) {
    verifyAccount(field, order, 'email-username');
}

function verifyEmail(field, order) {
    verifyAccount(field, order, 'email');
}

function verifyUsername(field, order) {
    verifyAccount(field, order, 'username');
}

function showFieldInvalid(field) {
    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
}

function showFieldValid(field) {
    field.classList.remove("is-invalid");
    field.classList.add("is-valid");
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