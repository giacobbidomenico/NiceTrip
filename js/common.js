/**
 * Function that requests the server if the email entered in the form corresponds to an existing account.
 * If does not happen, an error message is shown in the form.
 * 
 */
function verifyAccount(field, order, type, message_error) {
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

function verifyEmailOrUsername(field, order,) {
    verifyAccount(field, order, 'email-username');
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


function showIfEmptyField(field) {
    if(field.value === '') {
        showFieldInvalid(field, field.name + ' is request!');
        return true;
    } else {
        showFieldValid(field);
    }
    return false;
}

function showFieldInvalid(field, message_error='') {
    if(message_error !== '') {
        field.parentElement.getElementsByClassName("invalid-feedback")[0].innerHTML = message_error;
    }

    field.classList.remove("is-valid");
    field.classList.add("is-invalid");
}

function showFieldValid(field, message_error='') {
    if(field.parentElement.getElementsByClassName("invalid-feedback").lenght == 0) {
        field.parentElement.innerHTML += '<div class="invalid-feedback"></div>';
    }

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