/**
 * Function that requests the server if the email entered in the form corresponds to an existing account.
 * If does not happen, an error message is shown in the form.
 * 
 */
function verifyAccount(field, order, type, message_error) {
    showEmptyField(field);
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
            showFieldInvalid(field, message_error);
        } else if ((response.data["num-"+type] > 0 && !order) ||
            (response.data["num-"+type]  == 0 && order)) {
            showFieldValid(field);
        }
    });
}

function verifyEmailOrUsername(field, order, message_error='') {
    verifyAccount(field, order, 'email-username', message_error);
}

function verifyEmail(field, order) {
    if(!field.checkValidity()) {
        showFieldInvalid(field, "Invalid email format!");
        return;
    }
    verifyAccount(field, order, 'email', 'Email is already used!');
    showEmptyField(field);
}

function verifyUsername(field, order) {
    verifyAccount(field, order, 'username', 'Username is already used!');
    showEmptyField(field);
}


function showEmptyField(field) {
    if(field.value === '') {
        showFieldInvalid(field, field.name + ' is request!');
    } else {
        showFieldValid(field);
    }
}

function showFieldInvalid(field, message_error='') {
    if(message_error !== '') {
        field.parentElement.getElementsByClassName("invalid-feedback")[0].innerHTML = message_error;
    }

    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
}

function showFieldValid(field, message_error='') {
    if(message_error !== '') {
        field.parentElement.getElementsByClassName("invalid-feedback")[0].innerHTML = message_error;
    }

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